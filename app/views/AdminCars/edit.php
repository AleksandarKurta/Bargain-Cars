<?php include 'app/views/_global/beforeContent.php'; ?>
	<header>
		<h3>Edit car</h3>
	</header>
	
	<form method="POST">
	<?php if(isset($DATA['alert'])): ?>
		<div class="alert alert-danger" role="alert">
			<?php echo htmlspecialchars($DATA['alert']); ?>
		</div>
	<?php endif; ?>	
		<div class="row">
			<div class="col-sm-12 col-md-4">
				<div class="form-group">
					<div class="input-group">
					  <div class="input-group-prepend">
						<span class="input-group-text" id="inputGroup-sizing-default">Brands</span>
					  </div>
						<select class="form-control" name="brand_id">
							<?php foreach($DATA['brands'] as $brand): ?>
								<option value="<?php echo $brand->brand_id; ?>" <?php if($brand->brand_id == $DATA['car']->brand_id) echo 'selected'?>><?php echo htmlspecialchars($brand->name); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<div class="input-group">
					  <div class="input-group-prepend">
						<span class="input-group-text" id="inputGroup-sizing-default">Models</span>
					  </div>
						<select class="form-control" name="model_id">
							<?php foreach($DATA['models'] as $model): ?>
								<option value="<?php echo $model->model_id; ?>" <?php if($model->model_id == $DATA['car']->model_id) echo 'selected'?>><?php echo htmlspecialchars($model->name); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputGroup-sizing-default">Year</span>
					</div>
					<input type="text" name="year" id="year" required value="<?php echo htmlspecialchars($DATA['car']->year); ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
				</div>
				
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputGroup-sizing-default">Price</span>
					</div>
					<input type="text" name="price" id="price" required value="<?php echo htmlspecialchars($DATA['car']->price); ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
				</div>

				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text">Description</span>
					</div>
					<textarea class="form-control" id="description" name="description" rows="4"><?php echo htmlspecialchars($DATA['car']->description); ?></textarea>
				</div>

				
				<div class="form-group">
					<div class="input-group-prepend">
						<div class="input-group-prepend">
						<span class="input-group-text" id="inputGroup-sizing-default">Locations</span>
						 </div>
						<select class="form-control" name="location_id">
							<option value="-1"></option>
							<?php foreach($DATA['locations'] as $location): ?>
								<option value="<?php echo $location->location_id; ?>" <?php if($location->location_id == $DATA['car']->location_id) echo 'selected'?>><?php echo htmlspecialchars($location->name); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				
				<label>Dodaci:</label><br/>
			
				<?php foreach($DATA['checkboxes'] as $checkbox): ?>
					<input type="checkbox" name="checkbox_ids[]" id="checkboxes" value="<?php echo $checkbox->checkbox_id; ?>" <?php if(in_array($checkbox->checkbox_id, $DATA['car']->checkbox_ids)) echo 'checked'; ?>><?php echo htmlspecialchars($checkbox->name); ?><br/>
				<?php endforeach; ?>
			
			<button type="submit" class="btn btn-primary btn-lg btn-block">Edit</button>
			</div>
		</div>
	</form>
	<?php if(isset($DATA['message'])): ?>
		<p>
			<?php echo htmlspecialchars($DATA['message']); ?>
		</p>
	<?php endif; ?>
<?php include 'app/views/_global/afterContent.php'; ?>