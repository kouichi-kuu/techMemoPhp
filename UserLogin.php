<?php
require_once dirname(__FILE__) . '/cors.php';
require_once dirname(__FILE__) . '/database.php';
require_once dirname(__FILE__) . '/SessionManager.php';

class UserLogin
{
    private $session;
    private $db;

    public function __construct($db)
    {
        $this->session = new SessionManager();
        $this->db = $db;
    }

    public function userLogin()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';
        try {
            $stmt = $this->db->prepare("SELECT * FROM loginUser WHERE email=?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && password_verify($password, $user['password'])) {
                $this->session->set('userId', $user['id']);
                $this->session->set('userName', $user['name']);
                // デバッグログ
                error_log("LOGIN SUCCESS - SESSION ID: " . session_id());
                error_log("SESSION CONTENT: " . print_r($_SESSION, true));
                echo json_encode(['success' => true, 'message' => 'ログイン成功' . $_SESSION['userId']]);
            } else {
                echo json_encode(['success' => false, 'message' => 'メールアドレスまたはパスワードが間違っています']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'DBエラー：' . $e->getMessage()]);
        }
    }
}

$db = new Database();
$userLogin = new UserLogin($db);
$userLogin->userLogin();
