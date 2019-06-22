<?php include 'app/views/_global/beforeContent.php'; ?>

	<header>
		<h3>Automobil</h3>
	</header>
	<?php if(isset($DATA['alert'])): ?>
		<div class="alert alert-danger" role="alert">
			<?php echo htmlspecialchars($DATA['alert']); ?>
		</div>
	<?php endif; ?>	
	<div class="float-right">
		<a href="<?php echo Configuration::BASE_URL . 'admin/images/car/' . $DATA['car']->car_id . '/add/' ?>" class="btn btn-primary" role="button" aria-pressed="true">Add More Images</a>
	</div>
        <div class="item">
            <p>Car ID: <?php echo $DATA['car']->car_id; ?> </p>
            <p><?php echo htmlspecialchars($DATA['car']->brand->name); ?> <?php echo htmlspecialchars($DATA['car']->model->name); ?></p>
            <p><a href="#"><img src="<?php echo Configuration::BASE_PATH . $DATA['car']->main_image; ?>"></a></p>
       </div>
	<table class="table table-striped">
		<thead>
            <tr>
				<th>ID</th>
				<th>Images</th>
                <th>Created At</th>
				<th>Options</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach(@$DATA['images'] as $image):  ?>
			<tr>
				
				<td><?php echo $image->image_id; ?></td>
				<td><img src="http://localhost/G7/aleksandar_kurta/Singidunum/Project/<?php echo $image->path ?>" alt=""></td>
                <td><?php echo $image->datetime; ?></td>
				<td>    
					<a href="#">Delete</a>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

<?php include 'app/views/_global/afterContent.php'; ?>