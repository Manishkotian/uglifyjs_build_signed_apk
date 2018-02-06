app
.controller('ProjectController',function($scope,$http,TokenVerifierService){
	$scope.authToken = localStorage.getItem("app_name_token");
	var configuration = new Configuration();

	$scope.isProjectFormOpened = false;
	$scope.toggleProjectForm = function(){
		if($scope.isProjectFormOpened == false){
			$("#project").slideDown("slow");
			$("#closeProject").slideUp("slow");
			$scope.isProjectFormOpened = true;
		}
		else{
			$("#closeProject").slideDown("slow");
			$("#project").slideUp("slow");
			$scope.isProjectFormOpened = false;
		}
	};	

	$scope.listAllConfiguredApplication =function(){
		$scope.ajaxPromise = $http({
			method : "GET",
			url : configuration.BASE_URL+configuration.LIST_CONFIGURATIONS_URL,
			params : {
				token : $scope.authToken,
				filterType : 1
			}
		}).then(function success(response){
			writeLogsToFile('info','ExecutionController-->'+JSON.stringify(response),2);
			if(response.status == configuration.HTTP_STATUS_CODE){
				if(response.data.errorCode == configuration.LIST_CONFIGURATIONS_SUCCESS_CODE && response.data.statusText == configuration.SUCCESS_STATUS_TEXT){
					$scope.applications = response.data.data;
				}
				else{
					TokenVerifierService.verifyToken(response.data.errorCode,response.data.statusText,response.data.data);
				}
			}
			else{
				console.log("no data found");
			}
		},function failure(){
			console.log("no data found");
		});
	}

	$scope.configureApplications = function(configurationData){
		$scope.ajaxPromise = $http({
			method : "POST",
			url : configuration.BASE_URL+configuration.ADD_CONFIGURATION_URL,
			params : {
				token : $scope.authToken,
				appName : configurationData.appName,
				appDescription : configurationData.appDescription,
				gitlabLink : configurationData.gitlabLink,
				gitlabUsername : configurationData.gitlabUsername
			}
		}).then(function success(response){
			writeLogsToFile('info','ExecutionController-->'+JSON.stringify(response),2);
			if(response.status == configuration.HTTP_STATUS_CODE){
				if(response.data.errorCode == configuration.ADD_CONFIGURATION_SUCCESS_CODE && response.data.statusText == configuration.SUCCESS_STATUS_TEXT){
					notify('configuration set succssfully', 'success');
					$scope.toggleProjectForm();
					$scope.listAllConfiguredApplication();
				}
				else{
					notify('configuration Failed', 'danger');
					TokenVerifierService.verifyToken(response.data.errorCode,response.data.statusText,response.data.data);
				}
			}
			else{
				notify('configuration Failed', 'danger');
			}
		},function failure(){
			notify('configuration Failed --> Server Error', 'danger');
		});
	}

	$scope.openSettings = function(appId){
		$scope.ajaxPromise = $http({
			method : "GET",
			url : configuration.BASE_URL+configuration.LIST_CONFIGURATIONS_URL,
			params : {
				token : $scope.authToken,
			}
		}).then(function success(response){
			writeLogsToFile('info','ExecutionController-->'+JSON.stringify(response),2);
			if(response.status == configuration.HTTP_STATUS_CODE){
				if(response.data.errorCode == configuration.LIST_CONFIGURATIONS_SUCCESS_CODE && response.data.statusText == configuration.SUCCESS_STATUS_TEXT){
					$scope.applicationsData = response.data.data;
					for(i=0;i<$scope.applicationsData.length;i++){
						if($scope.applicationsData[i].appId == appId){
							$scope.editConfiguration = $scope.applicationsData[i];
							$('#settingsModal').modal('toggle');
						}
					}
				}
				else{
					TokenVerifierService.verifyToken(response.data.errorCode,response.data.statusText,response.data.data);
				}
			}
			else{
				console.log("no data found");
			}
		},function failure(){
			console.log("no data found");
		});
	}

	$scope.updateConfiguration = function(editConfigurationData){
		$scope.ajaxPromise = $http({
			method : "PUT",
			url : configuration.BASE_URL+configuration.UPDATE_CONFIGURATION_URL,
			params : {
				token : $scope.authToken,
				appId : editConfigurationData.appId,
				appName : editConfigurationData.appName,
				appDescription : editConfigurationData.appDescription,
				gitlabLink : editConfigurationData.gitlabLink
			}
		}).then(function success(response){
			writeLogsToFile('info','ExecutionController-->'+JSON.stringify(response),2);
			if(response.status == configuration.HTTP_STATUS_CODE){
				if(response.data.errorCode == configuration.UPDATE_CONFIGURATION_SUCCESS_CODE && response.data.statusText == configuration.SUCCESS_STATUS_TEXT){
					notify('configuration updated succssfully', 'success');
					$scope.listAllConfiguredApplication();
				}
				else{
					notify('configuration update Failed', 'danger');
					TokenVerifierService.verifyToken(response.data.errorCode,response.data.statusText,response.data.data);
				}
			}
			else{
				notify('configuration update Failed', 'danger');
			}
		},function failure(){
			notify('configuration update Failed --> Server Error', 'danger');
		});
	}
})
