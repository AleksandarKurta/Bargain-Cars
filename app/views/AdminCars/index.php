<?php include 'app/views/_global/beforeContent.php'; ?>

	<header>
		<h3>Automobili</h3>
	</header>
	<?php if(Session::exists('addcar')): ?>
		<div class="alert alert-success" role="alert">
			<?php echo Session::get('addcar'); ?>
			<?php echo Session::delete('addcar'); ?>
		</div>
	<?php endif; ?>
	<?php if(Session::exists('editcar')): ?>
		<div class="alert alert-success" role="alert">
			<?php echo Session::get('editcar'); ?>
			<?php echo Session::delete('editcar'); ?>
		</div>
	<?php endif; ?>
	<div class="float-right">
		<a href="<?php echo Configuration::BASE_URL . 'admin/cars/add/' ?>" class="btn btn-primary" role="button" aria-pressed="true">Add new car</a>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Car ID</th>
				<th>Image</th>
				<th>Brand</th>
				<th>Model</th>
				<th>Year</th>
				<th>Price</th>
				<th>User ID</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($DATA['cars'] as $car):  ?>
			<tr>
				
				<td><?php echo $car->car_id; ?></td>
				<td><img src="http://localhost/G7/aleksandar_kurta/Singidunum/Project/<?php echo $car->main_image ?>" alt=""></td>
				
				<td><?php echo $DATA['brands'][$car->brand_id]; ?></td>

				<td><?php echo $DATA['models'][$car->model_id]; ?></td>
		
				<td><?php echo $car->year; ?></td>
				<td><?php echo $car->price; ?></td>
				<td><?php echo $car->user_id; ?></td>
				<td>
					<?php echo Misc::url('admin/cars/edit/' . $car->car_id, 'Edit'); ?>
					||
					<?php echo Misc::url('admin/images/car/' . $car->car_id, 'Images'); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

<?php include 'app/views/_global/afterContent.php'; ?>
