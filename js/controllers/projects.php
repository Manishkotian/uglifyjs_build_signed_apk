<?php
    include_once 'plugins.php';
    include_once 'sidebar.php';
?>
<!DOCTYPE html>
    <head>
        <title>app_name | Projects</title>
        <?php echo loadPlugins()?>
    </head>
    <body ng-app="viviktaConsole" class="ng-cloak" ng-controller="ProjectController" ng-init="listAllConfiguredApplication(0,'')">
        <header id="header" class="ng-cloak">
            <ul class="header-inner ng-cloak">
                <li id="menu-trigger" data-trigger="#sidebar">
                    <div class="line-wrap">
                        <div class="line top"></div>
                        <div class="line center"></div>
                        <div class="line bottom"></div>
                    </div>
                </li>
                <li class="logo hidden-xs">
                    <a href="projects.php">Projects</a>
                </li>
            </ul>
            <div id="top-search-wrap">
                <input type="text">
                <i id="top-search-close">&times;</i>
            </div>
        </header>
        <section id="main" class="ng-cloak">
            <aside id="sidebar" class="ng-cloak">
                <?php echo loadSidebar()?>
            </aside>        
            <section id="content" class="ng-cloak">
                <div class="container ng-cloak">
                    <div class="block-header">
                        <h2>Projects</h2>
                        <ul class="actions" style="margin-right: 5%">
                            <li>
                                <a href="">
                                    <button class="btn btn-info btn-icon-text waves-effect" ng-click="toggleProjectForm()"><i class="fa fa-plus"></i> Add Apps</button>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="dash-widgets ng-cloak" id="closeProject">
                        <div class="row ng-cloak">
                            <div class="col-md-3 col-sm-6 ng-cloak" ng-repeat="application in applications">
                                <div class="card">
                                    <div class="card-header bgm-bluegray">
                                        <h2>{{application.appName}}</h2>
                                        <ul class="actions">
                                            <li class="dropdown" >
                                                <a href="" data-toggle="dropdown">
                                                    <i class="zmdi zmdi-more-vert"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li>
                                                        <a href="" ng-click="openSettings(application.appId)">Settings</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <a class="project-description" href="build.php?appId={{application.appId}}">
                                        <div class="card-body card-padding">
                                            {{application.appDescription}} 
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card ng-cloak" id="project" style="display: none">
                        <div class="card-header">
                            <h2>Configure Applications</h2>
                        </div>
                        <div class="card-body card-padding">
                            <form name = "addConfigurationForm">
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">App Name:</label>
                                    <input type="text" class="form-control" id="recipient-name1" ng-model="configuration.appName" required>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Description:</label>
                                    <textarea class="form-control" id="message-text1" ng-model="configuration.appDescription" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Gitlab Link:</label>
                                    <textarea class="form-control" id="message-text1" ng-model="configuration.gitlabLink" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Gitlab User Name:</label>
                                    <input type="text" class="form-control" id="recipient-name1" ng-model="configuration.gitlabUsername" required>
                                </div>
                                <button class="btn btn-default waves-effect" ng-click="toggleProjectForm()">Close</button>
                                <button class="btn btn-primary waves-effect" ng-click="configureApplications(configuration)" ng-disabled="addConfigurationForm.$invalid">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </section>
        <div class="modal fade" id="settingsModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="settingsModalLabel">Update</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form name = "editConfigurationForm">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">App Name:</label>
                                <input type="text" class="form-control" id="recipient-name1" ng-model="editConfiguration.appName" required>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Description:</label>
                                <textarea class="form-control" id="message-text1" ng-model="editConfiguration.appDescription" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Gitlab Link:</label>
                                <textarea class="form-control" id="message-text1" ng-model="editConfiguration.gitlabLink" required></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" ng-click="updateConfiguration(editConfiguration)">Update</button>
                    </div>
                </div>
            </div>
        </div>
        <footer id="footer" ng-controller="TimerController" class="ng-cloak">
            <?php echo loadFooter()?>
            <div id="timer">
            </div>
        </footer>
        <?php echo loadAfterScripts() ?>
    </body>
  </html>
