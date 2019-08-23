
<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Company;


// 会員登録ページコントローラ
$app->get('/company-import/', function (Request $request, Response $response) {

    //GETされた内容を取得します。
    $data = $request->getQueryParams();

    // Render index view
    return $this->view->render($response, 'company-import/company-import.twig', $data);

});

// 会員登録処理コントローラ
$app->post('/company-import/', function (Request $request, Response $response) {

    //POSTされた内容を取得します
    $data = $request->getParsedBody();
    //dd($data);
    //ユーザーDAOをインスタンス化
    $company = new Company($this->db);


    //DBに登録をする。戻り値は自動発番されたIDが返ってきます
    $id = $company->insert($data);

    //今登録された情報を発番されたIDで引き、会員情報を取得します（会員登録後の自動ログイン処理のため）
    $result = $company->select(array("id" => $id), "", "", 1, false);

    $data_s = [];

    //セッションにユーザー情報を登録（ログイン処理）
    $this->session->set('user_info', $result);
    //$param["datetime"] = $data["datetime"];
    $data_s["act"] = $company->select([],"datetime","DESC",1,false);

    $data_s["result"] = $company->select([], "datetime","DESC",5,true);

    array_shift($data_s["result"]);
    // 登録完了ページを表示します。
    return $this->view->render($response, 'company-import/company-import_done.twig', $data_s);

});
