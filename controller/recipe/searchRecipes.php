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
function searchRecipes($keyword){

    $dbclass = new DatabaseClass();
    $connection = $dbclass->connect();
    $recipe = new recipe($connection);
    $error = array();

    try{
        // TODO: JSON request
        $result = $recipe->search($keyword);
        $res_count = $result->rowCount();
        if(!$res_count){
            throw new Exception("No result found !");
        }
        $resultList = array();
        $resultList["body"] = array();
        $resultList["ERROR"] = array();
        $resultList["body"]["count"] = $res_count;

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            array_push($resultList["body"], $row);
        }
        $resultList["ERROR"] = false;

        return json_encode($resultList);

    }catch (Exception $e){
        array_push($error, $e->getMessage());
        return json_encode(
            array("ERROR" => $error)
        );
    }


}
