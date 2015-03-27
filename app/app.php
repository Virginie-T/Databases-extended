<?php 

    require_once __DIR__."/../vendor/autoload.php";
	require_once __DIR__."/../src/Brand.php";
	require_once __DIR__."/../src/Store.php";

	$DB = new PDO('pgsql:host=localhost;dbname=shoes_test');

//	$data_brands = Brand::getAll();
//    if($data_brands == []) {
//        $vans = new Brand("Vans");
//        $vans->save();
//        $converse = new Brand("Converse");
//        $converse->save();
//        $nike = new Brand("Nike");
//		$nike->save();
//    }

//    $data_stores = Store::getAll();
//    if($data_stores == []) {
//        $vans = new Store("Store 1");
//        $vans->save();
//        $converse = new Store("Store 2");
//        $converse->save();
//        $nike = new Store("Store 3");
//		$nike->save();
//    }

	$app = new Silex\Application();
		$app['debug']=true;


	$app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__."/../views"));

	use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.twig');
    });

    $app->get("/stores", function() use ($app) {
    	$stores = Store::getAll();
        return $app['twig']->render('stores.twig', array('stores' => $stores));
    });

    $app->post("/add_store", function() use ($app) {
    	$name = $_POST['name'];
    	$new_store = new Store($name);
    	$new_store->save();
    	$stores = Store::getAll();
        return $app['twig']->render('stores.twig', array('stores' => $stores));
    });

    $app->delete("/delete_all_stores", function() use ($app) {
      	Store::deleteAll();
    	$stores = Store::getAll();
        return $app['twig']->render('stores.twig', array('stores' => $stores));
    });

    $app->get("/{store_id}/edit_store", function($store_id) use ($app) {
    	$store = Store::find($store_id);
        return $app['twig']->render('edit_store.twig', array('store' => $store));
    });

    $app->patch("/{store_id}/edit_store_done", function($store_id) use ($app) {
    	$store = Store::find($store_id);
    	$new_name = $_POST['new_name'];
    	$store->update($new_name);
    	$stores = Store::getAll();
  		return $app['twig']->render('stores.twig', array('stores' => $stores));
    });

    $app->delete('/{store_id}/deleteSingleStore', function($store_id) use ($app) {
		$store = Store::find($store_id);
		$store->delete();
		return $app['twig']->render('stores.twig', array('stores' => Store::getAll()));	
	});

    $app->get("/brands", function() use ($app) {
    	$brands = Brand::getAll();
        return $app['twig']->render('brands.twig', array('brands' => $brands));
    });

    $app->post("/add_brand", function() use ($app) {
    	$name = $_POST['name'];
    	$new_brand = new Brand($name);
    	$new_brand->save();
    	$brands = Brand::getAll();
        return $app['twig']->render('brands.twig', array('brands' => $brands));
    });

 	$app->get("/{brand_id}/stores_for_brand", function($brand_id) use ($app) {
 		$brand = Brand::find($brand_id);
 		$stores = $brand->getStores();
        return $app['twig']->render('stores_for_brand.twig', array('stores' => $stores, 'brand' => $brand));
    });
    
    $app->get("/{store_id}/brands_of_store", function($store_id) use ($app) {
    	$store = Store::find($store_id);
    	$brands = $store->getBrands();
        return $app['twig']->render('brands_of_store.twig', array('store' => $store, 'brands' => $brands));
    });

    $app->post("/add_brand_to_store", function() use ($app) {
    	$store_id = $_POST['store_id'];
    	$store = Store::find($store_id);
    	$name = $_POST['name'];
    	$new_brand = new Brand($name);
    	$new_brand->save();
    	$store->addBrand($new_brand);
    	$brands = $store->getBrands();
        return $app['twig']->render('brands_of_store.twig', array('store' => $store, 'brands' => $brands));
    });

        $app->post("/add_store_to_brand", function() use ($app) {
    	$brand_id = $_POST['brand_id'];
    	$brand = Brand::find($brand_id);
    	$name = $_POST['name'];
    	$new_store = new Store($name);
    	$new_store->save();
    	$brand->addStore($new_store);
    	$stores = $brand->getStores();
        return $app['twig']->render('stores_for_brand.twig', array('stores' => $stores, 'brand' => $brand));
    });

    return $app;

?>