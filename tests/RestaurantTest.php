<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=best_restaurant_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Cuisine::deleteAll();
        //     Restaurant::deleteAll();
        // }

        function test_getRestaurantName()
        {
            //Arrange
            $restaurant_name = "VQ";
            $phone = 5032277342;
            $address = "1220 SW 1st Ave, Portland, OR 97204";
            $website = "http://www.veritablequandary.com/";
            $cuisine_id = 1;
            $id = null;
            $test_restaurant = new Restaurant($restaurant_name, $phone, $address, $website, $cuisine_id, $id);

            //Act
            $result = $test_restaurant->getRestaurantName();

            //Assert
            $this->assertEquals($restaurant_name, $result);
        }

        function test_getPhone()
        {
            //Arrange
            $restaurant_name = "VQ";
            $phone = 5032277342;
            $address = "1220 SW 1st Ave, Portland, OR 97204";
            $website = "http://www.veritablequandary.com/";
            $cuisine_id = 1;
            $id = null;
            $test_restaurant = new Restaurant($restaurant_name, $phone, $address, $website, $cuisine_id, $id);

            //Act
            $result = $test_restaurant->getPhone();

            //Assert
            $this->assertEquals($phone, $result);
        }

        function test_getAddress()
        {
            //Arrange
            $restaurant_name = "VQ";
            $phone = 5032277342;
            $address = "1220 SW 1st Ave, Portland, OR 97204";
            $website = "http://www.veritablequandary.com/";
            $cuisine_id = 1;
            $id = null;
            $test_restaurant = new Restaurant($restaurant_name, $phone, $address, $website, $cuisine_id, $id);

            //Act
            $result = $test_restaurant->getAddress();

            //Assert
            $this->assertEquals($address, $result);
        }

        function test_getWebsite()
        {
            //Arrange
            $restaurant_name = "VQ";
            $phone = 5032277342;
            $address = "1220 SW 1st Ave, Portland, OR 97204";
            $website = "http://www.veritablequandary.com/";
            $cuisine_id = 1;
            $id = null;
            $test_restaurant = new Restaurant($restaurant_name, $phone, $address, $website, $cuisine_id, $id);

            //Act
            $result = $test_restaurant->getWebsite();

            //Assert
            $this->assertEquals($website, $result);
        }

        function test_getCuisineId()
        {
            //Arrange
            $name = "American";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $restaurant_name = "VQ";
            $phone = 5032277342;
            $address = "1220 SW 1st Ave, Portland, OR 97204";
            $website = "http://www.veritablequandary.com/";
            $cuisine_id = 1;
            $id = null;
            $test_restaurant = new Restaurant($restaurant_name, $phone, $address, $website, $cuisine_id, $id);

            //Act
            $result = $test_restaurant->getCuisineId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_getId()
        {
            //Arrange
            $restaurant_name = "VQ";
            $phone = 5032277342;
            $address = "1220 SW 1st Ave, Portland, OR 97204";
            $website = "http://www.veritablequandary.com/";
            $cuisine_id = 1;
            $id = null;
            $test_restaurant = new Restaurant($restaurant_name, $phone, $address, $website, $cuisine_id, $id);

            //Act
            $result = $test_restaurant->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

    }





?>
