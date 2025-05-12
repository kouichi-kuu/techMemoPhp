<?php
require_once dirname(__FILE__) . '/cors.php';

require_once dirname(__FILE__) . '/database.php';
require_once dirname(__FILE__) . '/AllItemsJson.php';
require_once dirname(__FILE__) . '/JsItemsJson.php';
require_once dirname(__FILE__) . '/PhpItemsJson.php';
require_once dirname(__FILE__) . '/MysqlItemsJson.php';
require_once dirname(__FILE__) . '/HtmlItemsJson.php';
require_once dirname(__FILE__) . '/OtherItemsJson.php';
require_once dirname(__FILE__) . '/NewUpdateItemsJson.php';
require_once dirname(__FILE__) . '/InsertItem.php';
require_once dirname(__FILE__) . '/IsLoggedIn.php';

// パラメータ取得
$param = $_GET['item'] ?? "";

$isLoggedIn = new IsLoggedIn();
$islogged = $isLoggedIn->logCheck();

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

    case 'newUpdate':
        $db = new Database();
        $newUpdateItemsJson = new NewUpdateItemsJson($db);
        $newUpdateItemsJson->jsonMake();
        break;

    case 'insert':
        if ($islogged['logIs']) {
            $db = new Database();
            $insertItem = new InsertItem($db);
            $insertItem->insertItemData();
        } else {
            echo json_encode(['message' => 'ログインされていません']);
        }
        break;
}
