<?php
    include_once 'plugins.php';
?>
<!DOCTYPE html>
    <head>
        <?php echo loadPlugins(); ?>
        <title>Login</title>
    </head>
    <body class="login-content" ng-app="viviktaConsole" ng-controller="LoginController">
        <div class="lc-block toggled" id="l-login">
            <img src="img/vivikta_logo.png" style="width: 70px;height: 70px;">
            <h3>app_name</h3>
            <p>Login to continue</p>
            <div class="input-group m-b-20">
                <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                <div class="fg-line">
                    <input type="emailId" class="form-control" placeholder="Username" ng-model="loginData.emailId">
                </div>
            </div>
            
            <div class="input-group m-b-20">
                <span class="input-group-addon"><i class="zmdi zmdi-lock"></i></span>
                <div class="fg-line">
                    <input type="password" class="form-control" placeholder="Password" ng-model="loginData.password">
                </div>
            </div>
            
            <div class="clearfix"></div>
            <a href="" class="btn btn-login btn-danger btn-float" ng-click="doLogin(loginData)"><i class="zmdi zmdi-arrow-forward"></i></a>
           <!--  <ul class="login-navigation">
                <li data-block="#l-forget-password" class="bgm-orange">Forgot Password?</li>
            </ul> -->
        </div>
    
        <!-- Forgot Password -->
        <!-- <div class="lc-block" id="l-forget-password">
            <p class="text-left">Please enter your registered Email-id</p>
            
            <div class="input-group m-b-20">
                <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
                <div class="fg-line">
                    <input type="text" class="form-control" placeholder="Email Address">
                </div>
            </div>
            
            <a href="" class="btn btn-login btn-danger btn-float"><i class="zmdi zmdi-arrow-forward"></i></a>
            
            <ul class="login-navigation">
                <li data-block="#l-login" class="bgm-green">Login</li>
            </ul>
        </div> -->
        <?php echo loadAfterScripts();?>
    </body>
</html>
