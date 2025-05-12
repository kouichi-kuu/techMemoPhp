<?php
require_once dirname(__FILE__) . '/cors.php';
require_once dirname(__FILE__) . '/database.php';

class SingleItem
{
    private $singleFetchPdo;

    public function __construct()
    {
        $this->singleFetchPdo = new Database();
    }

    public function singleFetchItem()
    {
        $param = $_GET['item'] ?? "";
        try {
            $singleRow = $this->singleFetchPdo->singleFetchPdo("SELECT * FROM techMemo WHERE id = $param");
            $jsonSingle = json_encode($singleRow, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            $singleItemData = $jsonSingle;
            echo $singleItemData;
        } catch (PDOException $e) {
            echo '接続失敗: ' . $e->getMessage();
        }
    }
}

$singleItem = new SingleItem();
$singleItem->singleFetchItem();
