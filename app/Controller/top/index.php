<?php

use Model\Dao\Company;
use Slim\Http\Request;
use Slim\Http\Response;


// TOPページのコントローラ
$app->get('/', function (Request $request, Response $response) {

    $data=[];
    //レビューDAOをインスタンス化します。
    $reviewList = new Company($this->db);
    //レビュー一覧を取得し、戻り値をresultに格納します
    $data["result"] = $reviewList->getReviewList("株式会社カツラマッチ");


    // Render index view
    return $this->view->render($response, 'top/index.twig', $data);
});

