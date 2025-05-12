<?php
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
