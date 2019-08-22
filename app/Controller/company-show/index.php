<?php
use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Company;


$app->get('/company-show/', function (Request $request, Response $response) {

    //GETされた内容を取得します。
    $data = $request->getQueryParams();

    // Render index view
    return $this->view->render($response, 'company-show/reviewList.twig', $data);

});
