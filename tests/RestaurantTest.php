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
        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }

        function test_getRestaurantName()
        {
            //Arrange
            $restaurant_name = "VQ";
            $phone = '5032277342';
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
            $phone = '5032277342';
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
            $phone = '5032277342';
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
            $phone = '5032277342';
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
            $phone = '5032277342';
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
            $phone = '5032277342';
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

        function test_save()
        {
            //Arrange
            $name = "American";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $restaurant_name = "VQ";
            $phone = '5032277342';
            $address = "1220 SW 1st Ave, Portland, OR 97204";
            $website = "http://www.veritablequandary.com/";
            $cuisine_id = 1;
            $id = null;
            $test_restaurant = new Restaurant($restaurant_name, $phone, $address, $website, $cuisine_id, $id);

            //Act
            $test_restaurant->save();

            //Assert
            $result = Restaurant::getAll();
            $this->assertEquals($test_restaurant, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "American";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $restaurant_name = "VQ";
            $phone = '5032277342';
            $address = "1220 SW 1st Ave, Portland, OR 97204";
            $website = "http://www.veritablequandary.com/";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($restaurant_name, $phone, $address, $website, $cuisine_id);
            $test_restaurant->save();


            $restaurant_name2 = "Hot Lips Pizza";
            $phone2 = '5035952342';
            $address2 = "721 NW 9th Ave #150, Portland, OR 97209";
            $website2 = "http://hotlipspizza.com/";
            $test_restaurant2 = new Restaurant($restaurant_name2, $phone2, $address2, $website2, $cuisine_id);
            $test_restaurant2->save();


            //Act
            $result = Restaurant::getAll();


            //Assert
            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $restaurant_name = "VQ";
            $phone = '5032277342';
            $address = "1220 SW 1st Ave, Portland, OR 97204";
            $website = "http://www.veritablequandary.com/";
            $id = null;
            $cuisine_id = null;
            $test_restaurant = new Restaurant($restaurant_name, $phone, $address, $website, $cuisine_id, $id);
            $test_restaurant->save();

            $restaurant_name2 = "Hot Lips Pizza";
            $phone2 = '5035952342';
            $address2 = "721 NW 9th Ave #150, Portland, OR 97209";
            $website2 = "http://hotlipspizza.com/";
            $id2 = null;
            $cuisine_id2 = null;
            $test_restaurant2 = new Restaurant($restaurant_name2, $phone2, $address2, $website2, $cuisine_id2, $id2);
            $test_restaurant2->save();

            //Act
            Restaurant::deleteAll();

            //Assert
            $result = Restaurant::getAll();
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "American";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();


            $restaurant_name = "VQ";
            $phone = '5032277342';
            $address = "1220 SW 1st Ave, Portland, OR 97204";
            $website = "http://www.veritablequandary.com/";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($restaurant_name, $phone, $address, $website, $cuisine_id);
            $test_restaurant->save();

            $restaurant_name2 = "Hot Lips Pizza";
            $phone2 = '5035952342';
            $address2 = "721 NW 9th Ave #150, Portland, OR 97209";
            $website2 = "http://hotlipspizza.com/";
            $test_restaurant2 = new Restaurant($restaurant_name2, $phone2, $address2, $website2, $cuisine_id);
            $test_restaurant2->save();

            //Act
            $result = Restaurant::find($test_restaurant->getId());

            //Assert
            $this->assertEquals($test_restaurant, $result);
        }


        function test_Update()
        {
            //Arrange
            $name = "American";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();


            $restaurant_name = "VQ";
            $phone = '5032277342';
            $address = "1220 SW 1st Ave, Portland, OR 97204";
            $website = "http://www.veritablequandary.com/";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($restaurant_name, $phone, $address, $website, $cuisine_id);
            $test_restaurant->save();

            $column_to_update = "restaurant_name";
            $new_information = "Veritable Quandary";

            //Act
            $test_restaurant->update($column_to_update, $new_information);

            //Assert
            $result = Restaurant::getAll();
            $this->assertEquals("Veritable Quandary", $result[0]->getRestaurantName());
        }

        function test_Delete()
        {
            //Arrange
            $name = "American";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();


            $restaurant_name = "VQ";
            $phone = '5032277342';
            $address = "1220 SW 1st Ave, Portland, OR 97204";
            $website = "http://www.veritablequandary.com/";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($restaurant_name, $phone, $address, $website, $cuisine_id);
            $test_restaurant->save();

            $restaurant_name2 = "Hot Lips Pizza";
            $phone2 = '5035952342';
            $address2 = "721 NW 9th Ave #150, Portland, OR 97209";
            $website2 = "http://hotlipspizza.com/";
            $test_restaurant2 = new Restaurant($restaurant_name2, $phone2, $address2, $website2, $cuisine_id);
            $test_restaurant2->save();

            //Act
            $test_restaurant->delete();

            //Assert
            $this->assertEquals([$test_restaurant2], Restaurant::getAll());
        }






    }





?>
