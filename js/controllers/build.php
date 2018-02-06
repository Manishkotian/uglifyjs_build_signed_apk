<?php
    include_once 'plugins.php';
    include_once 'sidebar.php';
?>
<!DOCTYPE html>
    <head>
        <title>app_name | Build</title>
        <?php echo loadPlugins()?>
    </head>
    <body ng-app="app_name" ng-controller ="ExecutionController" ng-init="listAllExecutionHistory(0,'')">
        <input type="hidden" id="appId" ng-model="appId" value="<?php echo $_GET['appId'] ?>">
        <header id="header" class="ng-cloak">
            <ul class="header-inner ng-cloak">
                <li id="menu-trigger" data-trigger="#sidebar" class="ng-cloak">
                    <div class="line-wrap">
                        <div class="line top"></div>
                        <div class="line center"></div>
                        <div class="line bottom"></div>
                    </div>
                </li>
                <li class="logo hidden-xs">
                    <a href="vLearn.php">Build</a>
                </li>
            </ul>
            <div id="top-search-wrap">
                <input type="text">
                <i id="top-search-close">&times;</i>
            </div>
        </header>
        <section id="main" class="ng-cloak" ng-init="listSpecificConfiguredApplication()">
            <aside id="sidebar" class="ng-cloak">
                <?php echo loadSidebar()?>
            </aside>        
            <section id="content" class="ng-cloak">
                <div class="container ng-cloak">
                    <div class="block-header ng-cloak">
                        <h2 style="text-transform: uppercase;">{{execution.appName}} Build</h2>
                        <ul class="actions" style="margin-right: 5%">
                            <li>
                                <a href="">
                                    <button class="btn btn-info btn-icon-text waves-effect" ng-click="toggleExecuteForm()" ng-if="isExecutionFormOpened == false"><i class="zmdi zmdi-directions"></i> Build </button>
                                    <button class="btn btn-default btn-icon-text waves-effect" ng-click="toggleExecuteForm()" ng-if="isExecutionFormOpened == true"><i class="zmdi zmdi-close-circle-o"></i> Close</button>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card ng-cloak" id="closeExecution">
                        <div class="card-header" ng-if="historyPresent == true">
                            <h2 style="text-transform: uppercase;">{{execution.appName}} Build History</h2>
                        </div>
                        <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;" ng-if="historyPresent == true">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Application Name</th>
                                        <th>Version Number</th>
                                        <th>Apk Path</th>
                                        <th>LogFile Path</th>
                                        <th>Build Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat = "execution in executions">
                                        <td>{{$index+1}}</td>
                                        <td>{{execution.appName}}</td>
                                        <td>{{execution.versionNumber}}</td>
                                        <td><a href="{{execution.apkPath}}">{{execution.apkPath}}</a></td>
                                        <td><a href="{{execution.logFilePath}}">{{execution.logFilePath}}</a></td>
                                        <td ng-if="execution.buildStatus == 0" style="color: blue">Pending</td>
                                        <td ng-if="execution.buildStatus == 1" style="color: green">Success</td>
                                        <td ng-if="execution.buildStatus == 2" style="color: red">Failure</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card" ng-if="historyPresent == false">
                            <div class="card-header ch-alt text-center">
                                <i class="zmdi zmdi-book-image fa-4x"></i>
                            </div>
                            <div class="card-body card-padding text-center">
                                <h2>No Build History Present</h2>
                                <p>Please Build to see the history.</p>
                            </div>
                        </div>
                        <div class="text-center ng-cloak" ng-show="showPagination">
                            <br/>
                            <div class="btn-group">
                                <button ng-disabled="currentPage == 1" class="btn btn-white" max-size="maxSize" boundary-links="true" ng-click="listAllExecutionHistory(1,previousPageUrl)"><i class="fa fa-chevron-left"></i></button>
                                <button class="btn btn-primary ng-cloak" max-size="maxSize" boundary-links="true">{{currentPage}}/{{lastPage}}</button>
                                <button ng-disabled="currentPage == lastPage" class="btn btn-white" max-size="maxSize" boundary-links="true" ng-click="listAllExecutionHistory(1,nextPageUrl)"><i class="fa fa-chevron-right"></i></button>
                            </div>
                        </div>
                        <div class="text-center ng-cloak" ng-show="showPagination">
                            <br/>
                        </div>
                    </div>
                    <div class="card ng-cloak" id="execution" style="display: none">
                        <div class="card-header">
                            <h2 style="text-transform: uppercase;">Build {{execution.appName}}</h2>
                        </div>
                        <div class="card-body card-padding">
                            <form name = "executionForm">
                                <p class="c-black f-500 m-b-20">Version Increment Type</p>
                                <label class="radio radio-inline m-r-20">
                                    <input type="radio" name="inlineRadioOptions" value="0" ng-model="execution.incrementType" required>
                                    <i class="input-helper"></i>  
                                    Automatic Incremation
                                </label>
                                <label class="radio radio-inline m-r-20">
                                    <input type="radio" name="inlineRadioOptions" value="1" ng-model="execution.incrementType" required>
                                    <i class="input-helper"></i>  
                                    Provide Version Number
                                </label>
                                <div class="form-group" ng-if="execution.incrementType == 1">
                                    <br/>
                                    <br/>
                                    <div class="fg-line">
                                        <p class="c-black f-500 m-b-20">Version Number</p>
                                        <input type="text" class="form-control" placeholder="Version" ng-model="execution.versionNumber" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <br/>
                                    <div class="fg-line">
                                        <p class="c-black f-500 m-b-20">Application Name</p>
                                        <input type="text" class="form-control" placeholder="App Name" ng-model="execution.appName" disabled required style="color: black">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <br/>
                                    <div class="fg-line">
                                        <p class="c-black f-500 m-b-20">GitLab Link</p>
                                        <input type="text" class="form-control" placeholder="App Name" ng-model="execution.gitlabLink" disabled required style="color: black">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <br/>
                                    <div class="fg-line">
                                        <p class="c-black f-500 m-b-20">GitLab Username</p>
                                        <input type="text" class="form-control" placeholder="App Name" ng-model="execution.gitlabUsername" disabled required style="color: black">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <br/>
                                    <div class="fg-line">
                                        <p class="c-black f-500 m-b-20">Gitlab Password</p>
                                        <input type="text" class="form-control" placeholder="Password" ng-model="execution.gitlabPassword" required disabled style="color: black">
                                    </div>
                                </div>
                                <button class="btn btn-default waves-effect" ng-click="toggleExecuteForm()">Close</button>
                                <button class="btn btn-primary waves-effect" ng-click="executeShellScript(execution,1)" ng-disabled="executionForm.$invalid">Execute</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </section>
        
        <footer id="footer" class="ng-cloak" ng-controller="TimerController">
            <?php echo loadFooter()?>
            <div id="timer">
            </div>
        </footer>
        <?php echo loadAfterScripts() ?>
    </body>
  </html>
