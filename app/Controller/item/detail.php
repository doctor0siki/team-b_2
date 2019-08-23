<?php

use Model\Dao\Customer;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * 商品一覧を出すコントローラです
 *
 * detail/1 = 1番の商品を
 * detail/13 = 13番の商品を
 * 表示する仕組みになっています。
 *
 * {item_id}の中身は$argsに入ります。
 * 取得する時は、$args["item_id"]で取得できます。
 */
$app->get('/item/detail/{item_id}', function (Request $request, Response $response, $args) {

    $data = [];

    $data['item_names'] = [
        'name' => '名前',
        'age' => '年齢',
        'gender' => '性別',
        'mail' => 'メールアドレス',
        'tel' => '電話番号',
        'zipcode' => '郵便番号',
        'address' => '住所',
        'wig_type' => '装着範囲',
        'wig_material' => '材質',
        'wig_hair_quality' => '髪質',
        'wig_color' => '髪色',
        'budget' => '予算',
        'note' => 'その他・ご要望'
    ];

    //URLパラメータのitem_idを取得します。
    $item_id = $args["item_id"];

    //アイテムDAOをインスタンス化します。
    $customer = new Customer($this->db);

    //URLパラメータのitem_id部分を引数として渡し、戻り値をresultに格納します
    $data["result"] = $customer->getItem($item_id);
    unset($data['result']['id']);
    unset($data['result']['created_at']);

    // Render index view
    return $this->view->render($response, 'item/detail.twig', $data);

});
