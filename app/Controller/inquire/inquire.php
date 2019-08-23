
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
    //dd($data);
    //ユーザーDAOをインスタンス化
    $inquire = new Inquire($this->db);
    //$company_info = new Company_info($this->db);//*

/*
    //入力されたメールアドレスの会員が登録済みかどうかをチェックします
    if ($company->select(array("email" => $data["email"]), "", "", 1, false)) {

        //入力項目がマッチしない場合エラーを出す
        $data["error"] = "このメールアドレスは既に会員登録済みです";

        // 入力フォームを再度表示します
        return $this->view->render($response, 'register/register.twig', $data);

    }
*/
    //DB登録に必要ない情報は削除します
    //unset($data["password_re"]);

    //DBに登録をする。戻り値は自動発番されたIDが返ってきます
    $id = $inquire->insert($data);


    //今登録された情報を発番されたIDで引き、会員情報を取得します（会員登録後の自動ログイン処理のため）
    $result = $inquire->select(array("id" => $id), "", "", 1, false);

   //$data_s = $inquire->select([],"datetime","DESC",1,false);//今回入れた内容を取得 //*

    //$data_t = []; //*
    //$data_t["result"] = $company->select([],"","DESC",10,true);//企業の情報を取得 //*

    //$param = [];
    //セッションにユーザー情報を登録（ログイン処理）
    $this->session->set('user_info', $result);
    //$result_info = [];
    //$param["datetime"] = $data["datetime"];
    //$
//*
  /*

    foreach($data_t["result"] as $row){
    if($row.name == $data_s.name){
        $result_info = $row;
        break;
      }
    }
    mb_language("Japanese");
    mb_send_mail($result_info.email,$result_info.name,"まじやばい");
    //$data_s["result"] = $company->select([], "datetime","DESC",5,true);
//*
 */
    //array_shift($data_s["result"]);
    // 登録完了ページを表示します。
    return $this->view->render($response, 'inquire/inquire_done.twig', $data);

});
//shinketya@gmail.com
