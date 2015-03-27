<?php 

	class Brand {
		private $name;
		private $id;

		function __construct($name, $id = null) 
		{
			$this->name = $name;
			$this->id = $id;
		}

		function getName()
		{
			return $this->name;
		}

		function getId()
		{
			return $this->id;
		}

		function setName($new_name)
		{
			$this->name = (string) $new_name;
		}

		function setId($new_id)
		{
			$this->id = (int) $new_id;
		}

		static function save()
		{
			$statement = $GLOBALS['DB']->query("INSERT INTO brands (name) VALUES ('{$this->getName()}') RETURNING id;");
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			$this->setId($result(['id']));
		}

		static function deleteAll()
		{
			$GLOBALS['DB']->exec("DELETE * FROM brands;");
		}

		static function getAll()
		{
			$returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $brands = [];
            foreach($returned_brands as $brand){
                $name = $brand['name'];
                $id = $brand['id'];
                $new_brand = new Brand($name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
		}

		function getBrands()
        {
            $statement = $GLOBALS['DB']->query("SELECT brands.* FROM stores
                                                JOIN brands_stores ON (stores.id = brands_stores.store_id)
                                                JOIN brands ON (brands.id = brands_stores.brand_id)
                                                WHERE stores.id = {$this->getId()};");
            $returned_brands = $statement->fetchAll(PDO::FETCH_ASSOC);
            $brands = [];
            foreach ($returned_brands as $brand) {
                $name = $brand['name'];
                $id = $brand['id'];
                $new_brand = new Brand($name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        function addBrand($new_brand)
        {
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (brand_id, store_id) VALUES ({$new_brand->getId()}, {$this->getId()});");
        }




	}
?>