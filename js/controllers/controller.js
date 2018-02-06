app
.controller('TimerController',function($scope,$http,TokenVerifierService){
	var configuration = new Configuration();
	/*if(localStorage.getItem("viviktaConsole_loginTime")){
		var interval = setInterval(function() {
			if(localStorage.getItem("viviktaConsole_loginTime")){
			    var loginTime = parseInt(localStorage.getItem("viviktaConsole_loginTime"));
			    var currentTime = new Date().getTime();
			    var timeDifference = currentTime - loginTime;
			    var timeOut = 3600000 - timeDifference;
			    if(timeOut>=1){
				    var seconds = timeOut / 1000;
				    // 2- Extract hours:
				    var hours = parseInt( seconds / 3600 ); // 3,600 seconds in 1 hour
				    seconds = seconds % 3600; // seconds remaining after extracting hours
				    // 3- Extract minutes:
				    var minutes = parseInt( seconds / 60 ); // 60 seconds in 1 minute
				    // 4- Keep only seconds not extracted to minutes:
				    seconds = parseInt(seconds % 60);
				    if(document.getElementById("timer")){
				    	document.getElementById("timer").innerHTML = "Your session will get Expired in <span id='spanCustom' style='color:#3c8dbc !important'> " + minutes+ "min " + seconds + "sec</span>";
				    	document.getElementById("timer").style.color = "black";
				    	document.getElementById("timer").style.fontWeight = "bold"
				    	if(minutes<10){
				    		document.getElementById("spanCustom").style.color = "red";
				    	}
				    }
				}
				else{
					TokenVerifierService.verifyToken(configuration.TOKEN_EXPIRED_CODE,configuration.FAILURE_STATUS_TEXT,configuration.TOKEN_EXPIRED_TEXT);
		            localStorage.removeItem("viviktaConsole_loginTime");
		            clearInterval(interval);
				}
			}
		}, 1000);

	    var updateTimer = setInterval(function() {
	      $http({
	            method : "PUT",
	            url : configuration.BASE_URL+configuration.UPDATE_LOGIN_STATUS_URL,
	            params : {
	                token : localStorage.getItem("viviktaConsole_token"),
	            }
	        }).then(function success(response){
	            if(!response){
	            	//status update failed
	            }
	            else{
	                if(response.status == configuration.HTTP_SUCCESS_CODE){
	                    if(response.data == "" || response.data == null){
	                        //status update failed
	                    }
	                    else{
	                        if(response.data.errorCode == configuration.UPDATE_LOGIN_STATUS_SUCCESS_CODE && response.data.statusText == SUCCESS_STATUS_TEXT && response.data.data != ''){
	                            //status update successfull
	                        }
	                        else{
	                            //status update failed
	                            TokenVerifierService.verifyToken(response.data.errorCode,response.data.statusText,response.data.data);
	                        }
	                    }
	                }
	                else{
	                    //status update failed
	                }
	            }
	        },function failure(){
	            //status update failed
	        });
	    }, 60000);
	}*/
})

