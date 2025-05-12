<?php
require_once dirname(__FILE__) . '/JsonReceive.php';

class InsertItem
{
    private $db;
    private $jsonReceive;
    private $postJsonData;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function insertItemData()
    {
        try {
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

            $stmt = $this->db->prepare("INSERT INTO techMemo (`image`,`title`,`text`,`program`,`ruby`,`update`) VALUES(:image, :title, :text, :program, :ruby, :update)");
            $stmt->bindValue(':image', $image, PDO::PARAM_STR);
            $stmt->bindValue(':title', $title, PDO::PARAM_STR);
            $stmt->bindValue(':text', $text, PDO::PARAM_STR);
            $stmt->bindValue(':program', $program, PDO::PARAM_STR);
            $stmt->bindValue(':ruby', $ruby, PDO::PARAM_STR);
            $stmt->bindValue(':update', $update, PDO::PARAM_STR);
            $stmt->execute();
            echo json_encode(['message' => 'アイテム作成成功']);
        } catch (PDOException $e) {
            echo json_encode(['message' => 'アイテム作成失敗: ' . $e->getMessage()]);
        }
    }
}
