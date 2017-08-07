<?php
class AUTH {
    var $DB;
    var $config;
    var $user = array(
     'id'    => -1,
     'username'  => 'Guest',
     'g_id' => 1
    );

    function AUTH($DB,$config)
    {
        global $_SERVER;
        $this->DB = $DB;
        $this->config = $config;
        $this->check();
        $this->user['ip'] = $_SERVER['REMOTE_ADDR'];
        if($this->config['onlinelist_on']){
            if($this->user['id']<1)$this->onlinelist_addguest();
            else $this->onlinelist_add();
            $this->onlinelist_update();
        }
        //$this->lastvisit_update($this->user);
    }

    function check()
    {
        if(isset($_COOKIE[$this->config['site_cookie']])){
            list($cookie['user_id'], $cookie['I_hash']) = @unserialize(stripslashes($_COOKIE[$this->config['site_cookie']]));
            if($cookie['user_id'] < 1)return false;
            $res = $this->DB->selectRow("
                SELECT * FROM account
                LEFT JOIN account_extend ON account.id=account_extend.account_id
                LEFT JOIN account_groups ON account_extend.g_id=account_groups.g_id
                WHERE id = ?d", $cookie['user_id']);
            if(get_banned($res[id], 1)== TRUE){
                $this->setgroup();
                $this->logout();
                output_message('alert','Your account is currently banned');
                return false;
            }
            if($res['activation_code'] != null){
                $this->setgroup();
                output_message('alert','Your account is not active');
                return false;
            }
            if($cookie['I_hash'] == $this->gethash($res['sha_pass_hash'])){
                unset($res['sha_pass_hash']);
                $this->user = $res;
                return true;
            }else{
                $this->setgroup();
                return false;
            }
        }else{
            $this->setgroup();
            return false;
        }
    }

    function setgroup($gid=1) // 1 - guest, 5- banned
    {
        $guest_g = $this->getgroup($gid);
        $this->user = array_merge($this->user,$guest_g);
    }

    function login($params)
    {
        $success = 1;
        if (empty($params)) return false;
        if (empty($params['username'])){
            output_message('alert','You did not provide your username');
            $success = 0;
        }
        if (empty($params['sha_pass_hash'])){
            output_message('alert','You did not provide your password');
            $success = 0;
        }
        $res = $this->DB->selectRow("
            SELECT `id`,`username`,`sha_pass_hash`,`locked` FROM `account`
            WHERE `username` = ?", $params['username']);
        if($res['id'] < 1){$success = 0;output_message('alert','Bad username');}
        if(get_banned($res[id], 1)== TRUE){
            output_message('alert','Your account is currently banned');
            $success = 0;
        }
        if($res['activation_code'] != null){
            output_message('alert','Your account is not active');
            $success = 0;
        }
        if($success!=1) return false;
        if($this->gethash($res['sha_pass_hash']) == $this->gethash($params['sha_pass_hash'])){
            $this->user['id'] = $res['id'];
            $this->user['name'] = $res['username'];
            $this->user['level'] = $res['gmlevel'];
            $uservars_hash = serialize(array($res['id'], $this->gethash($params['sha_pass_hash'])));
            setcookie($this->config['site_cookie'], $uservars_hash, time()+(60*60*24*365),$this->config['site_href'],$this->config['site_domain']); // expires in 365 days
            if($this->config['onlinelist_on'])$this->onlinelist_delguest(); // !!
            return true;
        }else{
            output_message('alert','Your password is incorrect');
            return false;
        }
    }

    function logout()
    {
        setcookie($this->config['site_cookie'], '', time()-3600,$this->config['site_href'],$this->config['site_domain']);
        if($this->config['onlinelist_on'])$this->onlinelist_del(); // !!
    }

    function check_pm()
    {
        
        return $result;
    }
    /*
    function lastvisit_update($uservars)
    {
        if($uservars['id']>0){
            if(time() - $uservars['last_visit'] > 60*10){
                $this->DB->query("UPDATE members SET last_visit=?d WHERE id=?d LIMIT 1",time(),$uservars['id']);
            }
        }
    }
    */
    function register($params)
    {
        $success = 1;
        if(empty($params)) return false;
        if(empty($params['username'])){
            output_message('alert','You did not provide your username');
            $success = 0;
        }
        if(empty($params['sha_pass_hash']) || $params['sha_pass_hash']!=$params['I2']){
            output_message('alert','You did not provide your password or confirm pass');
            $success = 0;
        }
        if(empty($params['email'])){
            output_message('alert','You did not provide your email');
            $success = 0;
        }

        if($success!=1) return false;
        unset($params['I2']);
        //$params['password'] = $this->gethash($params['password']);
        if((bool)$this->config['req_reg_act']===true){
            $tmp_act_key = $this->generate_key();
            $params['locked'] = 1;
            if($acc_id = $this->DB->query("INSERT INTO account SET ?a",$params)){
                $this->DB->query("INSERT INTO account_extend SET account_id=?d, registration_ip=?, activation_code=?",$acc_id,$_SERVER['REMOTE_ADDR'],$tmp_act_key);
                $act_link = $this->config['base_href'].'index.php?n=account&sub=activate&id='.$acc_id.'&key='.$tmp_act_key;
                $email_text  = '== Account activation =='."\n\n";
                $email_text .= 'Login: '.$params['username']."\n";
                $email_text .= 'Password: '.$params['sha_pass_hash']."\n";
                $email_text .= 'This is your activation key: '.$tmp_act_key."\n";
                $email_text .= 'CLICK HERE : '.$act_link."\n";
                send_email($params['email'],$params['username'],'== '.$this->config['site_title'].' account activation ==',$email_text);
                return true;
            }else{
                return false;
            }
        }else{
            if($acc_id = $this->DB->query("INSERT INTO account SET ?a",$params)){
                $this->DB->query("INSERT INTO account_extend SET account_id=?d, registration_ip=?",$acc_id,$_SERVER['REMOTE_ADDR']);
   	          //$this->DB->query("UPDATE account SET `tbc` = '1' WHERE `id`=$acc_id");
                return true;
            }
            else{
                return false;
            }
        }
    }

    function isavailableusername($username){
        $res = $this->DB->selectCell("SELECT count(*) FROM account WHERE username=?",$username);
        if($res < 1) return true; // username is available
        return false; // username is not available
    }

    function isavailableemail($email){
        $res = $this->DB->selectCell("SELECT count(*) FROM account WHERE email=?",$email);
        if($res < 1) return true; // email is available
        return false; // email is not available
    }
    function isvalidemail($email){
        if(preg_match('#^.{1,}@.{2,}\..{2,}$#', $email)==1){
            return true; // email is valid
        }else{
            return false; // email is not valid
        }
    }
    function isvalidregkey($key){
        $res = $this->DB->selectCell("SELECT count(*) FROM site_regkeys WHERE `key`=?",$key);
        if($res > 0) return true; // key is valid
        return false; // key is not valid
    }
    function isvalidactkey($key){
        $res = $this->DB->selectCell("SELECT account_id FROM account_extend WHERE activation_code=?",$key);
        if($res > 0) return $res; // key is valid
        return false; // key is not valid
    }
    function generate_key()
    {
        $str = microtime(1);
        return sha1(base64_encode(pack("H*", md5(utf8_encode($str)))));
    }
    function generate_keys($n)
    {
        set_time_limit(600);
        for($i=1;$i<=$n;$i++)
        {
            if($i>1000)exit;
            $keys[] = $this->generate_key();
            $slt = rand(15000, 500000);
            usleep($slt);
            //sleep(1);
        }
        return $keys;
    }
    function delete_key($key){
        $this->DB->query("DELETE FROM site_regkeys WHERE `key`=?",$key);
    }
    function getprofile($acct_id=false){
        $res = $this->DB->selectRow("
            SELECT * FROM account
            LEFT JOIN account_extend ON account.id=account_extend.account_id
            LEFT JOIN account_groups ON account_extend.g_id=account_groups.g_id
            WHERE id=?d",$acct_id);
        return $res;
    }
    function getgroup($g_id=false){
        $res = $this->DB->selectRow("SELECT * FROM account_groups WHERE g_id=?d",$g_id);
        return $res;
    }
    function parsesettings($str){
        $set_pre = explode("\n",$str);
        foreach($set_pre as $set_str){$set_str_arr = explode('=',$set_str); $set[$set_str_arr[0]] = $set_str_arr[1]; }
        return $set;
    }
    function getlogin($acct_id=false){
        $res = $this->DB->selectCell("SELECT username FROM account WHERE id=?d",$acct_id);
        if($res == null) return false;  // no such account
        return $res;
    }
    function getid($acct_name=false){
        $res = $this->DB->selectCell("SELECT id FROM account WHERE username=?",$acct_name);
        if($res == null) return false;  // no such account
        return $res;
    }
    function gethash($str=false){
        if($str)return sha1(base64_encode(md5(utf8_encode($str)))); // Returns 40 char hash.
        else return false;
    }

    // ONLINE FUNCTIONS //
    function onlinelist_update()  // Updates list & delete old
    {
        global $users_online, $guests_online;
        $guests_online=0;
        $rows  = $this->DB->select("SELECT * FROM `online`");
        foreach($rows as $result_row)
        {
            if(time()-$result_row['logged'] <= 60*10)
            {
                if($result_row['user_id']>0){$users_online[] = $result_row['user_name'];}else{$guests_online++;}
            }
            else
            {
                $this->DB->query("DELETE FROM `online` WHERE `id`=? LIMIT 1",$result_row['id']);
            }
        }
        //db_query("UPDATE `acm_config` SET `val`='".time()."' WHERE `key`='last_onlinelist_update' LIMIT 1");
        // update_settings('last_onlinelist_update',time());
    }

    function onlinelist_add() // Add or update list with new user
    {
        global $user;
        global $__SERVER;

        $cur_time = time();
        $result = $this->DB->selectCell("SELECT count(*) FROM `online` WHERE `user_id`=?",$this->user['id']);
        if($result>0)
        {
            $this->DB->query("UPDATE `online` SET `user_ip`=?,`logged`=?,`currenturl`=? WHERE `user_id`=? LIMIT 1",$this->user['ip'],$cur_time,$__SERVER['REQUEST_URI'],$this->user['id']);
        }
        else
        {
            $this->DB->query("INSERT INTO `online` (`user_id`,`user_name`,`user_ip`,`logged`,`currenturl`) VALUES (?,?,?,?,?)",$this->user['id'],$this->user['username'],$this->user['ip'],$cur_time,$__SERVER['REQUEST_URI']);
        }
    }

    function onlinelist_del() // Delete user from list
    {
        global $user;
        $this->DB->query("DELETE FROM `online` WHERE `user_id`=? LIMIT 1",$this->user['id']);
    }

    function onlinelist_addguest() // Add or update list with new guest
    {
        global $user;
        global $__SERVER;

        $cur_time = time();
        $result = $this->DB->selectCell("SELECT  count(*) FROM `online` WHERE `user_id`='0' AND `user_ip`=?",$this->user['ip']);
        if($result>0)
        {
            $this->DB->query("UPDATE `online` SET `user_ip`=?,`logged`=?,`currenturl`=? WHERE `user_id`='0' AND `user_ip`=? LIMIT 1",$this->user['ip'],$cur_time,$__SERVER['REQUEST_URI'],$this->user['ip']);
        }
        else
        {
            $this->DB->query("INSERT INTO `online` (`user_ip`,`logged`,`currenturl`) VALUES (?,?,?)",$this->user['ip'],$cur_time,$__SERVER['REQUEST_URI']);
        }
    }

    function onlinelist_delguest() // Delete guest from list
    {
        global $user;
        $this->DB->query("DELETE FROM `online` WHERE `user_id`='0' AND `user_ip`=? LIMIT 1",$this->user['ip']);
    }
}
?>
