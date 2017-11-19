<div class='col-md-9'>
	<div class='jumbotron'>
		<div class='container'>
			<h2>View Order</h2>
			<p>View / Edit an order that has been created.</p>
		</div>
	</div>
	<div class='page-header'>
		<a href='plugin-view.php?action_id=devrepairs'>
			<i class='fa fa-arrow-left'></i>
			Go Back
		</a>
	</div>
	<div class='row'>
		<div class='col-md-9'>
			<div class='panel panel-default'>
				<div class='panel-heading'>
					Order Information
				</div>
				<div class='panel-body'>
					<div class='row'>
						<form action='plugin-view.php'>
							<input type='hidden' name='action_id' value='devrepairs'>
							<input type='hidden' name='p' value='save_order'>
							<input type='hidden' name='id' value='<?php print $order["ID"]; ?>'>
							<div class='col-md-6'>
								<div class='form-group'>
									<lable>Device Make</lable>
									<input type='text' name='make' value='<?php print $order["Make"]; ?>' class='form-control' placeholder="Enter Device Make">
								</div>
								<div class='form-group'>
									<lable>Device Model</lable>
									<input type='text' name='model' value='<?php print $order["Model"]; ?>' class='form-control' placeholder="Enter Device Model">
								</div>
								<div class='form-group'>
									<lable>IMEI / Serial</lable>
									<input type='text' name='serial_no' value='<?php print $order["Serial_No"]; ?>' class='form-control'>
								</div>
								<div class='form-group'>
									<lable>Password / Passcode</lable>
									<input type='text' name='password' value='<?php print $order["Password"]; ?>' class='form-control'>
								</div>
							</div>
							<div class='col-md-6'>
								<div class='form-group'>
									<lable>Job Description</lable>
									<textarea name='job_desc' style='height: 170px;' class='form-control'><?php print $order['Job_Desc']; ?></textarea>
								</div>
								<div class='form-group'>
									<lable>Price Quoted</lable>
									<div class='input-group'>
										<span class='input-group-addon'>
											&pound;
										</span>
										<input type='text' name='price_quoted' value='<?php print $order["Price_Quoted"]; ?>' class='form-control'>
									</div>
								</div>
							</div>
							<div class='col-md-12'>
								<input type='submit' class='btn btn-primary pull-right' value='Save Changes'>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class='col-md-3'>
			<div class='panel panel-default'>
				<div class='panel-heading'> 
					Quick Actions
				</div>
				<div class='panel-body'>
					<div class='list-group'>
						<a href='plugin-view.php?action_id=devrepairs&p=complete_order&id=<?php print $order["ID"]; ?>' class='list-group-item bg-success'>
							<i class='fa fa-check'></i>
							Mark Complete
						</a>
						<a href='plugin-view.php?action_id=devrepairs&p=view_customer&id=<?php print $order["Customer"]; ?>' class='list-group-item'>
							<i class='fa fa-user'></i>
							View Customer
						</a>
						<a href='plugin-view.php?action_id=devrepairs&p=delete_order&id=<?php print $order["ID"]; ?>' class='list-group-item'>
							<i class='fa fa-trash'></i>
							Delete Order
						</a>
						<a href='plugin-view.php?action_id=devrepairs' class='list-group-item'>
							<i class='fa fa-arrow-left'></i>
							Go Back
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>