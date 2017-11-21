<div class='col-md-9' ng-app='app' ng-controller='view-order'>
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
						<a href='plugin-view.php?action_id=devrepairs&p=delete_order&id=<?php print $order["ID"]; ?>' class='list-group-item'>
							<i class='fa fa-print'></i>
							Customer Receipt
						</a>
						<a target='_blank' href='plugin-view.php?action_id=devrepairs&p=do_print_barcode&id=<?php print $order["ID"]; ?>' class='list-group-item'>
							<i class='fa fa-barcode'></i>
							Barcode Tracker
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
<style>
	.printable {display: none;}

	@media print {
		.wrap * {
				display: none;
			}
			.list-group {
				display: none;
			}
			.printable {display: block;}
			.receipt {
				width: 16cm;
			}
			.col-print-1 {width:8%;  float:left;}
		.col-print-2 {width:16%; float:left;}
		.col-print-3 {width:25%; float:left;}
		.col-print-4 {width:33%; float:left;}
		.col-print-5 {width:42%; float:left;}
		.col-print-6 {width:50%; float:left;}
		.col-print-7 {width:58%; float:left;}
		.col-print-8 {width:66%; float:left;}
		.col-print-9 {width:75%; float:left;}
		.col-print-10{width:83%; float:left;}
		.col-print-11{width:92%; float:left;}
		.col-print-12{width:100%; float:left;}
	}
</style>
<!-- The booking in recepipt printable -->
<div class='printable a4'>
	<div class='receipt'>
		<div class='thumbnail'>
			<div class='row'>
				<div class='col-print-4'>
					<img src='http://jascomms.co.uk/uploads/14-11-17/5a0b617a0cfe0.png' width='100%'>
				</div>
				<div class='col-print-4'>
					<p class='text-center'><b>Booking in Receipt</b></p>
					<br>
					<p class='text-center'>This receipt must be produced when collecting your item.</p>
				</div>
				<div class='col-print-4'>
					<p class='text-right' style='margin: 0; padding: 0;'><b>JAS Comms Limited</b>
					<p class='text-right' style='margin: 0; padding: 0;'>74 Derby Road, Stapleford</p>
					<p class='text-right' style='margin: 0; padding: 0;'>Nottingham, NG9 7AB</p>
					<p class='text-right' style='margin: 0; padding: 0;'>Tel: 0115 949 9136</p>
					<p class='text-right' style='margin: 0; padding: 0;'>www.jascomms.com</p>
				</div>
				<div class='col-print-12'>
					<table border="1" style='width: 100%;'>
						<td>
							<table border='1' style='width: 100%; height: 100%;'>
								<tr>
									<td>Date</td>
									<td></td>
								</tr>
								<tr>
									<td>Name</td>
									<td></td>
								</tr>
								<tr>
									<td>Contact No.</td>
									<td></td>
								</tr>
								<tr>
									<td>Item Description</td>
									<td></td>
								</tr>
								<tr>
									<td>IMEI / Serial</td>
									<td></td>
								</tr>
								<tr>
									<td>Passcode</td>
									<td></td>
								</tr>
							</table>
						</td>
						<td>
							<div style='width: 100%; height: 200px'>
								<b>Job Description</b>
								{{order.job_description}}
							</div>
						</td>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
