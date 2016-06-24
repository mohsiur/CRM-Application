var app = angular.module('crmApp', ['ngRoute']);

app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider
        .when('/', {
            templateUrl: 'templates/home.html',
            controller: 'mainController'
        })
        .when('/calls', {
        	templateUrl: 'templates/calls.html',
        	controller: 'callsController'
        })
        .when('/contacts',{
        	templateUrl: 'templates/contacts.html',
        	controller: 'contactsController'
        });
    }]);

// Main Controller for Home Page
app.controller('mainController', function($scope){
	$scope.message = "Home Page";	
});

// Controller for calls
app.controller('callsController', function($scope, $http) {

    $scope.showCreateForm = function() {
        $scope.clearForm();
        // Change title of form
        $('#modal-item-title').text('Create New Call');

        // hide update item button
        $('#btn-update-item').hide();

        // show create item button
        $('#btn-create-item').show();

        $('#modal-item-form').openModal();
    }

    $scope.clearForm = function() {
        $scope.subject = "";
        $scope.phoneNum = "";
        $scope.description = "";
        $scope.relatedTo = "";
    }

    $scope.createItem = function() {
        $http.post('create_calls.php', {
            'subject': $scope.subject,
            'phoneNum': $scope.phoneNum,
            'description': $scope.description,
            'relatedTo': $scope.relatedTo
        }).success(function(data, status, headers, config) {
            console.log(data);
            // tell the user new product was created
            Materialize.toast(data, 4000);

            // close modal
            $('#modal-item-form').closeModal();

            // clear modal content
            $scope.clearForm();

            // refresh the list
            $scope.getAll();
        });
    }

    $scope.getAll = function(){
    	$http.get("read_calls.php").success(function(response){
    		$scope.items = response.records;
    	});
    }

    $scope.readOne = function(callsID){
    	// Change title of form
        $('#modal-item-title').text('Update Call');

        // show update item button
        $('#btn-update-item').show();

        // hide create item button
        $('#btn-create-item').hide();

        $http.post('read_one_call.php', {
        	'callsID' : callsID
        })
        .success(function(data, status, headers, config){
        	$scope.callsID = data[0]["callsID"];
        	$scope.subject = data[0]["subject"];
        	$scope.phoneNum = data[0]["phoneNum"];
        	$scope.description = data[0]["description"];
        	$scope.relatedTo = data[0]["relatedTo"];

        	$('#modal-item-form').openModal()
       	})
        .error(function(data, status, headers, config){
        	Materialize.toast('Unable to retrieve record', 4000);
        });
    }

    $scope.updateItem = function(){
    	$http.post('update_calls.php', {
    		'callsID': $scope.callsID,
    		'subject': $scope.subject,
            'phoneNum': $scope.phoneNum,
            'description': $scope.description,
            'relatedTo': $scope.relatedTo
    	})
    	.success(function(data, status, headers, config){
    		Materialize.toast(data + ' Updated', 4000);

    		$("#modal-item-form").closeModal();

    		$scope.clearForm();

    		$scope.getAll();

    	});
    }

    $scope.deleteItem = function(callsID){
    	if(confirm("Are you sure?")){
    		$http.post('delete_calls.php', {
    			'callsID' : callsID
    		})
    		.success(function(data, status, headers, config){
    			Materialize.toast(data, 4000);
    			$scope.getAll();
    		});
    	}
    }

});

//Controller for Contacts
app.controller('contactsController', function($scope, $http){

	$scope.showCreateForm = function(){
		$scope.clearForm();

		// Change title of form
        $('#modal-item-title').text('Create New Contact');

        // hide update item button
        $('#btn-update-item').hide();

        // show create item button
        $('#btn-create-item').show();

        $('#modal-item-form').openModal();
	
	}

	$scope.clearForm = function() {
        $scope.firstName = "";
        $scope.lastName = "";
        $scope.officeNum = "";
        $scope.mobileNum = "";
        $scope.faxNum = "";
        $scope.email = "";
        $scope.street = "";
        $scope.city = "";
        $scope.state = "";
        $scope.postalCode = "";
        $scope.country = "";
        $scope.description = "";
        $scope.contactSource = "";
    }

    $scope.createItem = function() {
        $http.post('create_contacts.php', {
        	'firstName' : $scope.firstName,
        	'lastName' : $scope.lastName,
        	'officeNum' : $scope.officeNum,
        	'mobileNum' : $scope.mobileNum,
        	'faxNum' : $scope.faxNum,
        	'email' : $scope.email,
        	'street' : $scope.street,
        	'city' : $scope.city,
        	'state' : $scope.state,
        	'postalCode' : $scope.postalCode,
        	'country' : $scope.country,
        	'description' : $scope.description,
        	'contactSource' : $scope.contactSource
        }).success(function(data, status, headers, config) {
            console.log(data);
            // tell the user new product was created
            Materialize.toast(data, 4000);

            // close modal
            $('#modal-item-form').closeModal();

            // clear modal content
            $scope.clearForm();

            // refresh the list
            $scope.getAll();
        });
    }

    $scope.getAll = function(){
    	$http.get("read_contacts.php").success(function(response){
    		$scope.items = response.records;
    	});
    }

    $scope.readOne = function(contactID){
    	// Change title of form
        $('#modal-item-title').text('Update Contact');

        // show update item button
        $('#btn-update-item').show();

        // hide create item button
        $('#btn-create-item').hide();

        $http.post('read_one_contact.php', {
        	'contactID' : contactID
        })
        .success(function(data, status, headers, config){
        	$scope.contactID = data[0]["contactID"];
        	$scope.firstName = data[0]["firstName"];
        	$scope.lastName = data[0]["lastName"];
        	$scope.officeNum = data[0]["officeNum"];
        	$scope.mobileNum = data[0]["mobileNum"];
        	$scope.faxNum = data[0]["faxNum"];
        	$scope.email = data[0]["email"];
        	$scope.street = data[0]["street"];
        	$scope.city = data[0]["city"];
        	$scope.state = data[0]["state"];
        	$scope.postalCode = data[0]["postalCode"];
        	$scope.country = data[0]["country"];
        	$scope.description = data[0]["description"];
        	$scope.contactSource = data[0]["contactSource"];

        	$('#modal-item-form').openModal()
       	})
        .error(function(data, status, headers, config){
        	Materialize.toast('Unable to retrieve record', 4000);
        });
    }
});