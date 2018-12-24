<?php

namespace Home;

/**
 * Class AuthentificationSession
 *
 * @package Home
 *
 * @author  Seif
 */
class AuthentificationSession
{
    protected $namespace = 'auth';

    public function isAuthenticated()
    {
        return isset($_SESSION[$this->namespace]['user']);

    }

    public function destroyAuthSession()
    {
        unset ($_SESSION[$this->namespace]);
    }

    public function saveSession(BcUser $user)
    {
        $_SESSION[$this->namespace]['user'] = $user->extract();
    }

    public function getCurrentUser()
    {
        if (!$this->isAuthenticated()) {
            return false;
        }
        return $_SESSION[$this->namespace]['user'];
    }
}