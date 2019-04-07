<?php
 /**
 * @SWG\Info(
 *     description="Api for CookPaz mobile and web app",
 *     version="1.0",
 *     title="CookPaz API",
 *     @SWG\Contact(
 *         email="arashtajdar@gmail.com"
 *     )
 * )
 */
/**
 * @SWG\Tag(
 *     name="category",
 *     description="CRUD for category",
 * )
 * @SWG\Tag(
 *     name="food",
 *     description="CRUD for food",
 * )
 * @SWG\Tag(
 *     name="recipe",
 *     description="CRUD for recipe",
 * )
 * @SWG\Tag(
 *     name="step",
 *     description="CRUD for step",
 * )


 */
 function createIndex(){
   $api = array();
   $api["body"] = array();
   $api["services"] = array();
   $api["documentation"] = array();

   $api["body"] = array(
       "TITLE" => "CookPaz",
       "VERSION" => "1.0.0",
       "DESCRIPTION" => "...",
       "CONTACTME" => "arashtajdar@gmail.com"
   );

   $api["services"] = array(
       "CREATE" => "/samplePhpApi/products/create.php",
       "DELETE" => "/samplePhpApi/products/delete.php",
       "READ" => "/samplePhpApi/products/read.php",
       "SEARCH" => "/samplePhpApi/products/search.php",
       "UPDATE" => "/samplePhpApi/products/update.php"
   );
   $api["documentation"] = array(
       "URL" => "/documentation"
   );


   return json_encode($api);
 }
