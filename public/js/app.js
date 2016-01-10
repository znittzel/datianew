'use strict';

/* GLOBALA INSTÄLLNINGAR */
	 window.Parsley
      .addValidator('orderexists', {
        requirementType: 'boolean',
        validateNumber: function(value, requirement) {
            if (requirement) {
                var ok = false;
              $.ajax({
                url: '/order/exists/'+value,
                async: false,
                success: function(order) {
                    if (!order.exists) 
                        ok = true;
                    else
                        ok = false;
                }
              });

              return ok;
            }
        },
        messages: {
          sv: 'Order existerar.'
        }
      });

      window.Parsley
      .addValidator('customerexists', {
        requirementType: 'boolean',
        validateNumber: function(value, requirement) {
            if (requirement) {
                var ok = false;
              $.ajax({
                url: '/customer/exists/'+value,
                async: false,
                success: function(customer) {
                    if (!customer.exists) 
                        ok = true;
                    else
                        ok = false;
                }
              });

              return ok;
            }
        },
        messages: {
          sv: 'Kund existerar.'
        }
      });

      window.Parsley
      .addValidator('articleexists', {
        requirementType: 'string',
        validateString: function(value, requirement) {
          var ok = false;
          $.ajax({
            url: '/article/exists/'+value,
            async: false,
            success: function(article) {
	            if (requirement) {
	                if (!article.exists) 
	                    ok = true;
	                else
	                    ok = false;
	            } else {
	            	if (article.exists) 
	                    ok = true;
	                else
	                    ok = false;
	            }
            }
          });

          return ok;
        },
        messages: {
          sv: 'Fel med artikelnummer.'
        }
      });

      window.Parsley
      .addValidator('emailexists', {
        requirementType: 'string',
        validateString: function(value, requirement) {
            if (requirement) {
                var ok = false;
              $.ajax({
                url: '/admin/user/exists/'+value,
                async: false,
                success: function(user) {
                    if (!user.exists) 
                        ok = true;
                    else
                        ok = false;
                }
              });

              return ok;
            }
        },
        messages: {
          sv: 'Användare existerar.'
        }
      });
/*---END GLOBALA INSTÄLLNINGAR---*/

/* FUNKTIONER */

var getColorCodeByState = function(state, prio) {
	if (prio && (state == '1'))
	{
		return 'black';
	} else {
		switch (state) {
			case '1':
				return '#a50000';
				break;
			case '2':
				return '#a5a300';
				break;
			case '3':
				return '#828282';
				break;
			case '4':
				return '#0ca500';
				break;
		}
	}
}

/*
	getLabelByBusiness(business);
	Ger tillbaka en Label om företag eller privat
*/
var getLabelByBusiness = function(business) {
	if (business == "1")
		return '<span class="label label-primary">Företag</span>';
	else
		return '<span class="label label-default">Privat</span>';
}


/*
	getLabelByReputation(rep);
	Ger tillbaka en Label beroende på kunds rykte
*/
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

/*
	getPanelClassByState(state, business);
	Ger tillbaka en class beroende på state, företag (business) och vilken sort (class)
*/
var getClassByState = function(state, business, prio, classname) {
	if (state == '3' || state == '4') {
		switch (state) {
			case '3':
				return classname+'-default';
				break;
			case '4':
				return classname+'-success';
				break;
		}
	} else {
		if (prio) {
			switch (state) {
				case '1':
					return classname+'-high-prio';
					break;
				case '2':
					return classname+'-default';
					break;
			}
		} else {
			if (business) {
				switch (state) {
					case '1':
						return classname+'-primary';
						break;
					case '2':
						return classname+'-info';
						break;
				}
			} else {
				switch (state) {
					case '1':
						return classname+'-danger';
						break;
					case '2':
						return classname+'-warning';
						break;
				}
			}
		}
	}
	
}

var getStateName = function(status) {
	switch (status) {
		case '1':
			return 'Ej påbörjad';
			break;
		case '2':
			return 'Påbörjad';
			break;
		case '3':
			return 'Arkiverad';
			break;
		case '4':
			return 'Avslutad';
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
	$scope.modalGetCustomer = function() {
		$http({
			url: '/customer/getCustomers',
			method: 'GET'
		}).success(function(customers) {
			$scope.customers = customers;
			$("#customerModal").modal('show');
		});
	}

	$scope.chooseCustomer = function(customer_id) {
		if (customer_id) {
			$http({
				url: '/customer/get/'+customer_id
			}).success(function(customer) {
				$("#customer_id").val(customer.customer_id);
				$("#customer_name").val(customer.name);
			});

			$("#customerModal").modal('hide');
		}
	} 

	$http({
		url: '/order/getNextOrderId',
		method: 'GET'
	}).success(function(nextId) {
		$("#order_id").val(nextId);
	});

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
	$http({
		url: '/customer/getNextId',
		method: 'GET'
	}).success(function(id) {
		$("#customer_id").val(id);
	});
});

/*

	Controller i customer/customer.blade.php
	Används till Edit Customer Modal, #modal
*/
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
		    $('#edit_customer').parsley().reset();
		  }, function errorCallback(response) {
		    console.log(response);
		  });
	}

	$scope.close = function() {
		$('#edit_customer').parsley().reset();
		$("#modal").modal('hide');
	}
});

app.controller('CommentOrderController', ['$scope', '$http', function($scope, $http) {
	$scope.save = function(comment) {
		if ($("#comment_order").parsley().isValid()) {
			$http({
				url: '/order/comment',
				method: 'POST',
				data: comment
			}).success(function(res) {
				$("#comments").append('<div class="row order-comment-row"><div class="col-md-7 order-comment">'+res.event.comment+'</div><div class="col-md-4 order-comment">'+res.event.created_at+'</div><div class="col-md-1 order-comment">'+res.event.sign+'</div></div>');
				var classname = getClassByState(res.status, res.business, res.prio,'panel');

				$("#panel_order").removeClass($("#panel_order").removeClass(comment.panel_classname));
				$("#panel_order").addClass(classname);

				if (res.status == '4') {
					$("#div_deliver_order").removeClass("hidden");
					$("#div_ongoing_order").addClass("hidden");
				}

				$scope.comment = {};
				$scope.comment.panel_classname = classname;
				$scope.comment.order_id = res.event.order_id;
			}).error(function(response){
				console.log(response);
			});
		}

		$scope.closeModal();
	}

	$scope.closeModal = function() {
		$("#modalComment").modal('hide');
		$('#comment_order').parsley().reset();
	}
}]);

app.controller('AddArticleOrderController', ['$scope', '$http', function($scope, $http) {
	$scope.save = function(article) {
		if ($("#article_order").parsley().isValid()) {
			$http({
				url: '/article/order/add',
				method: 'POST',
				data: article
			}).success(function(res) {
				$("#articles").append('<li class="list-group-item"> <span class="badge">'+article.quantity+' st</span>'+article.article_id+' - '+article.sign+' </li>'); 
				$scope.article = {};
				$scope.order_id = article.order_id;
			}).error(function(res) {
				console.log(res);
			});
			$scope.closeModal();
		}
	}

	$scope.closeModal = function() {
		$("#modalArticle").modal('hide');
		$('#article_order').parsley().reset();
	}
}]);

app.controller('ArticlesEditController', ['$scope', '$http', function($scope, $http) {
	$scope.delete = function(id) {
		$http({
			url: '/article/order/delete',
			method: 'POST',
			data: {id: id}
		}).success(function(res) {
			$('table#articles tr#'+'article_'+id).remove();
		}).error(function(res) {
			console.log(res);
		});
	}
}]);

app.controller('CalendarController', ['$scope', '$http', '$resource', function($scope, $http, $resource) {
	$('#calendar').fullCalendar({
		events: {
			url: '/calendar/events',
			success: function(events) {
				$.each(events, function(index, event) {
					event.title = event.order.reg_number;
					event.url = "/order/"+event.order.id+"/show";
				});
			}
		},
		eventRender: function(event, element) {
			element.css('background-color', getColorCodeByState(event.order.status, event.order.prio));
			element.css('border-color', '#6a6a6a');
		},
		// eventClick: function(calEvent, jsEvent, view) {
		// 	$http({
		// 		url: '/calendar/getEvent/'+calEvent.order_id,
		// 		method: 'GET'
		// 	}).success(function(response) {
		// 		$scope.data = response;
		// 		$scope.data.order.booked_at = Date.parse(response.order.booked_at);
		// 		$scope.data.order.pickup_at = Date.parse(response.order.pickup_at);
		// 		$scope.data.order.finished_at = Date.parse(response.order.finished_at);

		// 		$scope.view = {
		// 			stateLabel: getClassByState($scope.data.order.status, $scope.data.customer.business, $scope.data.order.prio, 'label'),
		// 			stateLabelName: getStateName($scope.data.order.status)
		// 		}

		// 		$("#orderModal").modal('show');
		// 	});
		// },
		firstDay: 1,
	  	monthNames: ["Januari","Februari","Mars","April","May","Juni","Juli", "Agusti", "September", "Oktober", "Novemver", "December" ], 
	   	monthNamesShort: ['Jan','Feb','Mar','Apr','Maj','Jun','Jul','Agu','Sep','Okt','Nov','Dec'],
	   	dayNames: [ 'Söndag', 'Måndag', 'Tisdag', 'Onsdag', 'Torsdag', 'Fredag', 'Lördag'],
	   	dayNamesShort: ['Sön','Mån','Tis','Ons','Tors','Fre','Lör'],
	   	buttonText: {
		    today: 'Idag',
		    month: 'Månad',
		    week: 'Vecka',
		    day: 'Dag'
		},
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
	    timeFormat: 'H:mm',
	    weekNumbers: true

    })
}]);

app.controller('FileTiresController', ['$scope', '$http', function($scope, $http) {
	$("#customer_id").focusout(function() {
		if ($("#customer_id").val() != "") {
			$http({
				url: '/customer/get/'+$("#customer_id").val(),
				method: 'GET'
			}).success(function(customer) {
				$("#customer_name").val(customer.name);
			});
		}
	});
}]);