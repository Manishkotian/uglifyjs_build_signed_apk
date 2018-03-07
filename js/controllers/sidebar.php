<?php
	function loadSidebar()
	{
		$sidebar = '<div class="sidebar-inner c-overflow" ng-controller="SidemenuController">
                    <div class="profile-menu">
                        <a href="">
                            <div class="profile-pic">
                                <img src="img/profile-pics/1.jpg" alt="">
                            </div>

                            <div class="profile-info">
                                Admin
                                <i class="zmdi zmdi-arrow-drop-down"></i>
                            </div>
                        </a>

                        <ul class="main-menu" style="display:none">
                            <li>
                                <a href="profile-about.html"><i class="zmdi zmdi-account"></i> View Profile</a>
                            </li>
                            <li>
                                <a href=""><i class="zmdi zmdi-settings"></i> Settings</a>
                            </li>
                            <li>
                                <a href=""><i class="zmdi zmdi-time-restore"></i> Logout</a>
                            </li>

                        </ul>
                    </div>

                    <ul class="main-menu">
                        <li><a href="dashboard.php"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
                        <li><a href="projects.php"><i class="zmdi zmdi-album"></i> Projects</a></li>
                        <li>
                                <a href="login.php"><i class="zmdi zmdi-time-restore"></i> Logout</a>
                        </li>
                    </ul>
                </div>';
		return $sidebar;
	}

    function loadFooter(){
        return "Copyright &copy; ";
    }

	function loadNotificationBar()
	{
		$notifications = '';
        return $notifications;
	}
?>
