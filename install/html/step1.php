<h2>Connect to the database</h2>
<div class='row'>
	<form action='index.php'>
		<div class=''>
			<div class='col-md-6'>
				<form action='index.php'>
					<input type='hidden' name='step' value='1'>
					<div class='form-group'>
						<lable>Database Hostname</lable>
						<input name='hostname' class='form-control'>
					</div>
					<div class='form-group'>
						<lable>Database Name</lable>
						<input name='database' class='form-control'>
					</div>
					<div class='form-group'>
						<lable>Database Username</lable>
						<input name='username' class='form-control'>
					</div>
					<div class='form-group'>
						<lable>Database Password</lable>
						<input name='password' class='form-control'>
					</div>
					<div class='form-group'>
						<input type='submit' value='Next Step' class='btn btn-success pull-right'>
					</div>
				</form>
			</div>
			<div class='col-md-6'>
				<div class='panel panel-default'>
					<div class='panel-heading'>
						System Requirements
						<?php if($config_is_writable): ?>
							<div class='alert alert-success'>
								<b>OK!</b>
								The config file is writable.
							</div>
						<?php else: ?>
							<div class='alert alert-danger'>
								<b>BAD!</b>
								The config file is not writable.
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
