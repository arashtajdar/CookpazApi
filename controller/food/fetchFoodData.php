<?php
/**
 * Created by PhpStorm.
 * User: atajdar
 * Date: 3/26/2019
 * Time: 11:45 AM
 */
/**
 * @SWG\Get(
 *     path="/samplePhpApi/products/search.php?start={start}&length={length}&name={name}&minPrice={minPrice}&maxPrice={maxPrice}",
 *     summary="search in foods",
 *     tags={"products"},
 *     @SWG\Parameter(
 *         name="start",
 *         in="path",
 *         description="start of records to display (zero based)",
 *         required=false,
 *         @SWG\Schema(
 *             type="integer",
 *             format="int32"
 *         )
 *     ),
 *     @SWG\Parameter(
 *         name="length",
 *         in="path",
 *         description="length of records",
 *         required=false,
 *         @SWG\Schema(
 *             type="integer",
 *             format="int32"
 *         )
 *     ),
 *     @SWG\Parameter(
 *         name="name",
 *         in="path",
 *         description="search keyword",
 *         required=true,
 *         @SWG\Schema(
 *             type="string"
 *         )
 *     ),
 *     @SWG\Parameter(
 *         name="minPrice",
 *         in="path",
 *         description="minimum price",
 *         required=false,
 *         @SWG\Schema(
 *             type="integer",
 *             format="int32"
 *         )
 *     ),
 *     @SWG\Parameter(
 *         name="maxPrice",
 *         in="path",
 *         description="maximum price",
 *         required=false,
 *         @SWG\Schema(
 *             type="integer",
 *             format="int32"
 *         )
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="ok"
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="ERROR : Not found"
 *     ),
 *     @SWG\Response(
 *         response="default",
 *         description="unexpected error"
 *     )
 * )
 */

Class fetchFoodData{
    public function fetchFoodData($id) {
        $dbclass = new DatabaseClass();
        $connection = $dbclass->connect();

        $food = new food($connection);

        $error = array();

        try{
            $id = (!empty($id) && $id !== 'undefined') ? $id : null;
            if(!$id){
                throw new Exception("You should specify ID of food");
            }

            $recipes = $food->fetchRecipesById($id);
            $Data = $food->fetchById($id);
            $steps = $food->fetchSteps($id);
            $stepsCount = $Data->rowCount();

            $count = $Data->rowCount();
            if(!$count){
                throw new Exception("No result found !");
            }
            $foodData = array();
            $foodData["body"] = array();
            $foodData["body"]["recipes"] = array();
            $foodData["body"]["data"] = array();
            $foodData["body"]["steps"] = array();

            while ($row = $Data->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $foodData["body"]["data"]["FOOD_ID"] = $FOOD_ID;
                $foodData["body"]["data"]["FOOD_NAME"] = $FOOD_NAME;
                $foodData["body"]["data"]["CATEGORY_NAME"] = $CATEGORY_NAME;
                $foodData["body"]["data"]["CATEGORY_ID"] = $CATEGORY_ID;
            }
            while ($row = $recipes->fetch(PDO::FETCH_ASSOC)) {
                array_push($foodData["body"]["recipes"], $row);
            }
            while ($row = $steps->fetch(PDO::FETCH_ASSOC)) {
                array_push($foodData["body"]["steps"], $row);
            }
            return json_encode($foodData);

        }catch (Exception $e){
            array_push($error, $e->getMessage());
            return json_encode(
                array("ERROR" => $error)
            );
        }

    }


}
