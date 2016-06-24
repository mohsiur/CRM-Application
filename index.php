<!DOCTYPE html>
<html>
<!-- custom CSS -->
<style>
.width-30-pct {width: 30%;}
.text-align-center {text-align: center;}
.margin-bottom-1em {margin-bottom: 1em;}
</style>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- include material design CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css" />
    <!-- include material design icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
</head>

<body ng-app="crmApp">
    <!-- page content and controls will be here -->
    <nav>
    	<div class="nav-wrapper">
	    	<ul id="nav-mobile" class="right">
	    		<li><a href="#/calls">Calls</a></li>
	    		<li><a href="#/contacts">Contacts</a></li>
	    		<li><a href="#/oppurtunity">Opportunity</a></li>
	    	</ul>
	    </div>
    </nav>

    <div class="container">
    	<div ng-view></div>
    </div>

    <!-- include jquery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <!-- material design js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
    <!-- include angular js -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular-route.js"></script>
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/angular-materialize/0.1.8/angular-materialize.min.js"></script>
    <script src="lib/triggers.js"></script>
    <script src="lib/app.js"></script>
</body>

</html>
