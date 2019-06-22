<?php include 'app/views/_global/beforeContent.php'; ?>

	<header>
		<h3>Payment Methods</h3>
	</header>
	<div class="float-right">
		<a href="<?php echo Configuration::BASE_URL . 'admin/checkboxes/add/' ?>" class="btn btn-primary" role="button" aria-pressed="true">Add New Payment Method</a>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Payment ID</th>
				<th>Payment Name</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($DATA['checkboxes'] as $checkbox):  ?>
			<tr>
				<td><?php echo $checkbox->checkbox_id; ?></td>
				<td><?php echo $checkbox->name; ?></td>
				<td>
					<?php echo Misc::url('admin/checkboxes/edit/' . $checkbox->checkbox_id, 'Edit'); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

<?php include 'app/views/_global/afterContent.php'; ?>