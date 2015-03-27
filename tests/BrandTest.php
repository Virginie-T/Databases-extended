<?php 

  /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

	require_once "src/Brand.php";

  	$DB = new PDO('pgsql:host=localhost;dbname=shoes_test');

	class BrandTest extends PHPUnit_Framework_TestCase {

	protected function tearDown()
	{
		Brand::deleteAll();
	}

		function testGetName()
        {
            //Arrange
            $name = "Vans";
            $test_brand = new Brand($name);

            //Act
            $result = $test_brand->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function testSetName()
        {
            //Arrange
            $name = "Vans";
            $test_brand = new Brand($name);
            $new_name = "Converse";

            //Act
            $test_brand->setName($new_name);
            $result = $test_brand->getName();

            //Assert
            $this->assertEquals($new_name, $result);
        }

        function testGetId()
        {
            //Arrange
            $name = "Vans";
            $id = 11;
            $test_brand = new Brand($name, $id);

            //Act
            $result = $test_brand->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function testSetId()
        {
            //Arrange
            $name = "Vans";
            $id = 11;
            $test_brand = new Brand($name, $id);
            $new_id = 22;

            //Act
            $test_brand->setId($new_id);
            $result = $test_brand->getId();

            //Assert
            $this->assertEquals($new_id, $result);
        }

        function testSave()
        {
            //Arrange
            $name = "Vans";
            $test_brand = new Brand($name);
            $test_brand->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals($test_brand, $result[0]);
        }

        function testDeleteAll()
        {
            //Arrange
            $name = "Vans";
            $test_brand = new Brand($name);
            $test_brand->save();

            $name2 = "Converse";
            $test_brand2 = new Brand($name2);
            $test_brand2->save();

            //Act
            Brand::deleteAll();
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

 		function testGetStores()
        {
            //Arrange
            $name = "Vans";
            $test_brand = new Brand($name);
            $test_brand->save();

            $name2 = "Converse";
            $test_brand2 = new Brand($name2);
            $test_brand2->save();

            $store_name = "Mall";
            $test_store = new Store($store_name);
            $test_store->save();

            $test_store->addStore($test_brand);
            $test_store->addStore($test_brand2);

            //Act
            $result = $test_store->getBrands();

            //Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }

        function testAddBrand()
        {
            //Arrange
            $name = "Vans";
            $test_brand = new Brand($name);
            $test_brand->save();

            $store_name = "Mall";
            $test_store = new Store($store_name);
            $test_store->save();

            //Act
            $test_store->addStore($test_brand);

            //Assert
            $result = $test_store->getBooks();
            $this->assertEquals($test_brand, $result[0]);
        }











	}

 ?>