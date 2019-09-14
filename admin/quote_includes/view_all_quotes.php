<!-- Page Header -->
<div class="page-header row no-gutters py-4">
	<div class="col-12 col-sm-4 text-center text-sm-left mb-0">
		<span class="text-uppercase page-subtitle">Quotes</span>
		<h3 class="page-title">View All Quotes</h3>
	</div>
</div>
<!-- End Page Header -->

<!-- Default Light Table -->
<div class="row">
	<div class="col">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<div class="row">
					<div class="col-12">
						<h5 class="card-title float-left">All Quotes</h5>
						<a class="btn btn-primary float-right" href="quotes.php?source=add_quote">Add New</a>
					</div>
				</div>
			</div>
			<div class="card-body pb-3 text-left">
				<table class="table table-striped table-bordered" style="width: 100%;" id="view_all_posts">
					<thead class="bg-light">
						<tr>
                            <th>#</th>
							<th>Author</th>
							<th>Image</th>
							<th>Category</th>
							<th>Hash Tags</th>
							<th>Date</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
						<?php 

						$query = "SELECT * FROM quotes ORDER BY quote_id DESC";
						$select_posts = mysqli_query($connection,$query);  
                        confirmQuery($select_posts);
						while($row = mysqli_fetch_assoc($select_posts )) {
							$quote_id           = $row['quote_id'];
							$quote_author       = $row['quote_author'];
							$quote_category   	= $row['quote_category'];
							$quote_hashtags     = $row['quote_hashtags'];
                            $quote_date         = $row['quote_date'];
                            $quote_image        = $row['quote_image'];

							echo "<tr>";

                            echo "<td>$quote_id</td>";
                            echo "<td>$quote_author</td>";
							echo "<td><img style='height: 180px;' class='img-fluid' src='../assets/images/quote-images/{$quote_image}' /><br>
							<div class='blog-comments__actions'>
								<div class='btn-group btn-group-sm'>
									<button type='button' class='btn btn-white'>
										<a href='../quotes.php?q_id={$quote_id}' target='_blank'>
										<span class='text-light'>
											<i class='material-icons'>remove_red_eye</i>
										</span> View 
										</a>
									</button>
									<button type='button' class='btn btn-white'>
										<a href='quotes.php?source=edit_quote&q_id={$quote_id}'>
										<span class='text-light'>
											<i class='material-icons'>edit</i>
										</span> Edit 
										</a>
									</button>
								</div>
							</div>
							</td>";

							$query = "SELECT quote_cat_id, quote_cat_title FROM quote_categories WHERE quote_cat_id = ? ";
                            $stmt = mysqli_prepare($connection, $query);
                            mysqli_stmt_bind_param($stmt, 'i', $quote_category);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_store_result($stmt);
                            mysqli_stmt_bind_result($stmt, $quote_cat_id, $quote_cat_title);
                            mysqli_stmt_fetch($stmt);

                            echo "<td>$quote_cat_title</td>";

							echo "<td>$quote_hashtags</td>";
							echo "<td>$quote_date</td>";

							?>

							<form method="post">
								<input type="hidden" name="quote_id" value="<?php echo $quote_id ?>">
								<?php   
								echo '<td><input class="btn btn-small btn-danger" type="submit" name="delete" value="Delete"></td>';
								?>
							</form>

							<?php echo "</tr>";
						}
						?>
					</tbody>
					<tfoot>
						<tr>
                            <th>#</th>
                            <th>Author</th>
							<th>Image</th>
							<th>Category</th>
							<th>Hash Tags</th>
							<th>Date</th>
							<th>Delete</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- End Default Light Table -->

<?php 

if(isset($_POST['delete'])){
	$the_quote_id = escape($_POST['quote_id']);
	$query = "DELETE FROM quotes WHERE quote_id = {$the_quote_id} ";
	$delete_query = mysqli_query($connection, $query);
	header("Location: /knowledgesheer/admin/quotes.php?source=view_all_quotes");
}

?>