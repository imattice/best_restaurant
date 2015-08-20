<?php

    /**
    * @backupGlobals disabled
    * @backupStatic Attributes disabled
    */

    require_once 'src/Cuisine.php';
    // require_once 'src/Restaurant.php';

    $server = 'mysql:host=localhost;dbname=best_restaurant_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "American";
            $test_cuisine = new Cuisine($name);

            //Act
            $result = $test_cuisine->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "American";
            $id = 1;
            $test_cuisine = new Cuisine($name, $id);

            //Act
            $result = $test_cuisine->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $name = "American";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals($test_cuisine, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "American";
            $name2 = "Italian";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($name2);
            $test_cuisine2->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([$test_cuisine, $test_cuisine2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "American";
            $name2 = "Italian";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($name2);
            $test_cuisine2->save();

            //Act
            Cuisine::deleteAll();
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "American";
            $name2 = "Italian";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($name2);
            $test_cuisine2->save();

            //Act
            $result = Cuisine::find($test_cuisine->getId());

            //Assert
            $this->assertEquals($test_cuisine, $result);
        }

        function testUpdate()
        {
            //Arrange
            $name = "American";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $new_name = "American Fusion";

            //Act
            $test_cuisine->update($new_name);

            //Assert
            $this->assertEquals("American Fusion", $test_cuisine->getName());
        }

        function testDelete()
        {
            //Arrange
            $name = "American";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name2 = "American Fusion";
            $test_cuisine2 = new Cuisine($name2, $id);
            $test_cuisine2->save();

            //Act
            $test_cuisine->delete();

            //Assert
            $this->assertEquals([$test_cuisine2], Cuisine::getAll());

        }

        function testGetRestaurants()
        {
            //Arrange
            $name = "American";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $test_cuisine_id = $test_cuisine->getId();

            $restaurant_name = "VQ";
            $phone = '5032277342';
            $address = "1220 SW 1st Ave, Portland, OR 97204";
            $website = "http://www.veritablequandary.com/";
            $test_restaurant = new Restaurant($restaurant_name, $phone, $address, $website, $test_cuisine_id);
            $test_restaurant->save();


            $restaurant_name2 = "Hot Lips Pizza";
            $phone2 = '5035952342';
            $address2 = "721 NW 9th Ave #150, Portland, OR 97209";
            $website2 = "http://hotlipspizza.com/";
            $test_restaurant2 = new Restaurant($restaurant_name2, $phone2, $address2, $website2, $test_cuisine_id);
            $test_restaurant2->save();

            //Act
            $result = $test_cuisine->getRestaurants();

            //Assert
            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);

        }
    }

 ?>
