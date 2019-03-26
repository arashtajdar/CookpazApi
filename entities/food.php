<?php
/**
 * Created by PhpStorm.
 * User: atajdar
 * Date: 3/26/2019
 * Time: 10:49 AM
 */

class food
{

    // Specify the table name
    private $table = "foods";

    //
    public $id;

    // Instance of connection
    private $conn;

    public function __construct($conn)
    {
        $this->connection = $conn;
    }

    public function fetchRecipesById($id)
    {
        $query = "
            SELECT 
                r.RECIPE_NAME,rf.RECIPE_VALUE,rf.RECIPE_UNIT
            FROM
                recipe_and_food AS rf
                    INNER JOIN
                foods AS f ON f.FOOD_ID = rf.FOOD_ID
                    INNER JOIN
                categories AS c ON c.CATEGORY_ID = f.CATEGORY_ID
                    INNER JOIN
                recipes AS r ON r.RECIPE_ID = rf.RECIPE_ID
            WHERE
                f.FOOD_ID = $id
            ";
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result;
    }
    public function fetchById($id)
    {
        $query = "
            SELECT 
                f.FOOD_ID,f.FOOD_NAME,c.CATEGORY_NAME,c.CATEGORY_ID
            FROM
                foods as f
                INNER JOIN 
                categories as c ON f.CATEGORY_ID = c.CATEGORY_ID
            WHERE
                FOOD_ID = $id
            ";
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result;
    }

}