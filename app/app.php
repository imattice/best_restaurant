<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Restaurant.php";
    require_once __DIR__."/../src/Cuisine.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=best_restaurant';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get("/", function() use($app) {
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->post('/restaurants', function() use($app) {
        //takes the input values and builds a new restaurant and saves restaurant to database
        $restaurant_name = $_POST['restaurant_name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $website = $_POST['website'];
        $cuisine_id = $_POST['cuisine_id'];
        $restaurant = new Restaurant($restaurant_name, $phone, $address, $website, $cuisine_id);
        $restaurant->save();

        //?
        $cuisine = Cuisine::find($cuisine_id);
        return $app['twig']->render('cuisines.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));

    });


?>
