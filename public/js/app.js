var app = angular.module('OrderApp', ['ui.bootstrap.modal']);

/**
 * A generic confirmation for risky actions.
 * Usage: Add attributes: ng-really-message="Are you sure"? ng-really-click="takeAction()" function
 */
app.directive('ngReallyClick', [function() {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            element.bind('click', function() {
                var message = attrs.ngReallyMessage;
                if (message && confirm(message)) {
                    scope.$apply(attrs.ngReallyClick);
                }
            });
        }
    }
}]);

app.controller('OrderEditEventsController', function($scope, $http) {
	$scope.delete = function(id) {
		$http({
			url: '/orderevent/delete',
			method: 'POST',
			data: {
				order_event_id: id
			}
		}).success(function(response) {
			$('table#orderEvents tr#'+id).remove();
		});
	}
});

app.controller('OrderController', function($scope, $http) {
	$scope.getCustomer = function() {
		if ($scope.customer.id.length >= 4) {
			$http({
				url: '/customer/get/'+$scope.customer.id,
				method: 'GET'
			}).success(function(response) {
				$("#customer_name").val(response.name); 
			});
		} else {
			$("#customer_name").val("");
		}
	}
});

app.controller("CreateCustomerController", function($scope, $http) {
	$scope.checkCustomerId = function() {
		if ($scope.customer.id.length >= 4) {
			$http({
				url: '/customer/get/'+$scope.customer.id,
				method: 'GET'
			}).success(function(response) {
				if (!response) {
					$("#div_customer_exists").hide();
				} else {
					$("#div_customer_exists").show();
				}
			});
		}
	}
});