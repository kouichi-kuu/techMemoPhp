<?php
require_once dirname(__FILE__) . '/cors.php';
require_once dirname(__FILE__) . '/database.php';
require_once dirname(__FILE__) . '/IsLoggedIn.php';

class DeleteItem
{
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function deleteItemData()
    {
        try {
            $param = $_GET['item'] ?? "";
            /**
             * @param INPUT_GET:GETやPOSTなどに応じて変更
             * @param item:変数名　$_GET['item']から指定
             * @param FILTER_VALIDATE_INT:フィルター定数：バリデーションやサニタイズの種類を指定
             */
            //バリデーションチェック（整数）
            $param = filter_input(INPUT_GET, 'item', FILTER_VALIDATE_INT);
            if ($param === false) {
                echo json_encode(['message' => '不正なIDです']);
                return;
            }
            $stmt = $this->db->prepare("DELETE FROM techMemo WHERE id=?");
            $stmt->execute([$param]);
            echo json_encode(['message' => '消去成功']);
        } catch (PDOException $e) {
            echo json_encode(['message' => '消去失敗: ' . $e->getMessage()]);
        }
    }
}

$isLoggedIn = new IsLoggedIn();
$islogged = $isLoggedIn->logCheck();
if ($islogged['logIs']) {
    $db = new Database();
    $deleteItem = new DeleteItem($db);
    $deleteItem->deleteItemData();
} else {
    echo json_encode(['message' => 'ログインされていません']);
}
