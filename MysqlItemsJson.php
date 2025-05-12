<?php
//require_once dirname(__FILE__) . '/database.php';
require_once dirname(__FILE__) . '/interfaceItemJson.php';
require_once dirname(__FILE__) . '/techMemoArray.php';

//ItemsJsonインターフェースの実装クラス
class MysqlItemsJson implements ItemsJson
{
    private $db;
    private $tecMemoArray;

    public function __construct($db)
    {
        // コンストラクタで受け取ったdbを保存
        $this->db = $db;
        //TechMemoArrayクラスを格納
        $this->tecMemoArray = new TechMemoArray();
    }

    //ItemsJsonインターフェースのjsonMake関数を使用
    public function jsonMake()
    {
        //techMemoテーブルの全てを取得
        $row = $this->db->fetchPdo("SELECT * FROM techMemo WHERE program = 'MySQL'");
        //初期化
        $techMemos = [];

        for ($num = 0; $num < count($row); $num++) {
            //TechMemoArrayクラスのarrayLoopメソッド戻り値を格納
            $techMemos = $this->tecMemoArray->arrayLoop($row, $num);
        }
        //この段階ではJSON形式の文字列が格納されている
        $jsonAll = json_encode($techMemos, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $mysqlItems = $jsonAll;
        echo $mysqlItems;
    }
}
