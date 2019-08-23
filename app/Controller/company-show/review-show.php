<?php
use Model\Dao\Company;
use Slim\Http\Request;
use Slim\Http\Response;
// レビュー一覧を取得するコントローラー

$app->get('/company/review-show/', function (Request $request, Response $response) {

    $data=[];

    //レビューDAOをインスタンス化します。
    $reviewList = new Company($this->db);

    //レビュー一覧を取得し、戻り値をresultに格納します
    $data["result"] = $ReviewList->getReviewList("株式会社かつら");

    // Render index view
    return $this->view->render($response, 'company-show/reviewList.twig', $data);


});
