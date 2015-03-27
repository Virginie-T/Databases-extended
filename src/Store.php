<?php 

	class Store {

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

		function save()
		{
			$statement = $GLOBALS['DB']->query("INSERT INTO stores (name) VALUES ('{$this->getName()}') RETURNING id;");
			$result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
		}

		static function deleteAll()
		{
			$GLOBALS['DB']->exec("DELETE FROM stores*;");
		}

		static function getAll()
		{
			$returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $stores = [];
            foreach($returned_stores as $store){
                $name = $store['name'];
                $id = $store['id'];
                $new_store = new Store($name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
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

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

		static function find($search_id)
        {
            $statement = $GLOBALS['DB']->query("SELECT * FROM stores WHERE id = {$search_id};");
            $returned_stores = $statement->fetch(PDO::FETCH_ASSOC);
            $name = $returned_stores['name'];
            $id = $returned_stores['id'];
            $found_store = new Store($name, $id);
            return $found_store;
        }
	}

?>