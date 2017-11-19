<div class='col-md-9'>
	<div class='jumbotron'>
		<div class='container'>
			<h2>
				View Customer "<font color='white'><i><?php print $customer['Name']; ?></i></font>"
			</h2>
			<p>View customer information, and orders.</p>
		</div>
	</div>
	<div class='page-header'>
		<a href='plugin-view.php?action_id=devrepairs'>
			<i class='fa fa-arrow-left'></i>
			Go Back
		</a>
	</div>
	<div class='row'>
		<div class='col-md-6'>
			<div class='panel panel-default'>
				<div class='panel-heading'>
					Customer information
				</div>
				<div class='panel-body'>
					<form>
						<div class='form-group'>
							<lable>Name</lable>
							<input class='form-control' value='<?php print $customer["Name"]; ?>' name='name'>
						</div>
						<div class='form-group'>
							<lable>Email</lable>
							<input type='email' class='form-control' value='<?php print $customer["Email"]; ?>' name='email'>
						</div>
						<div class='form-group'>
							<lable>Phone</lable>
							<input type='phone' class='form-control' value='<?php print $customer["Phone"]; ?>' name='phone'>
						</div>
						<div class='form-group'>
							<input type='submit' class='btn btn-primary pull-right' value='Save Changes'>
						</div>
					</form>
				</div>
			</div>
				<div class='panel panel-default'>
				<div class='panel-heading'>
					Customer information
				</div>
				<div class='panel-body'>
					<form>
						<div class='form-group'>
							<lable>Name</lable>
							<input class='form-control' value='<?php print $customer["Name"]; ?>' name='name'>
						</div>
						<div class='form-group'>
							<lable>Email</lable>
							<input type='email' class='form-control' value='<?php print $customer["Email"]; ?>' name='email'>
						</div>
						<div class='form-group'>
							<lable>Phone</lable>
							<input type='phone' class='form-control' value='<?php print $customer["Phone"]; ?>' name='phone'>
						</div>
						<div class='form-group'>
							<input type='submit' class='btn btn-primary pull-right' value='Save Changes'>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class='col-md-6'>
			<div class='panel panel-default'>
				<div class='panel-heading'>
					Active Orders
				</div>
				<div class='panel-body'>
					<?php if(count($active_orders) > 0): ?>
						<div class='list-group'>
							<?php foreach($active_orders as $order): ?>
								<a class='list-group-item' style="height: 100px;">
										<div class='col-md-6'>
											<h3><?php print $order['Make']; ?> <?php print $order['Model']; ?></h3>
											<?php print $order['Created']; ?>
										</div>
										<div class='col-md-6'>
											<br>
											<button class='btn btn-primary btn-lg pull-right'>
												View Order
												<i class='fa fa-search'></i>
											</button>
										</div>
									</p>
								</a>
							<?php endforeach; ?>
						</div>
					<?php else: ?>
						<h3 class='text-center'>
							No Active Orders
						</h3>
					<?php endif; ?>
				</div>
			</div>
			<div class='panel panel-default'>
				<div class='panel-heading'>
					Past Orders
				</div>
				<div class='panel-body'>
					<?php if(count($past_orders) > 0): ?>
						<div class='list-group'>
							<?php foreach($past_orders as $order): ?>
								<a class='list-group-item' style="height: 100px;">
										<div class='col-md-6'>
											<h3><?php print $order['Make']; ?> <?php print $order['Model']; ?></h3>
											<?php print $order['Created']; ?>
										</div>
										<div class='col-md-6'>
											<br>
											<button class='btn btn-primary btn-lg pull-right'>
												View Order
												<i class='fa fa-search'></i>
											</button>
										</div>
									</p>
								</a>
							<?php endforeach; ?>
						</div>
					<?php else: ?>
						<h3 class='text-center'>
							No Past Orders
						</h3>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>