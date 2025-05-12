<?php
require_once dirname(__FILE__) . '/cors.php';
require_once dirname(__FILE__) . '/database.php';
header('Content-Type: application/json');

try {
    $db = new Database(); // PDOインスタンス取得

    // リクエストのJSONを取得
    $data = json_decode(file_get_contents("php://input"), true);
    $name = trim($data['name'] ?? '');
    $email = trim($data['email'] ?? '');
    $password = trim($data['password'] ?? '');

    // 入力チェック
    if (!$email || !$password) {
        echo json_encode(['success' => false, 'message' => 'メールアドレスとパスワードは必須です']);
        exit;
    }

    // 重複チェック
    $stmt = $db->prepare("SELECT COUNT(*) FROM loginUser WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetchColumn() > 0) {
        echo json_encode(['success' => false, 'message' => 'このメールアドレスはすでに登録されています']);
        exit;
    }

    // パスワードをハッシュ化
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // 登録処理
    $stmt = $db->prepare("INSERT INTO loginUser (name, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $hashedPassword]);

    echo json_encode(['success' => true, 'message' => '登録成功']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'DBエラー: ' . $e->getMessage()]);
}
