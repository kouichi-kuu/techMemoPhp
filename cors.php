<?php
//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Origin: https://superb-tiramisu-0ce30d.netlify.app");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // 必要なHTTPメソッド
header("Access-Control-Allow-Headers: Content-Type, Accept"); // Content-Type を許可

// プリフライトリクエスト（OPTIONS）対応
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// セッションCookieの属性を明示的に設定（クロスドメイン対応）
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => 'long-life-3548.littlestar.jp', // ←実際のサーバードメイン
    'secure' => true, // HTTPS必須
    'httponly' => true,
    'samesite' => 'None', // クロスドメインでCookie送信を許可
]);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
