<?php

use Model\Dao\Company;
use Slim\Http\Request;
use Slim\Http\Response;


// TOPページのコントローラ
$app->get('/', function (Request $request, Response $response) {

    $data = [];

    $company = new Company($this->db);
    $reviews = $company->getLatestFiveReviewsForTop();
    $data['reviews'] = $reviews;

    // Render index view
    return $this->view->render($response, 'top/index.twig', $data);
});
