<?php

namespace Model\Dao;

use Doctrine\DBAL\DBALException;
use PDO;

class Customer extends Dao
{
    public function getItemList()
    {

        //全件取得するクエリを作成
        $sql = "select * from customer";

        // SQLをプリペア
        $statement = $this->db->prepare($sql);

        //SQLを実行
        $statement->execute();

        //結果レコードを全件取得し、返送
        return $statement->fetchAll();

    }

    public function getItem($id)
    {

        //全件取得するクエリを作成
        $sql = "select * from customer where id =:id";

        // SQLをプリペア
        $statement = $this->db->prepare($sql);

        //idを指定します
        $statement->bindParam(":id", $id, PDO::PARAM_INT);

        //SQLを実行
        $statement->execute();

        //結果レコードを一件取得し、返送
        return $statement->fetch();
    }
}
