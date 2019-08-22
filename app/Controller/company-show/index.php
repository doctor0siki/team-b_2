<?php
use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Company;
//$app->get('/company-show/', function (Request $request, Response $response) {

    //GETされた内容を取得します。
    //$data = $request->getQueryParams();

    // Render index view
    //return $this->view->render($response, 'company-show/reviewList.twig', $data);

//});

$app->get('/company-show/', function (Request $request, Response $response) {

    $data=[];

    $CompanyList = new Company($this->db);

    $CompanyGroup = new Company($this->db);
    $data["group"] = $CompanyGroup->getCompanyGroup();
    $data_review = [[]];

    $data["companies"] = $CompanyList->getCompanyList();
    //レビューDAOをインスタンス化します。
    $reviewList = new Company($this->db);
    $data_review["reviews"] = $reviewList->getCompanyList();
//    dd($data_review["reviews"]);



    foreach($data_review["reviews"] as $key => $value) {
      //unset($company);
      $company[$value["name"]] = $reviewList->getReviewList($value["name"]);
    }
    //foreach($data["companies"] as $i => $company) {
      //$data["result$index"] = $reviewList->getReviewList($company);
    //}
    //レビュー一覧を取得し、戻り値をresultに格納します

    // Render index view
    return $this->view->render($response, 'company-show/reviewList.twig', $data_review);
});
