<?php
/**
 * DbSimple_Postgreql: PostgreSQL database.
 * (C) 2005 Dmitry Koterov, http://forum.dklab.ru/users/DmitryKoterov/
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * See http://www.gnu.org/copyleft/lesser.html
 *
 * Placeholders are emulated because of logging purposes.
 *
 * @version 2.08;
 */
require_once dirname(__FILE__) . '/Generic.php';


/**
 * Database class for PostgreSQL.
 */
class DbSimple_Postgresql extends DbSimple_Generic_Database
{

    var $link;
    
    /**
     * constructor(string $dsn)
     * Connect to PostgresSQL.
     */
    function DbSimple_Postgresql($dsn)
    {
        $p = DbSimple_Generic::parseDSN($dsn);
        if (!is_callable('pg_connect')) {
            return $this->_setLastError("-1", "PostgreSQL extension is not loaded", "pg_connect");
        }
        $ok = $this->link = @pg_connect(
            $t = (!empty($p['host']) ? 'host='.$p['host'].' ' : '').
            (!empty($p['port']) ? 'port='.$p['port'].' ' : '').
            'dbname='.preg_replace('{^/}s', '', $p['path']).' '.
            (!empty($p['user']) ? 'user='.$p['user'].' ' : '').
            (!empty($p['pass']) ? 'password='.$p['pass'].' ' : '')
        );
        $this->_resetLastError();
        if (!$ok) return $this->_setDbError('pg_connect()');
    }


    function _performEscape($s, $isIdent=false)
    {
        if (!$isIdent)
            return "'" . str_replace("'", "''", $s) . "'";
        else
            return '"' . str_replace('"', '_', $s) . '"';
    }


    function _performTransaction($parameters=null)
    {
        return $this->query('BEGIN');
    }


    function& _performNewBlob($blobid=null)
    {
        $obj =& new DbSimple_Postgresql_Blob($this, $blobid);
        return $obj;
    }


    function _performGetBlobFieldNames($result)
    {
        $blobFields = array();
        for ($i=pg_num_fields($result)-1; $i>=0; $i--) {
            $type = pg_field_type($result, $i); 
            if (strpos($type, "BLOB") !== false) $blobFields[] = pg_field_name($result, $i);
        }
        return $blobFields;
    }

    // TODO: Real PostgreSQL escape
    function _performGetPlaceholderIgnoreRe()
    {
        return '
            "   (?> [^"\\\\]+|\\\\"|\\\\)*    "   |
            \'  (?> [^\'\\\\]+|\\\\\'|\\\\)* \'   |
            `   (?> [^`]+ | ``)*              `   |   # backticks
            /\* .*?                          \*/      # comments
        ';
    }


    function _performCommit()
    {
        return $this->query('COMMIT');
    }


    function _performRollback()
    {
        return $this->query('ROLLBACK');
    }


    function _performTransformQuery(&$queryMain, $how)
    {
        // If we also need to calculate total number of found rows...
        switch ($how) {
            // Prepare total calculation (if possible)
            case 'CALC_TOTAL':
                // Not possible
                return true;
        
            // Perform total calculation.
            case 'GET_TOTAL':
                // TODO: GROUP BY ... -> COUNT(DISTINCT ...)
                $re = '/^
                    (\s* SELECT \s+)                                             #1     
                    (.*?)                                                        #2
                    (\s+ FROM \s+ .*?)                                           #3
                        ((?:\s+ ORDER \s+ BY \s+ .*?)?)                          #4
                        ((?:\s+ LIMIT \s+ \S+ \s* (?:, OFFSET \s* \S+ \s*)? )?)  #5
                $/six';
                $m = null;
                if (preg_match($re, $queryMain[0], $m)) {
                    $queryMain[0] = $m[1] . $this->_fieldList2Count($m[2]) . " AS C" . $m[3];
                    $skipTail = substr_count($m[4] . $m[5], '?'); 
                    if ($skipTail) array_splice($queryMain, -$skipTail);
                }
                return true;
        }
        
        return false;
    }


    function _performQuery($queryMain)
    {
        $this->_lastQuery = $queryMain;
        $this->_expandPlaceholders($queryMain, false);
        $result = pg_query($this->link, $queryMain[0]);
        if ($result === false) return $this->_setDbError($queryMain[0]);
        if (!is_resource($result)) {
            if (preg_match('/^\s* INSERT \s+/six', $queryMain[0])) {
                // INSERT queries return generated ID.
                return @pg_last_oid($this->link);
            }
            // Non-SELECT queries return number of affected rows, SELECT - resource.
            return @pg_affected_rows($this->link);
        }
        return $result;
    }

    
    function _performFetch($result)
    {
        $row = @pg_fetch_assoc($result);
        if (pg_last_error($this->link)) return $this->_setDbError($this->_lastQuery);
        if ($row === false) return null;        
        return $row;
    }
    
    
    function _setDbError($query)
    {
        return $this->_setLastError(null, pg_last_error($this->link), $query);
    }

}


class DbSimple_Postgresql_Blob extends DbSimple_Generic_Blob
{
    var $blob; // resourse link
    var $id;
    var $database;

    function DbSimple_Postgresql_Blob(&$database, $id=null)
    {
        $this->database =& $database;
        $this->database->transaction();
        $this->id = $id;
        $this->blob = null;
    }

    function read($len)
    {
        if ($this->id === false) return ''; // wr-only blob
        if (!($e=$this->_firstUse())) return $e;
        $data = @pg_lo_read($this->blob, $len);
        if ($data === false) return $this->_setDbError('read');
        return $data;        
    }

    function write($data)
    {
        if (!($e=$this->_firstUse())) return $e;
        $ok = @pg_lo_write($this->blob, $data);
        if ($ok === false) return $this->_setDbError('add data to');
        return true;
    }

    function close()
    {
        if (!($e=$this->_firstUse())) return $e;
        if ($this->blob) {
            $id = @pg_lo_close($this->blob);
            if ($id === false) return $this->_setDbError('close');
            $this->blob = null;
        } else {
            $id = null;
        }
        $this->database->commit();
        return $this->id? $this->id : $id;
    }

    function length()
    {
        if (!($e=$this->_firstUse())) return $e;

        @pg_lo_seek($this->blob, 0, PGSQL_SEEK_END);
        $len = @pg_lo_tell($this->blob);
        @pg_lo_seek($this->blob, 0, PGSQL_SEEK_SET);

        if (!$len) return $this->_setDbError('get length of');
        return $len;
    }

    function _setDbError($query)
    {
        $hId = $this->id === null? "null" : ($this->id === false? "false" : $this->id);
        $query = "-- $query BLOB $hId"; 
        $this->database->_setDbError($query);        
    }

    // Called on each blob use (reading or writing).
    function _firstUse()
    {
        // BLOB opened - do nothing.
        if (is_resource($this->blob)) return true;

        // Open or create blob.
        if ($this->id !== null) {
            $this->blob = @pg_lo_open($this->database->link, $this->id, 'rw');
            if ($this->blob === false) return $this->_setDbError('open'); 
        } else {
            $this->id = @pg_lo_create($this->database->link);
            $this->blob = @pg_lo_open($this->database->link, $this->id, 'w');
            if ($this->blob === false) return $this->_setDbError('create');
        }
        return true;
    }
}
?>