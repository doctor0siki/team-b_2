<?php

//http://team-b1.2021.local/test



use Slim\Http\Request;
use Slim\Http\Response;

// TOPページのコントローラ
$app->get('/test', function (Request $request, Response $response) {

    $data = [];


//    dd("みかわやです");//強制終了

    // Render index view
    return $this->view->render($response, 'test/test.twig', $data);
});
