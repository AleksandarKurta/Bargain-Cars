<?php include 'app/views/_global/beforeContent.php'; ?>

	<header>
		<h1>Add More Images</h1>
	</header>
	
	<form method="POST" enctype="multipart/form-data">
		<?php if(isset($DATA['alert'])): ?>
			<div class="alert alert-danger" role="alert">
				<?php echo htmlspecialchars($DATA['alert']); ?>
			</div>
		<?php endif; ?>	
		
		<div class="form-group">
			<label for="image">Choose Image</label>
			<input type="file" name="image" id="image" required class="form-control-file" id="exampleFormControlFile1">
		</div>
		
		<button type="submit" class="btn btn-primary">Add Image</button>
	</form>
	
	<?php if(isset($DATA['message'])): ?>
		<p>
			<?php echo htmlspecialchars($DATA['message']); ?>
		</p>
	<?php endif; ?>

<?php include 'app/views/_global/afterContent.php'; ?>