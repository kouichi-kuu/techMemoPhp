<?php
//require_once dirname(__FILE__) . '/database.php';
require_once dirname(__FILE__) . '/interfaceItemJson.php';

class AllItemsJson implements ItemsJson
{
    private $db;

    public function __construct($db)
    {
        // コンストラクタで受け取ったdbを保存
        $this->db = $db;
    }

    public function jsonMake()
    {
        $row = $this->db->fetchPdo("SELECT * FROM techMemo");
        //$techMemoAllの初期化
        $techMemoAll = [];

        for ($num = 0; $num < count($row); $num++) {
            $techMemoAll[$num] = array(
                'id' => $row[$num]['id'],
                'image' => $row[$num]['image'],
                'title' => $row[$num]['title'],
                'text' => $row[$num]['text'],
                'program' => $row[$num]['program'],
                'ruby' => $row[$num]['ruby'],
                'update' => $row[$num]['update']
            );
        }
        //この段階ではJSON形式の文字列が格納されている
        $jsonAll = json_encode($techMemoAll, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $allItems = $jsonAll;
        echo $allItems;
    }
}
