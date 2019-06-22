<?php include 'app/views/_global/beforeContent.php'; ?>
<header>
	<h3>Edit car brand</h3>
<header>
<form method="POST">	
	<?php if(isset($DATA['alert'])): ?>
		<div class="alert alert-danger" role="alert">
			<?php echo htmlspecialchars($DATA['alert']); ?>
		</div>
	<?php endif; ?>
	<div class="row">	
		<div class="col-sm-12 col-md-4">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text bgr-c" id="inputGroup-sizing-default">Car Brand Name</span>
				</div>
				<input type="text" name="name" id="name" required value="<?php echo htmlspecialchars($DATA['brand']->name); ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
			</div>
			
			<button type="submit" class="btn btn-primary btn-lg btn-block">Edit</button>
			
			<?php if(isset($DATA['message'])): ?>
				<p>
			<?php	echo $DATA['message']; ?>
				</p>
			<?php endif; ?>
		</div>
	</div>
</form>
<?php include 'app/views/_global/afterContent.php'; ?>