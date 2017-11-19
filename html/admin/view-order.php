<div class='col-md-9'>
	<div class='jumbotron'>
		<div class='container'>
			<h2>View Order</h2>
			<p>View / Edit an order that has been created.</p>
		</div>
	</div>
	<div class='row'>
		<div class='col-md-9'>
			<div class='panel panel-default'>
				<div class='panel-heading'>
					Order Information
				</div>
				<div class='panel-body'>

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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>