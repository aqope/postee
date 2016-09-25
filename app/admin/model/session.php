<?php

class Admin_Model_Session extends Admin_Model_Admin
{
    protected $_table;
    protected $_session_table;
    protected $_query;
    protected $_public_key;

    public function __construct()
    {

        $this->_session_table = 'admin_session';
    }

    public function isLogged()
    {
        $sessionCollection = $this->addSelect()
            ->load()
            ->getCollection();

        if (empty($sessionCollection)) {
            return false;
        } else {
            foreach ($sessionCollection as $sessionItem) {
                if ($sessionItem['publickey'] == Router::$_url_data['key'] &&
                    $sessionItem['cookiekey'] == $_COOKIE['key']
                ) {
                  return true;
                }
            }
            return false;
        }
    }

    public function createSession($_username, $_password)
    {
        $userModel = Core_Core::getModel('admin/user');
        $userCollection = $userModel->addAuthorizeSelect($_username)
            ->load()
            ->getCollection();
        $matchFound = false;

        foreach($userCollection as $user) {
            if ($user['username'] == $_username &&
                $user['role'] == 'admin' &&
                $user['password'] == $_password) {
                $matchFound = true;
                break;
            }
        }

        if ($matchFound) {
            $publicKey = md5($this->generateSessionCode(8));
            $cookieKey = md5($this->generateSessionCode(8));

            $this->addInsert($publicKey, $cookieKey, $_username)
                ->insert();

            $this->_public_key = $publicKey;
            $cookie = new Core_Utils_Cookie();
            $cookie->addCookie('key', $cookieKey, 600);
        } else {
            // throw an exception that user does not exists
        }
    }
    public function updateSessionCookie()
    {
        $cookieKey = $_COOKIE['key'];
        $cookie = new Core_Utils_Cookie();
        $cookie->addCookie('key', $cookieKey, 600);
    }

    public function addSelect()
    {
        $this->_query = "SELECT * 
            FROM `admin_session`;";

        return $this;
    }

    public function addInsert($_pubKey, $_cookKey, $_user)
    {
        $this->_query = "INSERT INTO `" . $this->_session_table . "` 
        (`publickey`, `cookiekey`, `username`) 
        VALUES('". $_pubKey ."', '" . $_cookKey ."', '". $_user ."')";

        return $this;
    }

    public function insert()
    {
        $sql = new Core_Utils_Sql();
        $result = $sql->runQuery($this->_query);
    }

    public function load()
    {
        $sql = new Core_Utils_Sql();
        $result = $sql->runQuery($this->_query);
        $_collection = array();

        while($row = $result->fetch_assoc()) {
            array_push($_collection, array(
                'publickey' => $row['publickey'],
                'cookiekey' => $row['cookiekey'],
                'username' => $row['username']
            ));
        }

        $this->_collection = $_collection;
        return $this;
    }

    public function generateSessionCode($_length = 8)
    {
        $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($characters) - 1;

        while (strlen($code) < $_length) {
            $code .= $characters[mt_rand(0,$clen)];
        }
        return $code;
    }

    public function getPublicKey()
    {
        if ($this->_public_key) {
            return $this->_public_key;
        } else {
            return "";
        }
    }
}