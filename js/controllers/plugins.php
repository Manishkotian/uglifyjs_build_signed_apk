<?php
	function loadPlugins()
	{
		$plugins = '<meta charset="utf-8">
        			<meta http-equiv="X-UA-Compatible" content="IE=edge">
        			<meta name="viewport" content="width=device-width, initial-scale=1">
    				<link href="vendors/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
        			<link href="vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
        			<link href="vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css" rel="stylesheet">
        			<link href="vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
        			<link href="font-awesome/css/font-awesome.css" rel="stylesheet">
        			<link href="css/app.min.1.css" rel="stylesheet">
        			<link href="css/app.min.2.css" rel="stylesheet">
        			<link href="css/custom-style.css" rel="stylesheet">
   					<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
   					<script type="text/javascript" src="js/demo.js"></script>
        			<script src="bower_components/angular-busy/angular-busy.js"></script>';
		return $plugins;
	}

	function loadAfterScripts()
	{
		$scripts = '<script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>
			        <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
			        <script src="vendors/bower_components/flot/jquery.flot.js"></script>
			        <script src="vendors/bower_components/flot/jquery.flot.resize.js"></script>
			        <script src="vendors/bower_components/flot.curvedlines/curvedLines.js"></script>
			        <script src="vendors/sparklines/jquery.sparkline.min.js"></script>
			        <script src="vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
			        <script src="vendors/bower_components/moment/min/moment.min.js"></script>
			        <script src="vendors/bower_components/fullcalendar/dist/fullcalendar.min.js "></script>
			        <script src="vendors/bower_components/jquery.nicescroll/jquery.nicescroll.min.js"></script>
			        <script src="vendors/bower_components/Waves/dist/waves.min.js"></script>
			        <script src="vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
			        <script src="vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>
			        <script src="js/flot-charts/curved-line-chart.js"></script>
			        <script src="js/flot-charts/line-chart.js"></script>
			        <script src="js/charts.js"></script>
			        <script src="js/charts.js"></script>
			        <script src="js/functions.js"></script>
			        <script src="js/controllers/config.js"></script>
			        <script src="js/controllers/app.js"></script>
			        <script src="js/controllers/logs/writeLogs.js"></script>
        			<script src="js/controllers/sidemenuController.js"></script>
        			<script src="js/controllers/loginController.js"></script>
        			<script src="js/controllers/dashboardController.js"></script>
        			<script src="js/controllers/controller.js"></script>
        			<script src="js/controllers/projectsController.js"></script>
        			<script src="js/controllers/executionController.js"></script>';
		return $scripts;
	}
?>