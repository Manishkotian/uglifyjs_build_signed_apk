app
.controller('DashboardController',function($scope,$http){
	var configuration = new Configuration();
	$scope.authToken = localStorage.getItem("app_name_token");
	writeLogsToFile('info','DashboardController-->',2);
	$scope.loadDashboardData = function(){
		$scope.ajaxPromise = $http({
			method : "GET",
			url : configuration.BASE_URL+configuration.DASHBOARD_LIST_URL,
			params : {
				token : $scope.authToken,
			}
		}).then(function success(response){
			writeLogsToFile('info','DashboardController-->'+JSON.stringify(response),2);
			if(response.status == configuration.HTTP_STATUS_CODE){
				if(response.data.errorCode == configuration.DASHBOARD_LIST_SUCCESS_CODE && response.data.statusText == configuration.SUCCESS_STATUS_TEXT){
					$scope.totalAppCount = response.data.data.totalAppCount;
					$scope.totalBuildCount = response.data.data.totalBuildCount;
				}
				else{
					//notify('Login Failed', 'danger');
				}
			}
			else{
				//notify('Login Failed', 'danger');
			}
		},function failure(){
			//notify('Login Failed --> Server Error', 'danger');
		});
	}
})
