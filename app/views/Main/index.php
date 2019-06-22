<?php include 'app/views/_global/beforeContent.php'; ?>
			<?php
				if(!isset($_GET['page'])){
					$page = 1;
				}
			?>
<div class="row">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item active">
			<img class="d-block w-100" src="<?php echo Configuration::BASE_PATH ?>uploads/images/carousel1.jpg" alt="First slide">
			</div>
			<div class="carousel-item">
			<img class="d-block w-100" src="<?php echo Configuration::BASE_PATH ?>uploads/images/carousel2.jpeg" alt="Second slide">
			</div>
			<div class="carousel-item">
			<img class="d-block w-100" src="<?php echo Configuration::BASE_PATH ?>uploads/images/carousel3.jpg" alt="Third slide">
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
</div>

	<div class="row">
	<div class="col-md-8 search-form">	
	<form method="GET" class="form" id="search_form"  action='<?php echo Configuration::BASE_URL; ?>search/page/<?php echo $page ?>/'>

	<header>
		<h3>Search cars</h3>
	</header>

			<div class="form-row">
				<div class="form-group col-md-6">
					<div class="input-group">
					  <div class="input-group-prepend">
						<span class="input-group-text bgr-c" id="inputGroup-sizing-default">Brands</span>
					  </div>
						<select class="form-control" name="brand_id" id="brand_id" onchange="onChangeBrand()">
							<option value="-1"></option>
							<?php foreach($DATA['brands'] as $brand): ?>
								<option value="<?php echo $brand->brand_id; ?>" <?php if($brand->brand_id == @$DATA['brand_id']) echo 'selected' ?>><?php echo htmlspecialchars($brand->name); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				
				<div class="form-group col-md-6">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text bgr-c" id="inputGroup-sizing-default">Models</span>
						</div>
						<select class="form-control" name="model_id" id="model_id">
							<option value="-1"></option>
						
						</select>
					</div>
				</div>
			</div>
			
			<div class="form-row">
				<div class="input-group mb-3 col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text bgr-c" id="inputGroup-sizing-default">Year from</span>
					</div>
					<select class="form-control" name="year_from">
						<option value="-1"></option>
						<?php  for($year_from=date('Y') + 1;$year_from>=1900;$year_from--){
									if($year_from>1980){ ?>
										<option value="<?php echo $year_from ?>" <?php if($year_from == @$DATA['year_from']) echo 'selected'?>><?php echo $year_from; ?></option>
									<?php }elseif($year_from%5==0) { ?>
										<option value="<?php echo $year_from ?>" <?php if($year_from == @$DATA['year_from']) echo 'selected'?>><?php echo $year_from ?></option>
						<?php } }?>
					</select>
				</div>
				
				
				<div class="input-group mb-3 col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text bgr-c" id="inputGroup-sizing-default">Year to</span>
					</div>
					<select class="form-control" name="year_to">
						<option value="-1"></option>
						<?php  for($year_to=date('Y') + 1;$year_to>=1900;$year_to--){
									if($year_to>1980){ ?>
										<option value="<?php echo $year_to ?>" <?php if($year_to == @$DATA['year_to']) echo 'selected'?>><?php echo $year_to; ?></option>
									<?php }elseif($year_to%5==0) { ?>
										<option value="<?php echo $year_to ?>" <?php if($year_to == @$DATA['year_to']) echo 'selected'?>><?php echo $year_to ?></option>
						<?php } }?>
					</select>
				</div>
			</div>	
				
			<div class="form-row">
				<div class="input-group mb-3 col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text bgr-c" id="inputGroup-sizing-default">Price from</span>
					</div>
					<input type="number" name="price_from" id="price_from" min="0" value="<?php echo @$DATA['price_from']; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
				</div>
					
				<div class="input-group mb-3 col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text bgr-c" id="inputGroup-sizing-default">Price to</span>
					</div>
					<input type="number" name="price_to" id="price_to" min="0" value="<?php echo @$DATA['price_to']; ?>"  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
				</div>
			</div>
			
			<div class="form-row">
				<div class="form-group col-md-6">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text bgr-c" id="inputGroup-sizing-default">Locations</span>
						</div>
						<select class="form-control" name="location_id">
							<option value="-1"></option>
							<?php foreach($DATA['locations'] as $location): ?>
								<option value="<?php echo $location->location_id; ?>" <?php if($location->location_id == @$DATA['location_id']) echo 'selected' ?>><?php echo htmlspecialchars($location->name); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
			
			<?php foreach($DATA['checkboxes'] as $checkbox): ?>
			<div class="form-check form-check-inline">
					<input type="checkbox"  class="form-check-input" name="checkbox_ids[]" id="inlineCheckbox1" value="<?php echo $checkbox->checkbox_id; ?>" <?php if(@in_array($checkbox->checkbox_id, @$DATA['checkbox_ids'])) echo 'checked'; ?>>
					<label class="form-check-label" for="inlineCheckbox1"><?php echo htmlspecialchars($checkbox->name); ?></label>
			</div>
			<?php endforeach; ?>
				
			<button type="submit" class="btn btn-primary btn-lg btn-block col-md-6"><i class="fas fa-search"></i> Search</button>
			
		
	</form>
	</div>
	<div class="col-md-4 home-posts">	
		<div class="post-sidebar">
			<header>
				<h3>News</h3>
			</header>
			<?php foreach($DATA['posts'] as $post): ?>
				<p><a href="<?php echo Configuration::BASE_PATH ?>showPost/<?php echo  $post->post_id; ?>"><?php echo htmlspecialchars($post->title); ?></a></p>
			<?php endforeach; ?>
			<a href="<?php echo Configuration::BASE_PATH ?>posts/" class="btn btn-primary btn-sm float-right">More News</a>	
		</div>						
	</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12 col-md-4">

		<?php
			$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";    
			$whatIWant = substr($actual_link, strpos($actual_link, "?") + 1);    
		?>
		
		<?php if(count(@$DATA['cars']) > 0): ?>
			<?php 
				$next = @$DATA['page'] + 1; 
				$prev = @$DATA['page'] - 1;
			?>
			<nav aria-label="Page navigation example">
				<ul class="pagination">
				<li class="page-item <?php if($prev == 0) echo 'disabled' ?>"><a class="page-link" href="http://localhost/G7/aleksandar_kurta/Singidunum/Project/search/page/<?php echo @$DATA['page'] - 1; ?>/?	<?php echo $whatIWant; ?>">Previous</a></li>
				<?php for($page=1;$page<=@$DATA['numberOfPages'];$page++): ?>
					<li class="page-item <?php if($page == $DATA['page']) echo 'active' ?>"><a class="page-link" id="page_button"  href="http://localhost/G7/aleksandar_kurta/Singidunum/Project/search/page/<?php echo $page ?>/?<?php echo $whatIWant; ?>"><?php echo $page; ?></a></li>
				<?php endfor;	?>
				<li class="page-item <?php if($next == $DATA['numberOfPages'] + 1) echo 'disabled' ?>"><a class="page-link" href="http://localhost/G7/aleksandar_kurta/Singidunum/Project/search/page/<?php echo @$DATA['page'] + 1; ?>/?	<?php echo $whatIWant; ?>">Next</a></li>
				</ul>
			</nav>
		<?php endif; ?>

			<?php if(isset($DATA['cars']) && count($DATA['cars']) == 0): ?>
				<div class="alert alert-warning mt-3" role="alert">
					<h4 class="alert-heading">Notification!</h4>
					<p>There are currently no results matching your search criteria. We advise you to advertise the purchase of the vehicle you are looking for, and we will notify you when such a vehicle appears on the site</p>
					<hr>
				</div>
			<?php elseif(isset($DATA['cars'])): ?>
					<?php foreach(@$DATA['cars'] as $car): ?>
				<div id="item">
					<h5><a href="<?php echo Configuration::BASE_PATH ?>car/<?php echo $car->car_id; ?>"><?php echo $car->brand_name; ?> <?php echo $car->model_name; ?></a></h5> 
					<p><a href="<?php echo Configuration::BASE_PATH ?>car/<?php echo $car->car_id; ?>"><img src="<?php echo Configuration::BASE_PATH . $car->main_image; ?>"></a></p>
					
					<div class="item-right">
						<p><?php echo $car->year; ?> year</p>
						<p><?php echo number_format($car->price,0 ,",","."); ?> &euro;</p>
						<p><i class="far fa-calendar-alt"></i> Datum postavke: <?php echo $car->date; ?></p>
						<p><i class="fas fa-map-marker-alt"></i> Location: <?php echo $car->location_name; ?></p>
					</div>
				</div>
				<?php endforeach; ?>
			<?php else: ?>
				<div class="container">
					<div class="row">
						<?php foreach(@$DATA['limitcars'] as $lcar): ?>
							<div class="col-lg-3">
								<a href="<?php echo Configuration::BASE_PATH ?>car/<?php echo $lcar->car_id; ?>"><img class="d-block w-100"  src="<?php echo Configuration::BASE_PATH . $lcar->main_image; ?>"></a>
								<a href="<?php echo Configuration::BASE_PATH ?>car/<?php echo $lcar->car_id; ?>"><strong><?php echo htmlspecialchars($DATA['brand_ids'][$lcar->brand_id]) ?> <?php echo htmlspecialchars($DATA['model_ids'][$lcar->model_id]); ?></strong></a>
								<br><?php echo number_format($lcar->price,0 ,",","."); ?> &euro;
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if(count(@$DATA['cars']) > 0): ?>
			<nav aria-label="Page navigation example">
				<ul class="pagination">
				<li class="page-item <?php if($prev == 0) echo 'disabled' ?>"><a class="page-link" href="http://localhost/G7/aleksandar_kurta/Singidunum/Project/search/page/<?php echo $prev; ?>/?	<?php echo $whatIWant; ?>">Previous</a></li>
				<?php for($page=1;$page<=@$DATA['numberOfPages'];$page++): ?>
					<li class="page-item <?php if($page == $DATA['page']) echo 'active' ?>"><a class="page-link" id="page_button"  href="http://localhost/G7/aleksandar_kurta/Singidunum/Project/search/page/<?php echo $page ?>/?<?php echo $whatIWant; ?>"><?php echo $page; ?></a></li>
				<?php endfor;	?>
				<li class="page-item <?php if($next == $DATA['numberOfPages'] + 1) echo 'disabled' ?>"><a class="page-link" href="http://localhost/G7/aleksandar_kurta/Singidunum/Project/search/page/<?php echo $next; ?>/?	<?php echo $whatIWant; ?>">Next</a></li>
				</ul>
			</nav>
			<?php endif; ?>
		</div>
	</div>


	
<?php include 'app/views/_global/afterContent.php'; ?>