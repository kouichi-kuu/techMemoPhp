<?php
class JsonReceive
{
    private $postJsonData;
    private $decodeJsonData;

    public function __construct($postJsonData)
    {
        $this->postJsonData = $postJsonData;
        //$this->decodeJsonData = $decodeJsonData;
    }

    public function jsonDecode()
    {
        // JSONを連想配列にデコード
        $this->decodeJsonData = json_decode($this->postJsonData, true);
        // デコードに成功していれば処理を続ける
        if ($this->decodeJsonData !== null) {
            $program = $this->decodeJsonData['program'] ?? '';
            $ruby = $this->decodeJsonData['ruby'] ?? '';
            $update = $this->decodeJsonData['update'] ?? '';
            $image = $this->decodeJsonData['image'] ?? '';
            $title = $this->decodeJsonData['title'] ?? '';
            $text = $this->decodeJsonData['text'] ?? '';
            return [
                'program' => $program,
                'ruby' => $ruby,
                'update' => $update,
                'image' => $image,
                'title' => $title,
                'text' => $text
            ];
        } else {
            return [
                'error' => 'デコードに失敗しました。'
            ];
        }
    }
}
