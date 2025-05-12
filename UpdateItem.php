<?php
require_once dirname(__FILE__) . '/cors.php';
require_once dirname(__FILE__) . '/database.php';
require_once dirname(__FILE__) . '/JsonReceive.php';
require_once dirname(__FILE__) . '/IsLoggedIn.php';

class UpdateItem
{
    private $db;
    private $jsonReceive;
    private $postJsonData;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function updataItemData()
    {
        try {
            $param = $_GET['item'] ?? "";
            // JsonReceiveクラスを使ってデコード処理
            $this->postJsonData = file_get_contents('php://input');
            //JsonReceiveクラスを格納
            $this->jsonReceive = new JsonReceive($this->postJsonData);
            $insertArrayData = $this->jsonReceive->jsonDecode();

            // エラーチェック（オプション）
            if (isset($insertArrayData['error'])) {
                echo $insertArrayData['error'];
                return;
            }

            // データを取り出してインサート処理
            $program = $insertArrayData['program'];
            $ruby = $insertArrayData['ruby'];
            $update = $insertArrayData['update'];
            $image = $insertArrayData['image'];
            $title = $insertArrayData['title'];
            $text = $insertArrayData['text'];

            $stmt = $this->db->prepare("UPDATE techMemo SET `image`=:image,`title`=:title,`text`=:text,`program`=:program,`ruby`=:ruby,`update`=:update WHERE id=$param");
            $stmt->bindValue(':image', $image, PDO::PARAM_STR);
            $stmt->bindValue(':title', $title, PDO::PARAM_STR);
            $stmt->bindValue(':text', $text, PDO::PARAM_STR);
            $stmt->bindValue(':program', $program, PDO::PARAM_STR);
            $stmt->bindValue(':ruby', $ruby, PDO::PARAM_STR);
            $stmt->bindValue(':update', $update, PDO::PARAM_STR);
            $stmt->execute();
            echo json_encode(['message' => '更新成功']);
        } catch (PDOException $e) {
            echo json_encode(['message' => '更新失敗: ' . $e->getMessage()]);
        }
    }
}

$isLoggedIn = new IsLoggedIn();
$islogged = $isLoggedIn->logCheck();

if ($islogged['logIs']) {
    $db = new Database();
    $updateItem = new UpdateItem($db);
    $updateItem->updataItemData();
} else {
    echo json_encode(['message' => 'ログインされていません']);
}
