<?php

class ApiProductsController extends ApiController{
	
	public function show($id){
		$product_id = intval($id);
		$product = ProductModel::getById($product_id);
		if($product){
			$product->categories = ProductModel::getProductCategories($product_id);
			$this->set("product",$product);
			$this->set("status","success");
		}else{
			$this->set("status","error");
			$this->set("message","Could not find selected product");
		}
		
	}
	
	public function categories(){
		$categories = ProductCategoryModel::getAll();
		if($categories){
			$this->set("categories",$categories);
			$this->set("status","success");
		}else{
			$this->set("status","error");
			$this->set("message","There are no product categories yet");
		}
	}
	
	public function category($id){
		$product_category_id = intval($id);
		$products = ProductCategoryModel::getProducts($product_category_id);
		if($products){
			$this->set("products",$products);
			$this->set("status","success");
		}else{
			$this->set("status","error");
			$this->set("message","Could not find any products in this category");
		}	
	}
	
	public function search($keyword){
		$products = ProductModel::getByKeyword($keyword);
		if($products){
			$this->set("products",$products);
			$this->set("status","success");
		}else{
			$this->set("status","error");
			$this->set("message","Could not find any products that match this keyword");
		}
	}
	
	public function add(){
		if($_POST){
			$name = filter_input(INPUT_POST,'name');
			$description = filter_input(INPUT_POST,'description');
			$price = floatval(filter_input(INPUT_POST,'price'));
			
			$categories = filter_input(INPUT_POST,'categories',FILTER_DEFAULT,FILTER_REQUIRE_ARRAY);
			
			$id = ProductModel::add($name,$description,$price,1);
			if(!$id){
				$this->set("status","error");
				$this->set("message","Could not find any products in this category");
				return;
			}
			
			foreach($categories as $category){
				ProductCategoryModel::addProduct($id, $category);
			}
			
			$this->set("product_id",$id);
			$this->set("status","success");
		}else{
			$this->set("status","error");
			$this->set("message","Illegal function call.");
		}
		
	}
		
}