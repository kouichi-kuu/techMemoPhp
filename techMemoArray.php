<?php
//データベースからSELECTした情報を連想配列に変換するクラス
class TechMemoArray
{
    private $techMemo = [];

    public function arrayLoop($row, $num)
    {
        //作成した連想配列を$techMemo変数に格納
        $this->techMemo[$num] = array(
            'id' => $row[$num]['id'],
            'image' => $row[$num]['image'],
            'title' => $row[$num]['title'],
            'text' => $row[$num]['text'],
            'program' => $row[$num]['program'],
            'ruby' => $row[$num]['ruby'],
            'update' => $row[$num]['update']
        );
        //連想配列が格納された変数を戻り値に設定
        return $this->techMemo;
    }
}
