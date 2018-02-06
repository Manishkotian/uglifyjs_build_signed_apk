<?php
    include_once 'plugins.php';
    include_once 'sidebar.php';
?>
<!DOCTYPE html>
    <head>
        <title>app_name | Dashboard</title>
        <?php echo loadPlugins()?>
    </head>
    <body ng-app="viviktaConsole" class="ng-cloak" ng-controller="DashboardController" ng-init="loadDashboardData()">
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
                    <a href="dashboard.php">Dashboard</a>
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
                    <div class="block-header ng-cloak">
                        <h2>Dashboard</h2>
                        <ul class="actions">
                            <li class="dropdown">
                                <a href="" data-toggle="dropdown">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>
                                
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="">Refresh</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="dash-widgets ng-cloak">
                        <div class="row">
                            <a href="projects.php">
                                <div class="col-md-3 col-sm-6">
                                    <div id="pie-charts" class="dash-widget-item" style="min-height: 0px;">
                                        <div class="bgm-pink">
                                            <div class="text-center p-20 m-t-25">
                                                <div class="easy-pie main-pie">
                                                    <div class="percent percent-without-symbol">{{totalAppCount}}</div>
                                                    <div class="pie-title">Application Count</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="projects.php">
                                <div class="col-md-3 col-sm-6">
                                    <div id="pie-charts" class="dash-widget-item" style="min-height: 0px;">
                                        <div class="bgm-amber">
                                            <div class="text-center p-20 m-t-25">
                                                <div class="easy-pie main-pie">
                                                    <div class="percent percent-without-symbol">{{totalBuildCount}}</div>
                                                    <div class="pie-title">Total Builds</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- <div class='row ng-cloak'>
                            <div class="col-lg-12">
                                <div class="card">
                                <div class="card-header">
                                    <h2>Recent Items <small>Shows the recent build of all projects</small></h2>
                                    <ul class="actions">
                                        <li class="dropdown">
                                            <a href="" data-toggle="dropdown">
                                                <i class="zmdi zmdi-more-vert"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="">Refresh</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body m-t-0">
                                    <table class="table table-inner table-vmiddle">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th style="width: 60px">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="f-500 c-cyan">2569</td>
                                                <td>Samsung Galaxy Mega</td>
                                                <td class="f-500 c-cyan">$521</td>
                                            </tr>
                                            <tr>
                                                <td class="f-500 c-cyan">9658</td>
                                                <td>Huawei Ascend P6</td>
                                                <td class="f-500 c-cyan">$440</td>
                                            </tr>
                                            <tr>
                                                <td class="f-500 c-cyan">1101</td>
                                                <td>HTC One M8</td>
                                                <td class="f-500 c-cyan">$680</td>
                                            </tr>
                                            <tr>
                                                <td class="f-500 c-cyan">6598</td>
                                                <td>Samsung Galaxy Alpha</td>
                                                <td class="f-500 c-cyan">$870</td>
                                            </tr>
                                            <tr>
                                                <td class="f-500 c-cyan">4562</td>
                                                <td>LG G3</td>
                                                <td class="f-500 c-cyan">$690</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="recent-items-chart" class="flot-chart"></div>
                            </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </section>
        </section>
        
        <footer id="footer" ng-controller="TimerController" class="ng-cloak">
            <?php echo loadFooter()?>
            <div id="timer">
            </div>
        </footer>
        <?php echo loadAfterScripts() ?>
    </body>
  </html>
