<?php 

  /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

	require_once "src/Brand.php";
	require_once "src/Store.php";


    $DB = new PDO('pgsql:host=localhost;dbname=shoes_test');

	class StoreTest extends PHPUnit_Framework_TestCase {


		protected function tearDown()
        {
            Brand::deleteAll();
            Store::deleteAll();
        }

		function testGetName()
        {
            //Arrange
            $name = "Mall";
            $test_store = new Store($name);

            //Act
            $result = $test_store->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function testSetName()
        {
            //Arrange
            $name = "Mall1";
            $test_store = new Store($name);
            $new_name = "Mall2";

            //Act
            $test_store->setName($new_name);
            $result = $test_store->getName();

            //Assert
            $this->assertEquals($new_name, $result);
        }

        function testGetId()
        {
            //Arrange
            $name = "Mall";
            $id = 11;
            $test_store = new Store($name, $id);

            //Act
            $result = $test_store->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function testSetId()
        {
            //Arrange
            $name = "Mall";
            $id = 11;
            $test_store = new Store($name, $id);
            $new_id = 22;

            //Act
            $test_store->setId($new_id);
            $result = $test_store->getId();

            //Assert
            $this->assertEquals($new_id, $result);
        }

        function testSave()
        {
            //Arrange
            $name = "Mall";
            $test_store = new Store($name);
            $test_store->save();
            var_dump($name);

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals($test_store, $result[0]);
        }

        function testDeleteAll()
        {
            //Arrange
            $name = "Mall";
            $test_store = new Store($name);
            $test_store->save();

            $name2 = "Mall2";
            $test_store2 = new Store($name2);
            $test_store2->save();

            //Act
            Store::deleteAll();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

 		function testGetBrands()
        {
            //Arrange
            $name = "Mall";
            $test_brand = new Brand($name);
            $test_brand->save();

            $name2 = "Mall2";
            $test_brand2 = new Brand($name2);
            $test_brand2->save();

            $store_name = "Mall";
            $test_store = new Store($store_name);
            $test_store->save();

            $test_store->addBrand($test_brand);
            $test_store->addBrand($test_brand2);

            //Act
            $result = $test_store->getBrands();

            //Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }

        function testAddBrand()
        {
            //Arrange
            $name = "Mall";
            $test_brand = new Brand($name);
            $test_brand->save();

            $store_name = "Mall";
            $test_store = new Store($store_name);
            $test_store->save();

            //Act
            $test_store->addBrand($test_brand);

            //Assert
            $result = $test_store->getBrands();
            $this->assertEquals($test_brand, $result[0]);
        }


	}

 ?>