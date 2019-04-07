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

    public function fetchRecipesById($id)
    {
        $query = "
            SELECT
                r.RECIPE_NAME,rf.RECIPE_VALUE,rf.RECIPE_UNIT
            FROM
                recipe_and_food AS rf
                    INNER JOIN
                $this->food_table AS f ON f.FOOD_ID = rf.FOOD_ID
                    INNER JOIN
                $this->categories_table AS c ON c.CATEGORY_ID = f.CATEGORY_ID
                    INNER JOIN
                $this->recipes_table AS r ON r.RECIPE_ID = rf.RECIPE_ID
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
                $this->food_table as f
                INNER JOIN
                $this->categories_table as c ON f.CATEGORY_ID = c.CATEGORY_ID
            WHERE
                FOOD_ID = $id
            ";
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result;
    }
    public function searchFood($recipes,$categories)
    {
        $where = '';
        if($recipes){
            $where .= "rf.RECIPE_ID in ".$recipes . "AND ";
        }
        if($categories){
            $where .= "c.CATEGORY_ID IN ".$categories."AND ";
        }
        $where .= '1=1';
        $query = "
            SELECT
                f.FOOD_ID,
                f.FOOD_NAME,
                f.RECIPE_COUNT,
                c.CATEGORY_NAME,
                c.CATEGORY_ID,
                COUNT(rf.RECIPE_ID) AS COUNT,
                (ROUND((COUNT(rf.RECIPE_ID)/f.RECIPE_COUNT)*100,2)) AS PERCENTAGE
            FROM
                $this->food_table AS f
                    INNER JOIN
                $this->categories_table AS c ON c.CATEGORY_ID = f.CATEGORY_ID
                    INNER JOIN
                $this->recipe_and_food_table AS rf ON rf.FOOD_ID = f.FOOD_ID
            WHERE
                $where
            GROUP BY f.FOOD_ID
            order by PERCENTAGE DESC
            ";

        $result = $this->connection->prepare($query);
        $result->execute();
        return $result;
    }

}
