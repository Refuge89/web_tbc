<?php
/**
 * DbSimple_Ibase: Interbase/Firebird database.
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
 * Best transaction parameters for script queries.
 * They never give us update conflicts (unlike others)!
 * Used by default.
 */
define('IBASE_BEST_TRANSACTION', IBASE_COMMITTED + IBASE_WAIT + IBASE_REC_VERSION);
define('IBASE_BEST_FETCH', IBASE_UNIXTIME);

/**
 * Database class for Interbase/Firebird.
 */

class DbSimple_Ibase extends DbSimple_Generic_Database
{
    var $link;
    var $trans;
    var $fetchFlags = IBASE_BEST_FETCH;
    var $bestTrans = IBASE_BEST_TRANSACTION;

    /**
     * constructor(string $dsn)
     * Connect to Interbase/Firebird.
     */
    function DbSimple_Ibase($dsn)
    {
        $p = DbSimple_Generic::parseDSN($dsn);
        if (!is_callable('ibase_connect')) {
            return $this->_setLastError("-1", "Interbase/Firebird extension is not loaded", "ibase_connect");
        }
        $ok = $this->link = ibase_connect(
            $p['host'] . (empty($p['port'])? "" : ":".$p['port']) .':'.preg_replace('{^/}s', '', $p['path']),
            $p['user'],
            $p['pass'],
            isset($p['CHARSET']) ? $p['CHARSET'] : 'win1251',
            isset($p['BUFFERS']) ? $p['BUFFERS'] : 0,
            isset($p['DIALECT']) ? $p['DIALECT'] : 3,
            isset($p['ROLE'])    ? $p['ROLE']    : ''
        );
        $this->_resetLastError();
        if (!$ok) return $this->_setDbError('ibase_connect()');
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
        if ($parameters === null) $parameters = $this->bestTrans;
        $this->trans = ibase_trans($parameters, $this->link);
    }

    function& _performNewBlob($blobid=null)
    {
        $obj =& new DbSimple_Ibase_Blob($this, $blobid);
        return $obj;
    }

    function _performGetBlobFieldNames($result)
    {
        $blobFields = array();
        for ($i=ibase_num_fields($result)-1; $i>=0; $i--) {
            $info = ibase_field_info($result, $i); 
            if ($info['type'] === "BLOB") $blobFields[] = $info['name'];
        }
        return $blobFields;
    }

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
        return ibase_commit($this->trans);
    }


    function _performRollback()
    {
        return ibase_rollback($this->trans);
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
                    (\s* SELECT \s+)                                      #1
                        ((?:FIRST \s+ \S+ \s+ (?:SKIP \s+ \S+ \s+)? )?)   #2 
                    (.*?)                                                 #3
                    (\s+ FROM \s+ .*?)                                    #4
                        ((?:\s+ ORDER \s+ BY \s+ .*)?)                    #5
                $/six';
                $m = null;
                if (preg_match($re, $queryMain[0], $m)) {
                    $queryMain[0] = $m[1] . $this->_fieldList2Count($m[3]) . " AS C" . $m[4];
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
        $result = ibase_query($this->link, $queryMain[0]);
        if ($result === false) return $this->_setDbError($queryMain[0]);
        if (!is_resource($result)) {
            // Non-SELECT queries return number of affected rows, SELECT - resource.
            return @ibase_affected_rows($this->link);
        }
        return $result;
    }

    
    function _performFetch($result)
    {
        // Select fetch mode.
        $flags = $this->fetchFlags;
        if (empty($this->attributes['BLOB_OBJ'])) $flags = $flags | IBASE_TEXT; 
        else $flags = $flags & ~IBASE_TEXT;

        $row = @ibase_fetch_assoc($result, $flags);
        if (ibase_errmsg()) return $this->_setDbError($this->_lastQuery);
        if ($row === false) return null;        
        return $row;
    }
    
    
    function _setDbError($query)
    {
        return $this->_setLastError(ibase_errcode(), ibase_errmsg(), $query);
    }
    
}

class DbSimple_Ibase_Blob extends DbSimple_Generic_Blob
{
    var $blob; // resourse link
    var $id;
    var $database;

    function DbSimple_Ibase_Blob(&$database, $id=null)
    {
        $this->database =& $database;
        $this->id = $id;
        $this->blob = null;
    }

    function read($len)
    {
        if ($this->id === false) return ''; // wr-only blob
        if (!($e=$this->_firstUse())) return $e;
        $data = @ibase_blob_get($this->blob, $len);
        if ($data === false) return $this->_setDbError('read');
        return $data;        
    }

    function write($data)
    {
        if (!($e=$this->_firstUse())) return $e;
        $ok = @ibase_blob_add($this->blob, $data);
        if ($ok === false) return $this->_setDbError('add data to');
        return true;
    }

    function close()
    {
        if (!($e=$this->_firstUse())) return $e;
        if ($this->blob) {
            $id = @ibase_blob_close($this->blob);
            if ($id === false) return $this->_setDbError('close');
            $this->blob = null;
        } else {
            $id = null;
        }
        return $this->id ? $this->id : $id;
    }

    function length()
    {
        if ($this->id === false) return 0; // wr-only blob
        if (!($e=$this->_firstUse())) return $e;
        $info = @ibase_blob_info($this->id);
        if (!$info) return $this->_setDbError('get length of');
        return $info[0];
    }

    function _setDbError($query)
    {
        $hId = $this->id === null ? "null" : ($this->id === false ? "false" : $this->id);
        $query = "-- $query BLOB $hId"; 
        $this->database->_setDbError($query);        
    }

    // Called on each blob use (reading or writing).
    function _firstUse()
    {
        // BLOB is opened - nothing to do.
        if (is_resource($this->blob)) return true;
        // Open or create blob.
        if ($this->id !== null) {
            $this->blob = @ibase_blob_open($this->id);
            if ($this->blob === false) return $this->_setDbError('open'); 
        } else {
            $this->blob = @ibase_blob_create($this->database->link);
            if ($this->blob === false) return $this->_setDbError('create');
        }
        return true;
    }
}

?>