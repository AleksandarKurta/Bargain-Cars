<?php

return [
	[
		'Pattern' => '|^admin/brands/?$|',
		'Controller' => 'AdminBrand',
		'Method' => 'index'
	],
	[
		'Pattern' => '|^admin/brands/add/?$|',
		'Controller' => 'AdminBrand',
		'Method' => 'add'
	],
	[
		'Pattern' => '|^admin/brands/edit/([0-9]+)?$|',
		'Controller' => 'AdminBrand',
		'Method' => 'edit'
	],
	[
		'Pattern' => '|^admin/models/?$|',
		'Controller' => 'AdminModel',
		'Method' => 'index'
	],
	[
		'Pattern' => '|^admin/models/add/?$|',
		'Controller' => 'AdminModel',
		'Method' => 'add'
	],
	[	
		'Pattern' => '|^admin/models/edit/([0-9]+)?$|',
		'Controller' => 'AdminModel',
		'Method' => 'edit'
	],
	[
		'Pattern' => '|^admin/locations/?$|',
		'Controller' => 'AdminLocation',
		'Method' => 'index'
	],
	[
		'Pattern' => '|^admin/locations/add/?$|',
		'Controller' => 'AdminLocation',
		'Method' => 'add'
	],
	[	
		'Pattern' => '|^admin/locations/edit/([0-9]+)?$|',
		'Controller' => 'AdminLocation',
		'Method' => 'edit'
	],
	[
		'Pattern' => '|^admin/checkboxes/?$|',
		'Controller' => 'AdminCheckbox',
		'Method' => 'index'
	],
	[
		'Pattern' => '|^admin/checkboxes/add/?$|',
		'Controller' => 'AdminCheckbox',
		'Method' => 'add'
	],
	[
		'Pattern' => '|^admin/checkboxes/edit/([0-9]+)?$|',
		'Controller' => 'AdminCheckbox',
		'Method' => 'edit'
	],
	[
		'Pattern' => '|^admin/cars/?$|',
		'Controller' => 'AdminCars',
		'Method' => 'index'
	],
	[
		'Pattern' => '|^admin/cars/add/?$|',
		'Controller' => 'AdminCars',
		'Method' => 'add'
	],
	[
		'Pattern' => '|^admin/cars/edit/([0-9]+)?$|',
		'Controller' => 'AdminCars',
		'Method' => 'edit'
	],
	[
		'Pattern' => '|^search/page/([0-9]+)/?.*/?$|',
		'Controller' => 'Main',
		'Method' => 'search'
	],
	[
		'Pattern' => '|^admin/images/car/([0-9]+)?$|',
		'Controller' => 'AdminCarImage',
		'Method' => 'listCarImage'
	],
	[
		'Pattern'    => '|^admin/images/car/([0-9]+)/add/?$|',
		'Controller' => 'AdminCarImage',
		'Method'     => 'uploadImage'
	],
	[
		'Pattern' => '|^car/([0-9]+)?$|',
		'Controller' => 'Main',
		'Method' => 'car'
	],
	[
		'Pattern' => '|^register/?$|',
		'Controller' => 'Main',
		'Method' => 'register'
	],
	[
		'Pattern' => '|^login/?$|',
		'Controller' => 'Main',
		'Method' => 'login'
	],
	[
		'Pattern' => '|^logout/?$|',
		'Controller' => 'Main',
		'Method' => 'logout'
	],
	[
		'Pattern' => '|^profile/?$|',
		'Controller' => 'UserDashboard',
		'Method' => 'profile'
	],
	[
		'Pattern' => '|^admin/post/?$|',
		'Controller' => 'AdminPost',
		'Method' => 'index'
	],
	[
		'Pattern' => '|^posts/?$|',
		'Controller' => 'AdminPost',
		'Method' => 'posts'
	],
	[
		'Pattern' => '|^showPost/([0-9]+)/?$|',
		'Controller' => 'AdminPost',
		'Method' => 'showPost'
	],

	#Api Routes
	[
		'Pattern' => '|^api/car/show/([0-9]+)/?$|',
		'Controller' => 'ApiCars',
		'Method' => 'show'
	],
	[
		'Pattern' => '|^api/car/brands/?$|',
		'Controller' => 'ApiCars',
		'Method' => 'brands'
	],
	[
		'Pattern' => '|^api/car/brand/([0-9]+)/?$|',
		'Controller' => 'ApiCars',
		'Method' => 'brand'
	],
	[
		'Pattern' => '|^api/car/brand/search/([A-z 0-9]+)/?$|',
		'Controller' => 'ApiCars',
		'Method' => 'search'
	],
	[
		'Pattern' => '|^api/car/add/?$|',
		'Controller' => 'ApiCars',
		'Method' => 'add'
	],
	[
		'Pattern' => '|^api/comment/show/([0-9]+)/?$|',
		'Controller' => 'ApiComment',
		'Method' => 'showComment'
	],
	[
		'Pattern' => '|^api/comment/add/?$|',
		'Controller' => 'ApiComment',
		'Method' => 'addComment'
	],
	[
		'Pattern' => '|^api/comment/del/([0-9]+)/?$|',
		'Controller' => 'ApiComment',
		'Method' => 'deleteComment'
	],
	[
		"Pattern" => "|^api/product/add/?$|",
		"Controller" => "ApiProducts",
		"Method" => "add"
	],
	[	# Poslednja Ruta
		'Pattern' => '|^.*$|',
		'Controller' => 'Main',
		'Method' => 'index'
	]

];