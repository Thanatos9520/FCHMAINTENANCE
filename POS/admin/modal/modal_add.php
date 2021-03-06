<meta http-equiv=content-type content=text/html; charset=utf-8>
<?php include '../../conn.php' ?>
<div id="addProductModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" name="add_product" id="add_product" enctype="multipart/form-data">
					<div class="modal-header bg-success text-white">						
						<h4 class="modal-title">Add Product</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Product Name</label>
							<input type="text" name="name" id="name" class="form-control" required autocomplete="off">
						</div>
						<div class="form-group input-group">
                            <span style="width:120px;" class="input-group-addon">Category:</span>
                            <select style="width:150px;" id="category_p" class="form-control" name="category">
								<?php
									$cat=mysqli_query($conn,"select * from category order by category_name asc");
									while($catrow=mysqli_fetch_array($cat)){
										?>
											<option value="<?php echo $catrow['categoryid']; ?>"><?php echo $catrow['category_name']; ?></option>
										<?php
									}
								?>
							</select>
						</div>
						<div class="form-group input-group">
                            <span style="width:120px;" class="input-group-addon">Supplier:</span>
                            <select style="width:150px;" class="form-control" id="supplier_p" name="supplier">
								<?php
									$sup=mysqli_query($conn,"select * from supplier");
									while($suprow=mysqli_fetch_array($sup)){
										?>
											<option value="<?php echo $suprow['userid']; ?>"><?php echo $suprow['company_name']; ?></option>
										<?php
									}
								?>
							</select>
                        </div>
						<div class="form-group">
							<label>Precio</label>
							<input type="text" name="price" id="price" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Stock</label>
							<input type="number" name="stock" id="stock" class="form-control" required>
						</div>	
						
						<div class="form-group input-group">
							<span style="width:200px;" class="input-group-addon"><b>Photo:(dimensions:400 x 400)</b></span>							
							<input style="height:45px;" class="form-control" accept="*/*" type="file" name="images" id="images">
						</div>
						
						<div class="form-group input-group">
							<span style="width:200px;" class="input-group-addon"><b>PDF:</b></span>							
							<input style="height:45px;" class="form-control" accept="*/*" type="file" name="pdf" id="pdf">
						</div>

						<div class="form-group">
							<label for="exampleTextarea"><b>Description</b></label>
							<textarea class="form-control" name="description" id="description_p" rows="7"></textarea>
                        </div>
                        <div class="form-group">
							<label for="exampleTextarea"><b>Tech Specs</b></label>
							<textarea class="form-control" name="tech" id="tech_p" rows="7"></textarea>
                        </div>
                        <div class="form-group">
							<label for="exampleTextarea"><b>Video</b></label>
							<textarea class="form-control" id="video_p" name="video" rows="7"></textarea>
                        </div>				
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" id="saveStore" value="Save Product">
					</div>
				</form>
			</div>
		</div>
	</div>