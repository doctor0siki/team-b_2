<?php

namespace Model\Dao;

/**
 * Class User
 *
 * Userテーブルを扱う Classです
 * DAO.phpに用意したCRUD関数以外を実装するときに、記載をします。
 *
 * @copyright Ceres inc.
 * @author y-fukumoto <y-fukumoto@ceres-inc.jp>
 * @since 2018/08/28
 * @package Model\Dao
 */
class Company extends Dao
{
    public function getCompanyList()
    {

        //全件取得するクエリを作成
        $sql = "select distinct name from company ";

        // SQLをプリペア
        $statement = $this->db->prepare($sql);

        //$statement->bindParam(":name", $CompanyName, \PDO::PARAM_STR);
        //SQLを実行
        $statement->execute();

        //dd($statement->fetchAll());
        //結果レコードを全件取得し、返送
        return $statement->fetchAll();

    }

    public function getCompanyGroup() {
        $sql = "select name, group_concat(review separator ', ') as reviews  from company group by name";

        // SQLをプリペア
        $statement = $this->db->prepare($sql);

        //$statement->bindParam(":name", $CompanyName, \PDO::PARAM_STR);
        //SQLを実行
        $statement->execute();

        //dd($statement->fetchAll());
        //結果レコードを全件取得し、返送
        return $statement->fetchAll();

    }

    public function getReviewList($CompanyName)
    {
        //全件取得するクエリを作成
        $sql = "select * from company where name = :name ";

        // SQLをプリペア
        $statement = $this->db->prepare($sql);

        $statement->bindParam(":name", $CompanyName, \PDO::PARAM_STR);


        //SQLを実行
        $statement->execute();

        //結果レコードを全件取得し、返送
        return $statement->fetchAll();

    }


}
