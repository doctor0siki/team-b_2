<?php

use Model\Dao\Customer;
use Slim\Http\Request;
use Slim\Http\Response;

// 商品一覧を出すコントローラです
$app->get('/item/list', function (Request $request, Response $response) {

    $data=[];

    //顧客DAOをインスタンス化します。
    $customer = new Customer($this->db);
    $created_at = $this->session['user_info']['created_at'];

    //顧客情報一覧を取得し、戻り値をresultに格納します
    $data["result"] = $customer->getItemList();

    foreach ($data['result'] as $key => $item) {
        if ($created_at > $item['created_at']) {
            unset($data['result'][$key]);
        }
    }
    // Render index view
    return $this->view->render($response, 'item/list.twig', $data);

});
