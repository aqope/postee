<?php

class Core_Utils_Cookie
{
    private $_defaultLifeTime;

    public function __construct($_name = "", $_value = "", $_lifetime = "")
    {
        $this->_defaultLifeTime = 60 * 60 * 4; // 4 hours
        if (empty($_name) || empty($_value) || empty($_lifetime)) {
            // skip entry
        }
    }

    public function addCookie($_name, $_value, $_lifetime = "")
    {
        if ($_lifetime == "") {
            $_lifetime = $this->_defaultLifeTime;
        }
        setcookie(
            $_name,
            $_value,
            time() + $_lifetime,
            "/"
        );
    }

    public function getCookie($_name)
    {
        if (!empty($_COOKIE[$_name])) {
            return $_COOKIE[$_name];
        } else {
            return false;
        }
    }
}