<?php include 'app/views/_global/beforeContent.php'; ?>

	<header>
		<h3>Car Brands</h3>
	</header>
	<?php if(Session::exists('addbrand')): ?>
		<div class="alert alert-success" role="alert">
			<?php echo Session::get('addbrand'); ?>
			<?php echo Session::delete('addbrand'); ?>
		</div>
	<?php endif; ?>
	<?php if(Session::exists('editbrand')): ?>
		<div class="alert alert-success" role="alert">
			<?php echo Session::get('editbrand'); ?>
			<?php echo Session::delete('editbrand'); ?>
		</div>
	<?php endif; ?>
	<div class="float-right">
		<a href="<?php echo Configuration::BASE_URL . 'admin/brands/add/' ?>" class="btn btn-primary" role="button" aria-pressed="true">Add new brand</a>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Brand ID</th>
				<th>Brand Name</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($DATA['brands'] as $brand):  ?>
			<tr>
				<td><?php echo $brand->brand_id; ?></td>
				<td><?php echo $brand->name; ?></td>
				<td>
					<?php echo Misc::url('admin/brands/edit/' . $brand->brand_id, 'Edit'); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

<?php include 'app/views/_global/afterContent.php'; ?>