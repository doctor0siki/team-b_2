
<?php
use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Company;

$app->get('/company-show/', function (Request $request, Response $response) {

  $data=[];

  $CompanyList = new Company($this->db);

  $CompanyGroup = new Company($this->db);
  $data["group"] = $CompanyGroup->getCompanyGroup();
  $data_review = [[]];

  $data["companies"] = $CompanyList->getCompanyList();
  //レビューDAOをインスタンス化します。
  $reviewList = new Company($this->db);
  //    dd($data_review["reviews"]);
  $data_a = $reviewList->getCompanyList();



  foreach($data_a as $key => $value) {
    //unset($company);
    $company[$value["name"]] = $reviewList->getReviewList($value["name"]);
  }
  $data_review["reviews"] = $company;
  return $this->view->render($response, 'company-show/reviewList.twig', $data_review);
});
