<header>
    <!--Navbar-->
    <div class="row">
        <nav class="navbar navbar-expand-lg navbar-dark indigo container-fluid">
            <div class="container">
                <!--Sign Up Button-->
                <!-- Navbar brand -->
                <a class="navbar-brand wow shake"href="#"><h2>Canteen</h2></a>

                <!-- Collapse button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
                        aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Collapsible content -->
                <div class="collapse navbar-collapse" id="basicExampleNav">

                    <!-- Links -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Pricing.php">Pricing</a>
                        </li>

                        <!-- Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">Panels</a>
                            <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="Login.php">User Panel</a>
                            </div>
                        </li>
                    </ul>
                    <form class="form-inline" action="Search.php" target="_blank" method="get">
                        <div class="md-form my-0">
                            <input class="form-control mr-sm-2" type="text" name="Search" placeholder="Search"
                                   aria-label="Search" style="color: white">
                            <button class="btn btn-info btn-rounded z-depth-2" type="submit" name="search_btn" style="background-color: #6100FF!important"><i class="fa fa-search-plus" aria-hidden="true"></i></button>
                        </div>
                    </form>
                    <!-- Links -->
                    <a href="logout.php"><button type="button" id="logout" class="btn btn-white btn-rounded z-depth-2 wow fadeInDown" style="background-color: #6100FF!important; color: white!important;">Log Out</button></a>
                    <!--Logout Button-->
                    <a type="button" id="profile" class="btn-floating deep-purple" data-toggle="modal" data-target="#basicExampleModal"><i class="fa fa-user-circle" aria-hidden="true"></i></a>
                    &nbsp;&nbsp;
                </div>
                <!-- Collapsible content -->
            </div>
        </nav>
        <!--/.Navbar-->
    </div>
</header>
