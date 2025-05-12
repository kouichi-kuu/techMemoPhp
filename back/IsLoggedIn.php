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
            //echo json_encode(['loggedIn' => true, 'userName' => $this->session->get('userName'), 'userId' => $this->session->get('userId')]);
            return ['logIs' => true];
        } else {
            //echo json_encode(['loggedIn' => false, 'message' => 'ログイン情報取得失敗']);
            return ['logIs' => false];
        }
    }
}

$isLoggedIn = new IsLoggedIn();
$isLoggedIn->logCheck();
