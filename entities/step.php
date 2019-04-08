<?php
/**
 * Created by PhpStorm.
 * User: atajdar
 * Date: 3/26/2019
 * Time: 10:49 AM
 */

class step
{

    // Specify the table name
    private $food_table = "foods";
    private $steps_table = "steps";

    //
    public $id;

    // Instance of connection
    private $conn;

    public function __construct($conn)
    {
        $this->connection = $conn;
    }
    public function fetchSteps($id)
    {

        $query = "
            SELECT
                s.STEP_ORDER,s.STEP_TEXT
            FROM
                $this->steps_table AS s
                    INNER JOIN
                $this->food_table AS f ON f.FOOD_ID = s.FOOD_ID
                where f.FOOD_ID = $id
                order by s.STEP_ORDER ASC
            ";

        $result = $this->connection->prepare($query);
        $result->execute();
        return $result;
    }
    public function remove($id)
    {
        $query = "DELETE FROM $this->steps_table WHERE `STEP_ID` = $id";
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result;
    }
    public function add($stepText)
    {
        $query = "INSERT INTO $this->steps_table (`FOOD_ID`,`STEP_ORDER`,`STEP_TEXT`) VALUES (1,1,'$stepText')";
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result;
    }
    public function editText($id,$stepText)
    {
        $query = "UPDATE $this->steps_table SET `STEP_TEXT` = '$stepText' WHERE `STEP_ID` = $id ";
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result;
    }
    public function editOrder($id,$newOrder)
    {
        $query = "UPDATE $this->steps_table SET `STEP_ORDER` = '$newOrder' WHERE `STEP_ID` = $id ";
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result;
    }

}
