<!-- Top Menu Items -->
<ul class="nav navbar-right top-nav">
    <li><a href="#"> Users Online: <span class="users-online"></span> </a></li>
    <li><a href="/"> Visit Site </a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['user_firstname'] . " " . $_SESSION['user_lastname']; ?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li>
                <a href="./profile.php"><i class="fa fa-fw fa-user"></i> Profile </a>
            </li>
            <li>
                <a href="#"><i class="fa fa-fw fa-gear"></i> Settings </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="./includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out </a>
            </li>
        </ul>
    </li>
</ul>