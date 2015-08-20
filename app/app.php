<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Restaurant.php";
    require_once __DIR__."/../src/Cuisine.php";

    $app = new Silex\Application();
    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=best_restaurant';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    //allows use of delete and update functions
    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();


    //landing page which displays all cuisines
    $app->get("/", function() use($app) {
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    //creates a new cuisine, saves it to the database, and displays it on the homepage
    $app->post('/cuisines', function() use($app) {
        $cuisine = new Cuisine($_POST['name']);
        $cuisine->save();
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    //brings user to specific cuisine page
    $app->get("/cuisines/{id}", function($id) use($app) {
        $cuisine = Cuisine::find($id);
        return $app['twig']->render('cuisines.html.twig', array('cuisines' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
        });

    //brings user to a page that allows a specific cuisine to be edited
    $app->get('/cuisines/{id}/edit', function($id) use ($app){
        $cuisine = Cuisine::find($id);
        return $app['twig']->render('cuisine_edit.html.twig', array('cuisines'=>$cuisine));
    });

    //posts edited data to the database to update a property in the existing cuisine
    $app->patch("/cuisines/{id}", function($id) use($app) {
        $name = $_POST['name'];
        $cuisine = Cuisine::find($id);
        $cuisine->update($name);
        return $app['twig']->render('cuisines.html.twig', array('cuisines' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));

    });

    //deletes one specific cuisine
    $app->delete("/cuisines/{id}", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        $cuisine->delete();
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    //clear database of all cuisines
    $app->post('/delete_cuisines', function() use($app) {
        Cuisine::deleteAll();
        return $app['twig']->render('index.html.twig', array('cuisines'=>Cuisine::getAll()));
    });

    //creates new restaurants and displays them on the same page
    $app->post('/restaurants', function() use($app) {
        //takes the input values and builds a new restaurant and saves restaurant to database
        $restaurant_name = $_POST['restaurant_name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $website = $_POST['website'];
        $cuisine_id = $_POST['cuisine_id'];
        $restaurant = new Restaurant($restaurant_name, $phone, $address, $website, $cuisine_id);
        $restaurant->save();
        $cuisine = Cuisine::find($cuisine_id);
        return $app['twig']->render('cuisines.html.twig', array('cuisines' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    //brings user to a page that allows a specific restaurant to be edited
    $app->get('/restaurant/{id}/edit', function($id) use ($app){
        $restaurant = Restaurant::find($id);
        return $app['twig']->render('restaurant_edit.html.twig', array('restaurants'=>$restaurant));
    });

    //posts edited data to the database to update a property in the existing restaurant
    $app->patch('/restaurant/{id}', function($id) use ($app){
        $restaurant = Restaurant::find($id);
        $cuisine = Cuisine::find($_POST['cuisine_id']);
        foreach ($_POST as $key => $value) {
            if (!empty ($value)) {
                $restaurant->update($key, $value);
            }
        }
        return $app['twig']->render('cuisines.html.twig', array('cuisines' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    //delete all restaurants in a specific cuisine
    $app->post('/delete_restaurants', function() use($app){
        Restaurant::deleteAll();
        return $app['twig']->render('index.html.twig', array('restaurants'=> Restaurant::getAll()));
    });

    //deletes specific restaurant
    $app->delete('/restaurant/{id}', function($id) use ($app){
        $restaurant = Restaurant::find($id);
        $cuisine = Cuisine::find($_POST['cuisine_id']);
        $restaurant->delete();
        return $app['twig']->render('cuisines.html.twig', array('cuisines' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    return $app;
?>
