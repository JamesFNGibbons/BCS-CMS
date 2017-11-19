<div class='col-md-9'>
	<div class='jumbotron'>
		<div class='container'>
			<h2>Add new customer</h2>
			<p>Add a new customer to the customer database.</p>
		</div>
	</div>
</div>
<?php if(isset($_GET['email_exists'])): ?>
	<div class='alert alert-danger'>
		<b>Could not add the customer.</b>
		The email is already in use.
	</div>
<?php endif; ?>
<div class='col-md-4'>
	<div class='panel panel-default'>
		<div class='panel-heading'>Add new customer</div>
		<div class='panel-body'>
			<form method='post'>
				<input type='hidden' name='action' value='update'> 
				<div class='form-group'>
					<lable>Name</lable>
					<input type='text' name='name' class='form-control' required>
				</div>
				<div class='form-group'>
					<lable>Email</lable>
					<input type='email' name='email' class='form-control' required>
				</div>
				<div class='form-group'>
					<lable>Phone</lable>
					<input type='text' name='phone' class='form-control' required>
				</div>
				<div class='form-group'>
					<input type='submit' class='btn btn-primary pull-right' class='Add Customer'>
				</div>	
			</form>
		</div>
	</div>
</div>