<?php
/**
 * Created by PhpStorm.
 * User: atajdar
 * Date: 3/26/2019
 * Time: 10:49 AM
 */

class category
{

    // Specify the table name
    private $categories_table = "categories";

    // Instance of connection
    private $conn;

    public function __construct($conn)
    {
        $this->connection = $conn;
    }

    public function addCategory($categoryName)
    {
            $query = "
            INSERT
              INTO $this->categories_table
               (`CATEGORY_NAME`) VALUES ('$categoryName');
            ";
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result;
    }
    public function editCategory($id,$categoryName)
    {
        $query = "UPDATE $this->categories_table SET `CATEGORY_NAME` = '$categoryName' WHERE `CATEGORY_ID` = $id";
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result;
    }
    public function fetchAll()
        {
            $query = "SELECT * FROM $this->categories_table";
            $result = $this->connection->prepare($query);
            $result->execute();
            return $result;
        }
    public function removeCategory($id)
        {
            $query = "DELETE FROM $this->categories_table WHERE `CATEGORY_ID`=$id";
            $result = $this->connection->prepare($query);
            $result->execute();
            return $result;
        }
        public function search($keyword)
        {
            $query = "SELECT * FROM $this->categories_table where `CATEGORY_NAME` LIKE '%$keyword%'";
            $result = $this->connection->prepare($query);
            $result->execute();
            return $result;
        }

}
