<?php
/**
 * Created by PhpStorm.
 * User: atajdar
 * Date: 3/26/2019
 * Time: 10:49 AM
 */

class recipe
{

    // Specify the table name
    private $food_table = "foods";
    private $categories_table = "categories";
    private $recipes_table = "recipes";
    private $recipe_and_food_table = "recipe_and_food";
    private $steps_table = "steps";

    //
    public $id;

    // Instance of connection
    private $conn;

    public function __construct($conn)
    {
        $this->connection = $conn;
    }

    public function add($recipeName)
    {
        $query = "INSERT INTO $this->recipes_table (`RECIPE_NAME`) VALUES ('$recipeName')";
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result;
    }
    public function edit($id,$recipeName)
    {
        $query = "UPDATE $this->recipes_table SET `RECIPE_NAME` = '$recipeName' WHERE `RECIPE_ID` = $id";
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result;
    }
    public function fetchAll()
    {
        $query = "SELECT * FROM $this->recipes_table";
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result;
    }
    public function remove($id)
    {
        $query = "DELETE FROM $this->recipes_table WHERE `RECIPE_ID` = $id";
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result;
    }


}
