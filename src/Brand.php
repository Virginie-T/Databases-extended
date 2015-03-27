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

		function getStores()
        {
            $statement = $GLOBALS['DB']->query("SELECT stores.* FROM brands
                                                JOIN brands_stores ON (brands.id = brands_stores.brand_id)
                                                JOIN stores ON (stores.id = brands_stores.store_id)
                                                WHERE brands.id = {$this->getId()};");
            $returned_brands = $statement->fetchAll(PDO::FETCH_ASSOC);
            $stores = [];
            foreach ($returned_stores as $store) {
                $name = $store['name'];
                $id = $store['id'];
                $new_store = new Store($name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        function addStore($new_store)
        {
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (brand_id, store_id) VALUES ({$this->getId()}, {$new_store->getId()});");
        }




	}
?>