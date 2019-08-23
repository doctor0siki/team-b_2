<?php
use Slim\Http\Request;
use Slim\Http\Response;
// TOPページのコントローラ
$app->get('/privacypolicy', function (Request $request, Response $response) {
    $data = [];
    // Render index view
    return $this->view->render($response, 'Policy/policy.twig', $data);
});


