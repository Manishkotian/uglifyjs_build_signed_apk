app
.controller('LoginController',function($scope,$http){
	var configuration = new Configuration();
	writeLogsToFile('info','LoginController-->',2);
	$scope.doLogin = function(loginData){
		$scope.ajaxPromise = $http({
			method : "POST",
			url : configuration.BASE_URL+configuration.LOGIN_URL,
			params : {
				emailId : loginData.emailId,
				password : loginData.password,
				typeOfUser : 0
			}
		}).then(function success(response){
			writeLogsToFile('info','ExecutionController-->'+JSON.stringify(response),2);
			if(response.status == configuration.HTTP_STATUS_CODE){
				if(response.data.errorCode == configuration.LOGIN_SUCCESS_CODE && response.data.statusText == configuration.SUCCESS_STATUS_TEXT){
					window.location.href = 'dashboard.php'
					$scope.loginTime = new Date().getTime();
                	localStorage.setItem("app_name_loginTime",$scope.loginTime);
                	localStorage.setItem("app_name_token",response.data.data.token.token);
				}
				else{
					notify('Login Failed', 'danger');
				}
			}
			else{
				notify('Login Failed', 'danger');
			}
		},function failure(){
			notify('Login Failed --> Server Error', 'danger');
		});
	}
})
