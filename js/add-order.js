angular.module('app').controller('add-order', function($scope, $http){
	// Define the inital step
	$scope.step = 3;
	$scope.order = {};

	$scope.next_step = function(){
		if($scope.step == 1 && $scope.order.customer == 'add'){
			// Get the new customers data, and add it.
			var data = $('.add-customer').serialize();
			$http.get('plugin-api.php?api=add-customer&plugin=Device Repair Order Manager&' + data).then(function(data){
				data = data.data;

				// Check that the email does not already exist.
				if(data == 'Email-Used'){
					$scope.email_used = true;
				}
				else if(data == '1'){
					// Display the added customer alert.
					$scope.customer_added = true;
					setTimeout(function(){
						$scope.$apply(function(){
							$scope.customer_added = false;
						})
					}, 3000);

					$scope.step++;
				}
			});
		}

		if($scope.step == 2){
			// Add the devices to the database, if they do not exist.
			$http.get('plugin-api.php?api=add-device&plugin=Device Repair Order Manager&' + data).then(function(data){
				data = data.data;
				if(data == '1'){
					// Display the added customer alert.
					$scope.device_added = true;
					setTimeout(function(){
						$scope.$apply(function(){
							$scope.device_added = false;
						})
					}, 3000);
				}
			});

			// Add the order to the database.
			$http.get('plugin-api.php?api=add-order&plugin=Device Repair Order Manager&order=' + JSON.stringify($scope.order)).then(function(data){
				data = data.data;
				$scope.step++;
			});
		}

		if($scope.step !== 3){
			$scope.step++;
		}
	}

	$scope.print_receipt = function(){
		var css = '@page { size: landscape; }',
		    head = document.head || document.getElementsByTagName('head')[0],
		    style = document.createElement('style');

		style.type = 'text/css';
		style.media = 'print';

		if (style.styleSheet){
		  style.styleSheet.cssText = css;
		} else {
		  style.appendChild(document.createTextNode(css));
		}

		head.appendChild(style);

		window.print();
	}

	$scope.add_customer = function(){
		// Generate the return URL.
		var return_url = "plugin-view.php?action_id=devrepairs&p=add_order";
		var url = "plugin-view.php?action_id=devrepairs&p=add_customer&return=" + return_url;
		window.location.assign(url);
	}
});