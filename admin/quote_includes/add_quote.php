<!-- Page Header -->
<div class="page-header row no-gutters py-4">
	<div class="col-12 col-sm-4 text-center text-sm-left mb-0">
		<span class="text-uppercase page-subtitle">Quotes</span>
		<h3 class="page-title">Add New Quote</h3>
	</div>
</div>

<!-- End Page Header -->
<form method="POST" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-6">
			<div class="card card-small">
				<div class="card-body">
					<div class="form-group">
						<input type="file" id="file-input" name="quote_image" class="form-control" required>
						<div id="thumb-output"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card card-small">
				<div class="card-body">
					<div class="form-group">
						<select name="quote_category" class="form-control">
							<option value="">select category</option>
							<option value="">Option 1</option>
							<option value="">Option 2</option>
						</select>
					</div>
					<div class="form-group">
						<textarea name="quote_content" cols="30" rows="5" class="form-control" placeholder="Keep #calm and #write something..."></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>