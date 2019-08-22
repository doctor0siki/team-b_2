<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Customer;

$app->get('/customer/register', function (Request $request, Response $response) {
    if (!empty($this->session['is_session'])) {
        $customer_data = $_SESSION;
    } else {
        $customer_data = [];
    }

    return $this->view->render($response, 'customer/register.twig', $customer_data);
});

$app->post('/customer/confirm', function (Request $request, Response $response) {
    if (empty($request->getParsedBody())) {
        return $response->withRedirect('/customer/register');
    }
    $_SESSION = $request->getParsedBody();
    $customer_data['data'] = $_SESSION;
    unset($customer_data['data']["is_session"]);
    $customer_data['item_names'] = [
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

    return $this->view->render($response, 'customer/register_confirm.twig', $customer_data);
});

$app->POST('/customer/register_done', function (Request $request, Response $response) {
    if (empty($request->getParsedBody())) {
        return $response->withRedirect('/customer/register');
    }

    $customer_data = $request->getParsedBody();
    $now = new DateTime();
    $customer_data['created_at'] = $now->format("Y-m-d H:i:s");
    $customer = new Customer($this->db);
    $id = $customer->insert($customer_data);

    $this->session::destroy();

    return $response->withRedirect('/');
});
