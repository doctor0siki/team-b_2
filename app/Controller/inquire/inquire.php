
<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Inquire;
use Model\Dao\Companyinfo;


// 会員登録ページコントローラ
$app->get('/inquire/', function (Request $request, Response $response) {

    //GETされた内容を取得します。
    $data = $request->getQueryParams();

    // Render index view
    return $this->view->render($response, 'inquire/inquire.twig', $data);

});

// 会員登録処理コントローラ
$app->post('/inquire/', function (Request $request, Response $response) {

    //POSTされた内容を取得します
    $data = $request->getParsedBody();

    //ユーザーDAOをインスタンス化
    $inquire = new Inquire($this->db);

    //DBに登録をする。戻り値は自動発番されたIDが返ってきます
    $id = $inquire->insert($data);


    //今登録された情報を発番されたIDで引き、会員情報を取得します（会員登録後の自動ログイン処理のため）
    $result = $inquire->select(array("id" => $id), "", "", 1, false);

    $this->session->set('user_info', $result);
        // 登録完了ページを表示します。
    return $this->view->render($response, 'inquire/inquire_done.twig', $data);

});
//shinketya@gmail.com
