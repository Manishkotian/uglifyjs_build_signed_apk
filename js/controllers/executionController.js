app
.controller('ExecutionController',function($scope,$http,TokenVerifierService){
	$scope.authToken = localStorage.getItem("app_name_token");
	var configuration = new Configuration();
	$scope.isExecutionFormOpened = false;
	$scope.execution = {};
	$scope.toggleExecuteForm = function(){
		if($scope.isExecutionFormOpened == false){
			$("#execution").slideDown("slow");
			$("#closeExecution").slideUp("slow");
			$scope.isExecutionFormOpened = true;
			$scope.execution.gitlabPassword = "viviktaTech2";
		}
		else{
			$("#closeExecution").slideDown("slow");
			$("#execution").slideUp("slow");
			$scope.isExecutionFormOpened = false;
		}
	};	

	$scope.executeShellScript = function(executionInfo,appType){	
		$scope.ajaxPromise = $http({
			method : "POST",
			url : configuration.BASE_URL+configuration.EXECUTE_SCRIPT_URL,
			params : {
				token : $scope.authToken,
				appId : executionInfo.appId,
				incrementType : executionInfo.incrementType,
				versionNumber : executionInfo.versionNumber,
				gitlabLink : executionInfo.gitlabLink,
				gitlabUsername : executionInfo.gitlabUsername,
				gitlabPassword : executionInfo.gitlabPassword
			}
		}).then(function success(response){
			writeLogsToFile('info','ExecutionController-->'+JSON.stringify(response),2);
			if(response.status == configuration.HTTP_STATUS_CODE){
				if(response.data.errorCode == configuration.EXECUTE_SCRIPT_SUCCESS_CODE && response.data.statusText == configuration.SUCCESS_STATUS_TEXT){
					notify('Build is in progress! Please wait', 'success');
					//window.location.reload();
					$scope.toggleExecuteForm();
					$scope.listAllExecutionHistory(0,'');
				}
				else if(response.data.errorCode == configuration.EXECUTE_SCRIPT_FAILURE_CODE && response.data.statusText == configuration.FAILURE_STATUS_TEXT){
					notify('Build Failed-Version Number Already Exists', 'danger');
				}
				else if(response.data.errorCode == configuration.EXECUTE_SCRIPT_RUNNING_A_BUILD_FAILURE_CODE && response.data.statusText == configuration.FAILURE_STATUS_TEXT){
					notify('Build Failed-Another build is in progress please wait!', 'danger');
				}
				else{
					notify('Build Failed', 'danger');
					TokenVerifierService.verifyToken(response.data.errorCode,response.data.statusText,response.data.data);
				}
			}
			else{
				notify('Build Failed', 'danger');
			}
		},function failure(){
			notify('Build Failed --> Server Error', 'danger');
		});
	}

	$scope.listAllConfiguredApplication =function(paginateFlag,url){
		if(paginateFlag == 0){
            $scope.configurationListUrl = configuration.BASE_URL+configuration.LIST_CONFIGURATIONS_URL;
        }
        else{
            $scope.configurationListUrl = url;
        }
		$scope.ajaxPromise = $http({
			method : "GET",
			url : $scope.configurationListUrl,
			params : {
				token : $scope.authToken,
				filterType : 0			
			}
		}).then(function success(response){
			writeLogsToFile('info','ExecutionController-->'+JSON.stringify(response),2);
			if(response.status == configuration.HTTP_STATUS_CODE){
				if(response.data.errorCode == configuration.LIST_CONFIGURATIONS_SUCCESS_CODE && response.data.statusText == configuration.SUCCESS_STATUS_TEXT && response.data.data.data != '' && response.data.data.data != null && typeof(response.data.data.data) !== undefined){
					$scope.lastPage = response.data.data.lastPage;
		            $scope.showPagination = true;
		            if($scope.lastPage == "NULL"){
		                $scope.showPagination = false;
		                $scope.applications = response.data.data.data;
		            }
		            else{
		                $scope.applications = response.data.data.data;
		            }
		            $scope.previousPageUrl = response.data.data.previousPageUrl;
		            $scope.nextPageUrl = response.data.data.nextPageUrl;
		            $scope.currentPage = response.data.data.currentPage;
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

	$scope.listSpecificConfiguredApplication =function(){
		$scope.appId = document.getElementById("appId").value;
		$scope.ajaxPromise = $http({
			method : "GET",
			url : configuration.BASE_URL+configuration.LIST_CONFIGURATIONS_URL,
			params : {
				token : $scope.authToken,
				filterType : 2,
				appId : $scope.appId			
			}
		}).then(function success(response){
			writeLogsToFile('info','ExecutionController-->'+JSON.stringify(response),2);
			if(response.status == configuration.HTTP_STATUS_CODE){
				if(response.data.errorCode == configuration.LIST_CONFIGURATIONS_SUCCESS_CODE && response.data.statusText == configuration.SUCCESS_STATUS_TEXT){
		            $scope.execution = response.data.data;
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

	$scope.listAllExecutionHistory = function(paginateFlag,url){
		$scope.appId = document.getElementById("appId").value;
		if(paginateFlag == 0){
            $scope.executionListUrl = configuration.BASE_URL+configuration.GET_EXECUTION_HISTORY_URL
        }
        else{
            $scope.executionListUrl = url;
        }
		$scope.ajaxPromise = $http({
			method : "GET",
			url : $scope.executionListUrl,
			params : {
				token : $scope.authToken,
				appId : $scope.appId
			}
		}).then(function success(response){
			writeLogsToFile('info','ExecutionController-->'+JSON.stringify(response),2);
			if(response.status == configuration.HTTP_STATUS_CODE){
				if(response.data.errorCode == configuration.GET_EXECUTION_HISTORY_SUCCESS_CODE && response.data.statusText == configuration.SUCCESS_STATUS_TEXT && response.data.data.data != '' && response.data.data.data != null && typeof(response.data.data.data) !== undefined){
					$scope.lastPage = response.data.data.lastPage;
		            $scope.showPagination = true;
		            if($scope.lastPage == "NULL"){
		                $scope.showPagination = false;
		                $scope.executions = response.data.data.data;
		            }
		            else{
		                $scope.executions = response.data.data.data;
		            }
		            $scope.previousPageUrl = response.data.data.previousPageUrl;
		            $scope.nextPageUrl = response.data.data.nextPageUrl;
		            $scope.currentPage = response.data.data.currentPage;
		            $scope.historyPresent = true;
				}
				else{
					$scope.historyPresent = false;
					TokenVerifierService.verifyToken(response.data.errorCode,response.data.statusText,response.data.data);
				}
			}
			else{
				$scope.historyPresent = false;
			}
		},function failure(){
			$scope.historyPresent = false;
		});
	}

	setInterval(function() {
	    $scope.listAllExecutionHistory(0,'');  
	}, 15000);
})
