<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//use License;

class Install extends CI_Controller {

    // Email and Password gets displayed at the end of the installer
    var $admin_password = '';
    var $admin_email = '';
    // Some database defaults and information that needs tracking throughout the process
    var $db_driver = 'mysql';
    var $db_prefix = '';
    // Figured out in the constructor and needed for the install process
    var $base_url = '';

    /**
     * Constructor
     * 
     * @access	public
     * @return	void
     */
    function __construct() {
        parent::__construct();
        if ($this->config->item('installed') != 'no') {
//			show_404();
            redirect(base_url() . 'login');
        }
        // used for redirect
        $this->load->helper('url');
        // used to track the status of db connection
        $this->load->library('session');
    }

    /**
     * First Step
     *
     * We check if the server can be used to install NAB
     *
     * @access	public
     * @param	bool
     * @return	mixed
     */
    function index() {

        $data['install_warnings'] = array();

        // is PHP version ok?
        if (!is_php('5.0')) {
            $data['install_warnings'][] = 'PHP version too old';
        }

        // is config file writable? we need to be sure of this before start
        if (is_really_writable($this->config->config_path) && !@chmod($this->config->config_path, FILE_WRITE_MODE)) {
            $data['install_warnings'][] = 'config.php file is not writable';
        }

        // Is there a database.php file?
        if (@include($this->config->database_path)) {
            // let's test if the data contained in the file was setup before
            if ($this->_test_mysql_connection($db[$active_group])) {
                // we have a connection here! save that info in the session
                $this->session->set_userdata('database_connected', TRUE);
            } else {
                // Ensure the session isn't remembered from a previous test
                $this->session->set_userdata('database_connected', FALSE);

                // We couldn't connect to the database, we need to check if we can write the database.php file.
                @chmod($this->config->database_path, FILE_WRITE_MODE);

                if (is_really_writable($this->config->database_path) === FALSE) {
                    $data['install_warnings'][] = 'database file unwritable';
                }
            }
        } else {
            // There is no database.php file :(
            $data['install_warnings'][] = 'database.php file not found';
        }

        // No errors? let's move to the next step
        if (count($data['install_warnings']) == 0) {
            redirect(base_url().'install/validate');
        } else {
            $data['title'] = 'Install problems';
            $data['content'] = $this->load->view('install/warnings', $data, TRUE);
            $this->load->view('template', $data);
        }
    }

    function validate($mode) {
        if ($mode == 'confirm') {
            $padl = new License(false, false, true, false);
            $server_array = $_SERVER;
            $padl->setServerVars($server_array);

            $license = $this->input->post('key');
            $results = $padl->validate($license);
            $this->session->set_userdata('result', $results['RESULT']);
//            exit($this->session->userdata('result'));
            if ($results['RESULT'] == 'INVALID' || $results['RESULT'] == 'EMPTY' || $results['RESULT'] == 'INVALID_DOMAIN') {
                redirect(base_url().'install/validate');
            } else {
                $this->session->set_userdata('license', $license);
                redirect(base_url().'install/userinfo');
            }
        }
        $data['content'] = $this->load->view('install/validate', $data, TRUE);
        $this->load->view('template', $data);
    }

    function userinfo($mode) {
        if ($this->session->userdata('result') != 'OK' || !$this->session->userdata('result')) {
            redirect(base_url().'install/validate');
        }
        if ($mode == 'confirm') {
            $admin_email = $this->input->post('admin_email');
            $admin_password = $this->input->post('admin_password');

            $this->session->set_userdata('admin_email', $admin_email);
            $this->session->set_userdata('admin_password', $admin_password);
            redirect(base_url().'install/database');
        }
        $data['content'] = $this->load->view('install/userinfo', $data, TRUE);
        $this->load->view('template', $data);
    }

    function database() {
        if ($this->session->userdata('result') != 'OK' || !$this->session->userdata('result')) {
            redirect(base_url().'install/validate');
        }
        $data['content'] = $this->load->view('install/database', $data, TRUE);
        $this->load->view('template', $data);        
    }

    /**
     * Start (firts and only step)
     *
     * The install process unique step
     *
     * @access	public
     * @return	string
     */
    function start() {
        if ($this->session->userdata('result') != 'OK' || !$this->session->userdata('result')) {
            redirect(base_url().'install/validate');
        }
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_message('required', '%s field is required');

        if ($this->session->userdata('database_connected') === FALSE) {
            $data['database_connected'] = FALSE;
            // to keep forms in the form_validation.php file we set here the validation rules to use

            $this->form_validation->set_rules('host', 'host', 'required');
            $this->form_validation->set_rules('database', 'database', 'required');
            $this->form_validation->set_rules('user', 'user', 'required');
            $this->form_validation->set_rules('password', 'Password', 'callback__test_mysql_connection');
            $this->form_validation->set_rules('admin_email', 'admin', 'required|max_length[60]|valid_email');
            $this->form_validation->set_rules('admin_password', 'admin password', 'required');

            $this->form_validation->set_message('_test_mysql_connection', 'unable to connect to mysql');
        } else {
            $data['database_connected'] = TRUE;
            $this->form_validation->set_rules('admin_email', 'admin', 'required|max_length[60]|valid_email');
            $this->form_validation->set_rules('admin_password', 'admin password', 'required');
        }

        if ($this->form_validation->run() == TRUE) {
            $data = $this->_install_database();
            $this->session->set_userdata('messages', $data);
            $data['title'] = 'Installed!';
            $data['content'] = $this->load->view('install/success', $data, TRUE);
            $this->load->view('template', $data);
        } else {
            $data['msg'] = validation_errors('<h3>', '</h3>');
            $data['title'] = 'Welcome to our installer';
            $data['content'] = $this->load->view('install/database', $data, TRUE);
            $this->load->view('template', $data);
        }
    }

    // --------------------------------------------------------------------

    /**
     * DB Driver Test
     *
     * Test a given driver to ensure the server can use it. We'll also create the
     * database here if we need to.
     *
     * @access	private
     * @param	array
     * @return	bool
     */
    function _test_mysql_connection($config_db) {
        if (!is_array($config_db)) {
            $config_db = array();
            $config_db['hostname'] = $this->input->post('host');
            $config_db['username'] = $this->input->post('user');
            $config_db['password'] = $this->input->post('password');
            $config_db['database'] = $this->input->post('database');
            $config_db['dbdriver'] = 'mysql';
        }
        // Unset any existing DB information
        unset($this->db);

        // Explicitly set debugging to FALSE to avoid CI throwing errors if its wrong
        $config_db['db_debug'] = FALSE;

        // load based on custom passed information
        $this->load->database($config_db);

        if (is_resource($this->db->conn_id) OR is_object($this->db->conn_id)) {
            // There is a connection

            $this->load->dbutil();

            // Now then, does the DB exist?
            if ($this->dbutil->database_exists($this->db->database)) {
                // Connected and found the db. Happy days are here again!
                return TRUE;
            } else {
                $this->load->dbforge();

                if ($this->dbforge->create_database($this->db->database)) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        } else {
            return FALSE;
        }
    }

    // --------------------------------------------------------------------

    /**
     * Do Install
     *
     * What it says on the tin! Installs the software
     *
     * @access	private
     * @return	mixed
     */
    function _install_database() {
        // Set up a variable to hold user notices.
        $data['messages'] = array();

        if ($this->input->post('db_prefix')) {
            $this->db_prefix = $this->input->post('db_prefix');
        }


        if (!$this->_setup_database()) {
            show_error('database file is not writable');
        }


        unset($this->db);
        $this->load->database();
        $this->load->dbforge();

        $this->load->model('install_model');
        //$this->setup_model->add_tables();
        $this->admin_password = $this->input->post('admin_password');
        $this->admin_email = $this->input->post('admin_email');

        $this->install_model->use_sql_string($this->admin_email, $this->admin_password);

//        if (!$this->config->config_update(array('encryption_key' => 'nab_' . random_string('alnum'), 'base_url' => $this->base_url))) {
//            log_message('debug', 'Not able to write config file in _install_database');
//        }

        $this->config->config_update(array('uri_protocol' => "QUERY_STRING"));
        $this->config->config_update(array('license' => $this->session->userdata('license')));
        
//        $this->config->routes_config_update(array('default_controller' => "login"));

        if (!$this->config->config_update(array('installed' => "yes"))) {
            $data['messages'][] = 'installed and locked';
        }

        @chmod($this->config->config_path, FILE_READ_MODE);
        @chmod($this->config->database_path, FILE_READ_MODE);


        $data['messages'][] = ' we are done! login using email: (' . $this->admin_email . ') and password: (<strong>' . $this->admin_password . '</strong>)';

        return $data;
    }

    /**
     * Setup Database (only MySQL supported now)
     *
     *
     * @access	private
     * @return	bool
     */
    function _setup_database() {
        if ($this->session->userdata('database_connected')) {
            return TRUE;
        } else {
            if (@include($this->config->database_path)) {
                if ($this->_test_mysql_connection($db[$active_group])) {
                    return TRUE;
                }
            }
        }

        $_db['hostname'] = $this->input->post('host');
        $_db['username'] = $this->input->post('user');
        $_db['password'] = $this->input->post('password');
        $_db['database'] = $this->input->post('database');
        $_db['dbdriver'] = $this->db_driver;
        $_db['dbprefix'] = $this->db_prefix;

        // Update config/database.php file
        return $this->config->db_config_update($_db);
    }

}

/* End of file install.php */
/* Location: ./application/controllers/install.php */

class License {

    protected $hashKey1 = 'YmUzYWM2sNGU24NbA363zA7IDSDFGDFGB5aVi35BDFGQ3YNO36ycDFGAATq4sYmSFVDFGDFGps7XDYEzGDDw96OnMW3kjCFJ7M+UV2kHe1WTTEcM09UMHHT';
    protected $hashKey2 = '80dSbqylf4Cu5e5OYdAoAVkzpRDWAt7J1Vp27sYDU52ZBJprdRL1KE0il8KQXuKCK3sdA51P9w8U60wohX2gdmBu7uVhjxbS8g4y874Ht8L12W54Q6T4R4a';
    protected $hashKey3 = 'ant9pbc3OK28Li36Mi4d3fsWJ4tQSN4a9Z2qa8W66qR7ctFbljsOc9J4wa2Bh6j8KB3vbEXB18i6gfbE0yHS0ZXQCceIlG7jwzDmN7YT06mVwcM9z0vy62T';
    protected $useMcrypt = true;
    protected $algorithm = 'blowfish';
    protected $useTime;
    protected $startDif = 129600;
    protected $id1 = 'nSpkAHRiFfM2hE588eB';
    protected $id2 = 'NWCy0s0JpGubCVKlkkK';
    protected $id3 = 'G95ZP2uS782cFey9x5A';
    protected $begin1 = 'BEGIN LICENSE KEY';
    protected $end1 = 'END LICENSE KEY';
    protected $wrapto = 80;
    protected $pad = "-";
    protected $begin2 = '_DATA{';
    protected $end2 = '}DATA_';
    protected $data = array();
    protected $useServer;
    protected $serv;
    protected $mac;
    protected $allowLocal;
    protected $serverInfo = array();
    protected $serverVars = array();
    protected $ips = array();
    protected $requiredUris = 2;
    protected $dateString = 'M/d/Y H:i:s';
    protected $allowedServerDifs = 0;
    protected $allowedIpDifs = 0;

    public function __construct($useMcrypt = true, $useTime = true, $useServer = true, $allowLocal = false) {
        $this->init($useMcrypt, $useTime, $useServer, $allowLocal);
        if ($this->useServer) {
            $this->mac = $this->getMacAddress();
        }
    }

    public function init($useMcrypt = true, $useTime = true, $useServer = true, $allowLocal = false) {
        $this->useMcrypt = ($useMcrypt && function_exists('mcrypt_generic'));
        $this->useTime = $useTime;
        $this->allowLocal = $allowLocal;
        $this->useServer = $useServer;
    }

    public function setServerVars($array) {
        $this->serverVars = $array;
        // some of the ip data is dependant on the $server vars, so update them
        // after the vars have been set
        $this->ips = $this->getIpAddress();
        // update the server info
        $this->serverInfo = $this->getServerInfo();
    }

    public function validate($license) {
        return $this->doValidate($license);
    }

    public function validateRemote($license, $dialhost, $dialpath, $dialport = "80") {
        return $this->doValidate($license, true, $dialhost, $dialpath, $dialport);
    }

    public function setDateFormat($dateFormat) {
        $this->dateString = $dateFormat;
    }

    public function writeKey($key, $filePath) {
        // open the key file for writeing and truncate
        $h = fopen($filePath, 'w');
        // if write fails return error
        if (fwrite($h, $key) === false) {
            return false;
        }
        // close file
        fclose($h);
        // return key
        return true;
    }

    public function registerInstall($domain, $start, $expireIn, $data, $dialhost, $dialpath, $dialport = '80') {
        // check to see if the class has been secured
        $this->check_secure();

        // check if key is alread generated
        // TODO
        if (@filesize($this->licensePath) > 4) {
            return array('RESULT' => 'KEY_EXISTS');
        }

        $data = array('DATA' => $data);

        // if the server matching is required then get the info
        if ($this->useServer) {
            // evaluate the supplied domain against the collected ips
            if (!$this->compareDomainIp($domain, $this->ips)) {
                return array('RESULT' => 'DOMAIN_IP_FAIL');
            }
            // check server uris
            if (count($this->serverInfo) < $this->requiredUris) {
                return array('RESULT' => 'SERVER_FAIL');
            }
            $data['SERVER']['MAC'] = $this->mac;
            $data['SERVER']['PATH'] = $this->serverInfo;
            $data['SERVER']['IP'] = $this->ips;
            $data['SERVER']['DOMAIN'] = $domain;
        }

        // if use time restrictions
        if ($this->useTime) {
            $current = time();
            $start = ($current < $start) ? $start : $current + $start;
            // set the dates
            $data['DATE']['START'] = $start;
            if ($expireIn === 'NEVER') {
                $data['DATE']['SPAN'] = '~';
                $data['DATE']['END'] = 'NEVER';
            } else {
                $data['DATE']['SPAN'] = $expireIn;
                $data['DATE']['END'] = $start + $expireIn;
            }
        }
        // includethe id for requests
        $data['ID'] = md5($this->id2);
        // post the data home
        $data = $this->postData($dialhost, $dialpath, $data, $dialport);
        // return the result and key if approved
        return (empty($data['RESULT'])) ? array('RESULT' => 'SOCKET_FAILED') : $data;
    }

    protected function doValidate($license, $dialhome = false, $dialhost = "", $dialpath = "", $dialport = "80") {
        //// check to see if the class has been secured
        //$this->check_secure();

        if (strlen($license) > 0) {
            // decrypt the data
            $data = $this->unwrapLicense($license);
            if (is_array($data)) {
                // missing / incorrect id therefore it has been tampered with
                if ($data['ID'] != md5($this->id1)) {
                    $data['RESULT'] = 'CORRUPT';
                }
                if ($this->useTime) {
                    // the license is being used before it's official start
                    if ($data['DATE']['START'] > time() + $this->startDif) {
                        $data['RESULT'] = 'TMINUS';
                    }
                    // the license has expired
                    if ($data['DATE']['END'] - time() < 0 && $data['DATE']['SPAN'] != 'NEVER') {
                        $data['RESULT'] = 'EXPIRED';
                    }
                    $data['DATE']['HUMAN']['START'] = date($this->dateString, $data['DATE']['START']);
                    $data['DATE']['HUMAN']['END'] = date($this->dateString, $data['DATE']['END']);
                }
                if ($this->useServer) {
                    $mac = $data['SERVER']['MAC'] === $this->mac;
                    $path = count(array_diff($this->serverInfo, $data['SERVER']['PATH'])) <= $this->allowedServerDifs;
                    $domain = $this->compareDomainIp($data['SERVER']['DOMAIN'], $this->ips);
                    $ip = count(array_diff($this->ips, $data['SERVER']['IP'])) <= $this->allowedIpDifs;

                    // the server details
//                    if (!$mac || !$path || !$domain || !$ip) {
//                        $data['RESULT'] = 'ILLEGAL';
//                    }
//
//                    // check if local
//                    if (in_array('127.0.0.1', $data['SERVER']['IP']) || $data['PATH']['SERVER_ADDR'] === '127.0.0.1' || $data['PATH']['HTTP_HOST'] === '127.0.0.1') {
//                        if (!$this->allowLocal) {
//                            $data['RESULT'] = 'ILLEGAL_LOCAL';
//                        }
//                    }
                }
                // passed all current test so license is ok
                if (!isset($data['RESULT'])) {
                    $domain = $this->compareDomainIp($data['SERVER']['DOMAIN'], $this->ips);
                    if (!$domain) {
                        $data['RESULT'] = 'INVALID_DOMAIN';
                    }
                    // dial to home server if required
                    else if ($dialhome) {
                        // create the details to send to the home server
                        $stuffToSend = array();
                        $stuffToSend['LICENSE_DATA'] = $data;
                        $stuffToSend['LICENSE_DATA']['KEY'] = md5($license);
                        // dial home
                        $data['RESULT'] = $this->callHome($stuffToSend, $dialhost, $dialpath, $dialport);
                    } else {
                        // result is ok all test passed, license is legal
                        $data['RESULT'] = 'OK';
                    }
                }
                // data is returned for use
                return $data;
            } else {
                // the are two reason that mean a invalid return
                // 1 - the other hash key is different
                // 2 - the key has been tampered with
                return array('RESULT' => 'INVALID');
            }
        }
        // returns empty because there is nothing in the dat_string
        return array('RESULT' => 'EMPTY');
    }

    protected function postData($host, $path, $queryArray, $port = 80) {
        // generate the post query info
        $query = 'POSTDATA=' . $this->encrypt($queryArray, 'HOMEKEY');
        $query .= '&MCRYPT=' . $this->useMcrypt;
        // init the return string
        $return = '';

        // generate the post headers
        $post = "POST $path HTTP/1.1\r\n";
        $post .= "Host: $host\r\n";
        $post .= "Content-type: application/x-www-form-urlencoded\r\n";
        $post .= "Content-length: " . strlen($query) . "\r\n";
        $post .= "Connection: close\r\n";
        $post .= "\r\n";
        $post .= $query;

        // open a socket
        $header = @fsockopen($host, $port);
        if (!$header) {
            // if the socket fails return failed
            return array('RESULT' => 'SOCKET_FAILED');
        }
        @fputs($header, $post);
        // read the returned data
        while (!@feof($header)) {
            $return .= @fgets($header, 1024);
        }
        fclose($header);

        // seperate out the data using the delims
        $leftpos = strpos($return, $this->begin2) + strlen($this->begin2);
        $rightpos = strpos($return, $this->end2) - $leftpos;

        // decrypt and return the data
        return $this->decrypt(substr($return, $leftpos, $rightpos), 'HOMEKEY');
    }

    protected function compareDomainIp($domain, $ips = false) {
        // if no ips are supplied get the ip addresses for the server
        if (!$ips) {
            $ips = $this->getIpAddress();
        }
        // get the domain ip list
        $domainIps = gethostbynamel($domain);
        // loop through the collected ip's searching for matches against the domain ips
        if (is_array($domainIps) && count($domainIps) > 0) {
            foreach ($domainIps as $ip) {
                if (in_array($ip, $ips)) {
                    return true;
                }
            }
        }

        return false;
    }

    protected function pad($str) {
        $strLen = strlen($str);
        $spaces = ($this->wrapto - $strLen) / 2;
        $str1 = '';
        for ($i = 0; $i < $spaces; $i++) {
            $str1 = $str1 . $this->pad;
        }
        if ($spaces / 2 != round($spaces / 2)) {
            $str = substr($str1, 0, strlen($str1) - 1) . $str;
        } else {
            $str = $str1 . $str;
        }
        $str = $str . $str1;

        return $str;
    }

    protected function getKey($keyType) {
        switch ($keyType) {
            case 'KEY':
                return $this->hashKey1;
            case 'REQUESTKEY':
                return $this->hashKey2;
            case 'HOMEKEY':
                return $this->hashKey3;
            default:
            // TODO missing default return!!
        }
    }

    protected function getBegin($keyType) {
        switch ($keyType) {
            case 'KEY':
                return $this->begin1;
            case 'REQUESTKEY':
                return $this->begin2;
            case 'HOMEKEY':
                return '';
        }
    }

    protected function getEnd($keyType) {
        switch ($keyType) {
            case 'KEY':
                return $this->end1;
            case 'REQUESTKEY':
                return $this->end2;
            case 'HOMEKEY':
                return '';
        }
    }

    protected function decrypt($str, $keyType = 'KEY') {
        $randAddOn = substr($str, 0, 3);
        $str = base64_decode(base64_decode(substr($str, 3)));
        // get the key
        $key = $randAddOn . $this->getKey($keyType);

        // check to see if mycrypt exists
        if ($this->useMcrypt) {
            // openup mcrypt
            $td = mcrypt_module_open($this->algorithm, '', 'ecb', '');
            $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
            // process the key
            $key = substr($key, 0, mcrypt_enc_getKey_size($td));
            // init mcrypt
            mcrypt_generic_init($td, $key, $iv);

            // decrypt the data and return
            $decrypt = @mdecrypt_generic($td, $str);

            // shutdown mcrypt
            mcrypt_generic_deinit($td);
            mcrypt_module_close($td);
        } else {
            // if mcrypt doesn't exist use regular decryption method
            // init the decrypt vars
            $decrypt = '';

            // loop through the text and decode the string
            for ($i = 1; $i <= strlen($str); $i++) {
                $char = substr($str, $i - 1, 1);
                $keychar = substr($key, ($i % strlen($key)) - 1, 1);
                $char = chr(ord($char) - ord($keychar));
                $decrypt .= $char;
            }
        }
        // return the key
        return @unserialize($decrypt);
    }

    protected function unwrapLicense($encStr, $keyType = 'KEY') {
        // sort the variables
        $begin = $this->pad($this->getBegin($keyType));
        $end = $this->pad($this->getEnd($keyType));

        // get string without seperators
        $str = trim(str_replace(array($begin, $end, "\r", "\n", "\t"), '', $encStr));

        // decrypt and return the key
        return $this->decrypt($str, $keyType);
    }

    protected function getOsVar($varName, $os) {
        $varName = strtolower($varName);
        // switch between the os's
        switch ($os) {
            // not sure if the string is correct for FreeBSD
            // not tested
            case 'freebsd':
            // not sure if the string is correct for NetBSD
            // not tested
            case 'netbsd':
            // not sure if the string is correct for Solaris
            // not tested
            case 'solaris':
            // not sure if the string is correct for SunOS
            // not tested
            case 'sunos':
            // darwin is mac os x
            // tested only on the client os
            case 'darwin':
                // switch the var name
                switch ($varName) {
                    case 'conf':
                        $var = '/sbin/ifconfig';
                        break;
                    case 'mac':
                        $var = 'ether';
                        break;
                    case 'ip':
                        $var = 'inet ';
                        break;
                }
                break;
            // linux variation
            // tested on server
            case 'linux':
                // switch the var name
                switch ($varName) {
                    case 'conf':
                        $var = '/sbin/ifconfig';
                        break;
                    case 'mac':
                        $var = 'HWaddr';
                        break;
                    case 'ip':
                        $var = 'inet addr:';
                        break;
                }
                break;
        }

        return $var;
    }

    protected function getConfig() {
        if (ini_get('safe_mode')) {
            // returns invalid because server is in safe mode thus not allowing
            // sbin reads but will still allow it to open. a bit weird that one.
            return 'SAFE_MODE';
        }
        // if anyone has any clues for windows environments
        // or other server types let me know
        $os = strtolower(PHP_OS);
        if (substr($os, 0, 3) === 'win') {
            // this windows version works on xp running apache
            // based server. it has not been tested with anything
            // else, however it should work with NT, and 2000 also
            // execute the ipconfig
            @exec('ipconfig/all', $lines);
            // count number of lines, if none returned return MAC_404
            // thanks go to Gert-Rainer Bitterlich <bitterlich -at- ima-dresden -dot- de>
            if (count($lines) === 0) {
                return 'ERROR_OPEN';
            }
            // $path the lines together
            $conf = implode(PHP_EOL, $lines);
        } else {
            // get the conf file name
            $osFile = $this->getOsVar('conf', $os);
            // open the ipconfig
            $fp = @popen($osFile, "rb");
            // returns invalid, cannot open ifconfig
            if (!$fp) {
                return 'ERROR_OPEN';
            }
            // read the config
            $conf = @fread($fp, 4096);
            @pclose($fp);
        }

        return $conf;
    }

    protected function getIpAddress() {
        $ips = array();
        // get the cofig file
        $conf = $this->getConfig();
        // if the conf has returned and error return it
        if ($conf != 'SAFE_MODE' && $conf != 'ERROR_OPEN') {
            // if anyone has any clues for windows environments
            // or other server types let me know
            $os = strtolower(PHP_OS);
            if (substr($os, 0, 3) !== 'win') {
                // explode the conf into seperate lines for searching
                $lines = explode(PHP_EOL, $conf);
                // get the ip delim
                $ipDelim = $this->getOsVar('ip', $os);

                // ip pregmatch
                $num = "(\\d|[1-9]\\d|1\\d\\d|2[0-4]\\d|25[0-5])";
                // seperate the lines
                foreach ($lines as $key => $line) {
                    // check for the ip signature in the line
                    if (!preg_match("/^$num\\.$num\\.$num\\.$num$/", $line) && strpos($line, $ipDelim)) {
                        // seperate out the ip
                        $ip = substr($line, strpos($line, $ipDelim) + strlen($ipDelim));
                        $ip = trim(substr($ip, 0, strpos($ip, " ")));
                        // add the ip to the collection
                        if (!isset($ips[$ip])) {
                            $ips[$ip] = $ip;
                        }
                    }
                }
            }
        }

        // if the conf has returned nothing
        // attempt to use the $server data
        if (isset($this->serverVars['SERVER_NAME'])) {
            $ip = gethostbyname($this->serverVars['SERVER_NAME']);
            if (!isset($ips[$ip])) {
                $ips[$ip] = $ip;
            }
        }
        if (isset($this->serverVars['SERVER_ADDR'])) {
            $name = gethostbyaddr($this->serverVars['SERVER_ADDR']);
            $ip = gethostbyname($name);
            if (!isset($ips[$ip])) {
                $ips[$ip] = $ip;
            }
            // if the $server addr is not the same as the returned ip include it aswell
            if (isset($addr) && $addr != $this->serverVars['SERVER_ADDR']) {
                if (!isset($ips[$this->serverVars['SERVER_ADDR']])) {
                    $ips[$this->serverVars['SERVER_ADDR']] = $this->serverVars['SERVER_ADDR'];
                }
            }
        }
        // count return ips and return if found
        if (count($ips) > 0) {
            return $ips;
        }
        // failed to find an ip check for conf error or return 404
        if ($conf === 'SAFE_MODE' || $conf === 'ERROR_OPEN') {
            return $conf;
        }

        return 'IP_404';
    }

    protected function getMacAddress() {
        // open the config file
        $conf = $this->getConfig();

        // if anyone has any clues for windows environments
        // or other server types let me know
        $os = strtolower(PHP_OS);
        if (substr($os, 0, 3) === 'win') {
            // explode the conf into lines to search for the mac
            $lines = explode(PHP_EOL, $conf);
            // seperate the lines for analysis
            foreach ($lines as $key => $line) {
                // check for the mac signature in the line
                // originally the check was checking for the existence of string 'physical address'
                // however Gert-Rainer Bitterlich pointed out this was for english language
                // based servers only. preg_match updated by Gert-Rainer Bitterlich. Thanks
                if (preg_match("/([0-9a-f][0-9a-f][-:]){5}([0-9a-f][0-9a-f])/i", $line)) {
                    $trimmedLine = trim($line);
                    // take of the mac addres and return
                    return trim(substr($trimmedLine, strrpos($trimmedLine, " ")));
                }
            }
        } else {
            // get the mac delim
            $macDelim = $this->getOsVar('mac', $os);

            // get the pos of the os_var to look for
            $pos = strpos($conf, $macDelim);
            if ($pos) {
                // seperate out the mac address
                $str1 = trim(substr($conf, ($pos + strlen($macDelim))));

                return trim(substr($str1, 0, strpos($str1, "\n")));
            }
        }
        // failed to find the mac address
        return 'MAC_404';
    }

    protected function getServerInfo() {
        if (empty($this->serverVars)) {
            $this->setServerVars($_SERVER);
        }
        // get the server specific uris
        $a = array();
        if (isset($this->serverVars['SERVER_ADDR']) && (!strrpos($this->serverVars['SERVER_ADDR'], '127.0.0.1') || $this->allowLocal)) {
            $a['SERVER_ADDR'] = $this->serverVars['SERVER_ADDR'];
        }
        // corrected by Gert-Rainer Bitterlich <bitterlich -at- ima-dresden -dot- de>, Thanks
        if (isset($this->serverVars['HTTP_HOST']) && (!strrpos($this->serverVars['HTTP_HOST'], '127.0.0.1') || $this->allowLocal)) {
            $a['HTTP_HOST'] = $this->serverVars['HTTP_HOST'];
        }
        if (isset($this->serverVars['SERVER_NAME'])) {
            $a['SERVER_NAME'] = $this->serverVars['SERVER_NAME'];
        }
        if (isset($this->serverVars['PATH_TRANSLATED'])) {
            $a['PATH_TRANSLATED'] = substr($this->serverVars['PATH_TRANSLATED'], 0, strrpos($this->serverVars['PATH_TRANSLATED'], '/'));
        } elseif (isset($this->serverVars['SCRIPT_FILENAME'])) {
            $a['SCRIPT_FILENAME'] = substr($this->serverVars['SCRIPT_FILENAME'], 0, strrpos($this->serverVars['SCRIPT_FILENAME'], '/'));
        }
        if (isset($this->serverVars['SCRIPT_URI'])) {
            $a['SCRIPT_URI'] = substr($this->serverVars['SCRIPT_URI'], 0, strrpos($this->serverVars['SCRIPT_URI'], '/'));
        }

        // if the number of different uris is less than the required amount,
        // fail the request
        if (count($a) < $this->requiredUris) {
            return 'SERVER_FAILED';
        }

        return $a;
    }

    protected function callHome($data, $dialhost, $dialpath, $dialport) {
        // post the data home
        $data = $this->postData($dialhost, $dialpath, $data, $dialport);

        return (empty($data['RESULT'])) ? 'SOCKET_FAILED' : $data['RESULT'];
    }
}