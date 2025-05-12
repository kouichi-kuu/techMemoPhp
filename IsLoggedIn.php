<?php
require_once dirname(__FILE__) . '/cors.php';
require_once dirname(__FILE__) . '/SessionManager.php';

class IsLoggedIn
{
    private $session;

    public function __construct()
    {
        $this->session = new SessionManager();
    }

    public function logCheck()
    {
        if ($this->session->has('userId')) {
            return ['logIs' => true];
        } else {
            return ['logIs' => false];
        }
    }
}

// $isLoggedIn = new IsLoggedIn();
// $isLoggedIn->logCheck();
