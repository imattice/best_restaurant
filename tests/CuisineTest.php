<?php

    /**
    * @backupGlobals disables
    * @backupStatic Attributes disabled
    */

    require_once 'src/Cuisine.php';
    // require_once 'src/Restaurant.php';

    // $server = 'mysql:host=localhost;dbname=best_restaurant_test';
    // $username = 'root';
    // $password = 'root';
    // $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Cuisine::deleteAll();
        //     Restaurant::deleteAll();
        // }
        //
        function test_getName()
        {
            //Arrange
            $name = "VQ";
            $test_Cuisine = new Cuisine($name);

            //Act
            $result = $test_Cuisine->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "VQ";
            $id = 1;
            $test_Cuisine = new Cuisine($name, $id);

            //Act
            $result = $test_Cuisine->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }
    }

 ?>
