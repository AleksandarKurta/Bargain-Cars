<?php include 'app/views/_global/beforeContent.php'; ?>

	<header>
		<h3>Car Models</h3>
	</header>
		<?php if(Session::exists('addmodel')): ?>
			<div class="alert alert-success" role="alert">
				<?php echo Session::get('addmodel'); ?>
				<?php echo Session::delete('addmodel'); ?>
			</div>
		<?php endif; ?>
		<?php if(Session::exists('editmodel')): ?>
			<div class="alert alert-success" role="alert">
				<?php echo Session::get('editmodel'); ?>
				<?php echo Session::delete('editmodel'); ?>
			</div>
		<?php endif; ?>
	<div class="float-right">
		<a href="<?php echo Configuration::BASE_URL . 'admin/models/add/' ?>" class="btn btn-primary" role="button" aria-pressed="true">Add new model</a>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Model ID</th>
				<th>Model Name</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($DATA['models'] as $model):  ?>
			<tr>
				<td><?php echo $model->model_id; ?></td>
				<td><?php echo $model->name; ?></td>
				<td>
					<?php echo Misc::url('admin/models/edit/' . $model->model_id, 'Edit'); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

<?php include 'app/views/_global/afterContent.php'; ?>