<?php
header("Access-Control-Allow-Origin: *");
class Database
{
    private $pdo;

    public function __construct()
    {
        // データベースに接続
        $host = 'mysql320.phy.lolipop.lan';
        $dbName = 'LAA1327483-teqperson25';
        $user = 'LAA1327483';
        $pass = 'teqperson25';
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            echo '接続失敗: ' . $e->getMessage();
        }
    }

    public function fetchPdo($sql)
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        //返り値必須
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// パラメータ取得
$param = $_GET['item'] ?? "";
$db = new Database();

switch ($param) {
    case 'all':
        $row = $db->fetchPdo("SELECT * FROM techMemo");
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
        // $allItems = array(
        //     'allItems' => $jsonAll
        // );
        $allItems = $jsonAll;
        echo $allItems;
        break;
}
