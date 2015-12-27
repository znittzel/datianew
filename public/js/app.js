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