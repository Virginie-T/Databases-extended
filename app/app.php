<?php 

    require_once __DIR__."/../vendor/autoload.php";
	require_once __DIR__."/../src/Brand.php";
	require_once __DIR__."/../src/Store.php";

	$DB = new PDO('pgsql:host=localhost;dbname=shoes_test');

	$app = new Silex\Application();

	$app->registrer(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__."/../views"));

	use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.twig');
    });

    

    return $app;

?>