<div class='col-md-9' ng-app='app' ng-controller='add-order'>
	<div class='wrap'>
		<div class='jumbotron'>
			<div class='container'>
				<h2>Add new order</h2>
				<p>Book a new device in for repair</p>
			</div>
		</div>
		<?php if(isset($_GET['customer_exists'])): ?>
			<div class='alert alert-warning'>
				<b>Could not add customer</b>
				A customer with that email already exists.
				<a class='close' href='plugin-view.php?action_id=devrepairs&p=add_order'>
					&times;
				</a>
			</div>
		<?php endif; ?>
		<div ng-if='customer_added' class='alert alert-success'>
			<b>You have added a new customer.</b>
			<a class='close' data-dismiss='close' data-toggle='alert'>
				&times;
			</a>
		</div>
		<div ng-if='device_added' class='alert alert-success'>
			<b>You have added a new device.</b>
			<a class='close' data-dismiss='close' data-toggle='alert'>
				&times;
			</a>
		</div>
			<div ng-if='add_error' class='alert alert-danger'>
			<b>Error</b>
			We could not add your order.
			<a class='close' data-dismiss='close' data-toggle='alert'>
				&times;
			</a>
		</div>
		<div class='panel panel-default'>
			<div class='panel-heading'>
				Add order wizard
			</div>
			<div class='panel-body'>
				<div class='row'>
					<div class='col-md-4'>
						<div class='well'>
							<h4 ng-if='step == 1' class='text-success text-center'>1) The Customer</h4>
							<h4 ng-if='step !== 1' class='text-center'>1) The Customer</h4>
						</div>
					</div>
					<div class='col-md-4'>
						<div class='well'>
							<h4 ng-if='step == 2' class='text-success text-center'>2) The Device</h4>
							<h4 ng-if='step !== 2' class='text-center'>2) The Device</h4>
						</div>
					</div>
					<div class='col-md-4'>
						<div class='well'>
							<h4 ng-if='step == 3' class='text-success text-center'>3) Verify & Complete</h4>
							<h4 ng-if='step !== 3' class='text-center'>3) Verify & Complete</h4>
						</div>
					</div>
				</div>
				<!-- The customer -->
				<div class='row' ng-if='step == 1'>
					<div class='col-md-5'>
						<div class='page-header'>
							<h2 style='margin: 0; padding: 0;'>
								Select a customer
							</h2>
						</div>
						<?php if(!$has_customers): ?>
							<div ng-init='order.customer = "add"'></div>
						<?php endif; ?>
						<select class='form-control' ng-model='order.customer'>
							<?php foreach($customers as $customer): ?>
								<option value='<?php print $customer["ID"]; ?>'>
									<?php print $customer["Name"]; ?>
								</option>
							<?php endforeach; ?>
							<option value='add'>
								Create New Customer
							</option>
						</select>
					</div>
					<div class='col-md-5' ng-if='order.customer == "add"'>
						<div class='page-header'>
							<h2 style='margin: 0; padding: 0;'>
								Add new customer
							</h2>
						</div>
						<form class='add-customer'>
							<div class='form-group'>
								<lable>Name</lable>
								<input type='text' name='name' class='form-control'>
							</div>
							<div class='form-group'>
								<lable>Email</lable>
								<input type='text' name='email' class='form-control'>
							</div>
							<div class='form-group'>
								<lable>Phone</lable>
								<input type='phone' name='phone' class='form-control'>
							</div>
						</form>
					</div>
				</div>
				<!-- The Device -->
				<div class='row' ng-if='step == 2'>
					<div class='col-md-5'>
						<div class='form-group'>
							<lable>Device Make</lable>
							<?php if(count($devices) > 0): ?>
								<select ng-model='order.device.make' class='form-control'>
									<?php foreach($devices as $device): ?>
										<option value='<?php print $device["Make"]; ?>'>
											<?php print $device["Make"]; ?>
										</option>
									<?php endforeach; ?>
								</select>
							<?php else: ?>
								<input type='text' ng-model='order.device.make' class='form-control' placeholder="Enter Device Make">
							<?php endif; ?>
						</div>
						<div class='form-group'>
							<lable>Device Model</lable>
							<?php if(count($devices) > 0): ?>
								<select ng-model='order.device.model' class='form-control'>
									<?php foreach($devices as $device): ?>
										<option value='<?php print $device["Model"]; ?>'>
											<?php print $device["Model"]; ?>
										</option>
									<?php endforeach; ?>
								</select>
							<?php else: ?>
								<input type='text' ng-model='order.device.model' class='form-control' placeholder="Enter Device Model">
							<?php endif; ?>
						</div>
						<div class='form-group'>
							<lable>IMEI / Serial</lable>
							<input type='text' ng-model='order.device.serial' class='form-control'>
						</div>
						<div class='form-group'>
							<lable>Password / Passcode</lable>
							<input type='text' ng-model='order.device.passcode' class='form-control'>
						</div>
					</div>
					<div class='col-md-5'>
						<div class='form-group'>
							<lable>Job Description</lable>
							<textarea style='height: 170px;' class='form-control' ng-model='order.device.description'></textarea>
						</div>
						<div class='form-group'>
							<lable>Price Quoted</lable>
							<div class='input-group'>
								<span class='input-group-addon'>
									&pound;
								</span>
								<input type='text' ng-model='order.price_quoted' class='form-control'>
							</div>
						</div>
					</div>
				</div>
				<div ng-if='step == 3'>
					<div class='col-md-4'>
						<div class='page-header'>
							<h2>Actions</h2>
						</div>
						<div class='panel-body'>
							<button ng-click='print_receipt()' style='width: 100%' class='btn btn-primary btn-lg'>
								Booking in receipt
							</button>
							<br><br>
							<button style='width: 100%' class='btn btn-primary btn-lg'>
								Tracking Code
							</button>
							<br><br>
							<a style='width: 100%;' class='btn btn-primary btn-lg' href='plugin-view.php?action_id=devrepairs'>
								Finish
							</a> 
						</div>
					</div>
					<div class='col-md-3'>
						<img src='https://upload.wikimedia.org/wikipedia/commons/thumb/d/dd/Antu_task-complete.svg/2000px-Antu_task-complete.svg.png' class='center-block' width='100%'>
					</div>
					<div class='col-md-4'>
						<h1 class='text-success'>Completed!</h1>
						<h4>
							You booked a {{order.device.make}} {{order.device.model}} in for repair.
							<br><br>
							Please use the buttons on your left to print off the information for the customer and tracking.					
						</h4>
					</div>
				</div>
				<button ng-if='step !== 3' ng-click='next_step()' class='btn btn-primary pull-right'>Next Step</button>
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
</div>	