'use strict';

/* FUNKTIONER */

var getLabelByBusiness = function(business) {
	if (business == "1")
		return '<span class="label label-primary">Företag</span>';
	else
		return '<span class="label label-default">Privat</span>';
}

var getLabelByReputation = function(rep) {
	switch (rep) {
		case "0":
			return '<span class="label label-default">Inget omdöme</span>';
			break;
		case "1":
			return '<span class="label label-warning">Problem med betalning</span>';
			break;
		case "2":
			return '<span class="label label-danger">Faktureras ej</span>';
			break;
	}
}

/*----END FUNKTIONER---*/

var app = angular.module('OrderApp', 
	[
	'ui.bootstrap.modal',
	'ngResource',
	'ngAnimate'
	], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

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

/*
	Controller i order/edit_order.blade.php.
	Används till order_events_div -div
*/
app.controller('OrderEditEventsController', function($scope, $http) {

	/*
		Delete(id): tar bort OrderEvent från databasen med order_event_id = id och ifrån table:n vid success
	*/
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

/*
	Controller i customer/show_customer.blade.php.
	Används till customerOrders -table
*/
app.controller('CustomerEditOrdersController', function($scope, $http) {

	/*
		Delete(id): tar bort Ordern från databasen med id = id och ifrån table:n vid success
	*/
	$scope.delete = function(id) {
		$http({
			url: '/order/delete',
			method: 'POST',
			data: {
				id: id
			}
		}).success(function(response){
			$('table#customerOrders tr#'+id).remove();
		});
	}
});

/*
	Controller i order/create_order.blade.php && order/edit_order.blade.php
	Används till create_order_form -form && edit_order_form
*/
app.controller('OrderController', function($scope, $http) {
	/*
		getCustomer(): hämtar kund från databasen. Trimmar customer.id innan anrop
	*/
	$scope.getCustomer = function() {
		$scope.customer.id = $scope.customer.id.replace(/ /g, '');

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

	/*
		trimOrderId(): trimmar order.id innan skapande av ny order
	*/
	$scope.trimOrderId = function() {
		$scope.order.id = $scope.order.id.replace(/ /g, '');
	}
});

/*
	Controller i customer/create_customer.blade.php
	Används till create_customer -form
*/
app.controller("CustomerCreateController", function($scope, $http) {
	$scope.checkCustomerId = function() {
		$scope.customer.id = $scope.customer.id.replace(/ /g, '');

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

app.controller("CustomerEditController", function($scope, $http) {
	$scope.editCustomer = function(customer_id, id) {
		$http({
			method: 'GET',
			url: '/customer/get/'+customer_id
		}).success(function(customer) {
			$scope.rowId = id;
			$scope.customer = customer;	

			$("#modal").modal('show');
		});
	}

	$scope.saveCustomer = function(customer, rowId) {
		$http({
			url: '/customer/saveAjax',
			method: 'POST',
			data: customer
		}).then(function successCallback(response) {
		    var row = $("#"+rowId);

		    $(row.children()[2]).html('<a href="#" onclick="editCustomerJavascript('+customer.customer_id+','+rowId+')">'+customer.name+'</a>');
		    $(row.children()[3]).html(customer.telephone_number);
		    $(row.children()[4]).html(getLabelByBusiness(customer.business));
		    $(row.children()[5]).html(getLabelByReputation(customer.reputation));

		    $("#modal").modal('hide');
		  }, function errorCallback(response) {
		    console.log(response);
		  });
	}
});
