<!DOCTYPE html>
<html>
<head>
	<title>Bargain Cars</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link href="<?php echo Misc::link('assets/css/main.css'); ?>" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/main.css">
	<script src="<?php echo Misc::link('assets/js/formValidation.js'); ?>"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>
		<nav class="navbar navbar-expand-lg navbar-dark  bg-primary">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="flex-sm-fill text-sm-center nav-link" href="<?php echo Configuration::BASE_URL . ''; ?>"><i class="fas fa-home"></i>Home</a>
				</li>
				<li class="nav-item active">
					<a class="flex-sm-fill text-sm-center nav-link" href="<?php echo Configuration::BASE_URL . 'admin/cars/'; ?>"><i class="fas fa-car"></i>Cars</a>
				</li>
				<li class="nav-item active">
					<a class="flex-sm-fill text-sm-center nav-link" href="<?php echo Configuration::BASE_URL . 'admin/brands/'; ?>"><i class="fas fa-list-ul"></i>Brands</a>
				</li>
				<li class="nav-item active">
					<a class="flex-sm-fill text-sm-center nav-link" href="<?php echo Configuration::BASE_URL . 'admin/models/'; ?>"><i class="fas fa-list-ol"></i>Models</a>
				</li>
				<li class="nav-item active">
					<a class="flex-sm-fill text-sm-center nav-link" href="<?php echo Configuration::BASE_URL . 'admin/checkboxes/'; ?>"><i class="fas fa-money-check-alt"></i>Payment</a>
				</li>
				<li class="nav-item active">
					<a class="flex-sm-fill text-sm-center nav-link" href="<?php echo Configuration::BASE_URL . 'posts/'; ?>"><i class="fas fa-newspaper"></i>Posts</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
					<?php if(Session::get('user_id') === NULL): ?>
						<li class="nav-item active">
							<a class="flex-sm-fill text-sm-center nav-link" href="<?php echo Configuration::BASE_URL . 'register/'; ?>"><i class="fas fa-registered"></i>Register</a>
						</li>
						<li class="nav-item active">
							<a class="flex-sm-fill text-sm-center nav-link" href="<?php echo Configuration::BASE_URL . 'login/'; ?>"><i class="fas fa-sign-in-alt"></i>Log in</a>
						</li>
					<?php else: ?>
						<li class="nav-item active">
							<a class="flex-sm-fill text-sm-center nav-link" href="<?php echo Configuration::BASE_URL . 'logout/'; ?>"><i class="fas fa-power-off"></i>Log out</a>	
						</li>
						<li class="nav-item active">
							<a class="flex-sm-fill text-sm-center nav-link" href="<?php echo Configuration::BASE_URL . 'profile/'; ?>"><i class="fas fa-user"></i> <?php echo Session::get('username'); ?></a>
						</li>
				
					<?php endif; ?>
			</ul>
		  </div>
		</nav>
	<div class="container">

		<div class="main">

	

