var app = angular.module('app_name',['cgBusy'])
.value('cgBusyDefaults',{
	message:'Loading...',
  	backdrop: false,
  	delay: 300,
  	minDuration: 700,
  	wrapperClass: 'my-class my-class2'
})
.run(function(){
	var configuration = new Configuration();
});
var configuration = new Configuration();
app
.service('TokenVerifierService', ['$http', function ($http) {
    this.verifyToken = function(errorCode,statusText,statusData){
        /*if(errorCode == configuration.TOKEN_EXPIRED_CODE && statusText == configuration.FAILURE_STATUS_TEXT && statusData == configuration.TOKEN_EXPIRED_TEXT){
          swal({   
              title: "Your Token Expired",   
              text: "Please Login to Continue!",   
              type: "warning",   
              showCancelButton: true,   
              confirmButtonColor: "#DD6B55",   
              confirmButtonText: "Login And Continue",   
              cancelButtonText: "Close",   
              closeOnConfirm: false,   
              closeOnCancel: false 
          }, function(isConfirm){   
              if (isConfirm) {     
                  window.location.reload();  
              } else {     
                  window.location.reload();     
              } 
          });
        }
        else if(errorCode == configuration.TOKEN_ABSENT_CODE && statusText == configuration.FAILURE_STATUS_TEXT && statusData == configuration.TOKEN_ABSENT_TEXT){
        	window.location.href = "login.php";
        }
        else if(errorCode == configuration.INVALID_TOKEN_CODE && statusText == configuration.FAILURE_STATUS_TEXT && statusData == configuration.INVALID_TOKEN_TEXT){
        	window.location.href = "login.php";
        }
        else{
          //no data found case
        }  */
    }
}])
