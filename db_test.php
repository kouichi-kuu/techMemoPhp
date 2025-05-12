<?php
require_once dirname(__FILE__) . '/database.php';
require_once dirname(__FILE__) . '/AllItemsJson.php';
require_once dirname(__FILE__) . '/JsItemsJson.php';
require_once dirname(__FILE__) . '/PhpItemsJson.php';
require_once dirname(__FILE__) . '/MysqlItemsJson.php';
require_once dirname(__FILE__) . '/HtmlItemsJson.php';
require_once dirname(__FILE__) . '/OtherItemsJson.php';

// パラメータ取得
$param = $_GET['item'] ?? "";

switch ($param) {
    case 'all':
        $db = new Database();
        $allItemsJson = new AllItemsJson($db);
        $allItemsJson->jsonMake();
        break;

    case 'js':
        $db = new Database();
        $jsItemsJson = new JsItemsJson($db);
        $jsItemsJson->jsonMake();
        break;

    case 'php':
        $db = new Database();
        $phpItemsJson = new PhpItemsJson($db);
        $phpItemsJson->jsonMake();
        break;

    case 'mysql':
        $db = new Database();
        $mysqlItemsJson = new MysqlItemsJson($db);
        $mysqlItemsJson->jsonMake();
        break;

    case 'html':
        $db = new Database();
        $htmlItemsJson = new HtmlItemsJson($db);
        $htmlItemsJson->jsonMake();
        break;

    case 'other':
        $db = new Database();
        $otherItemsJson = new OtherItemsJson($db);
        $otherItemsJson->jsonMake();
        break;
}
