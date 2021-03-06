<?php
    session_start();
    $message="";
    $username="";
    if(isset($_POST['signin'])) {
        $connection = pg_connect("host=localhost port=5432 dbname=GCaaS user=postgres password=1234");
        if (!$connection) {
            print("Connection Failed.");
            exit;
        }
        if(empty($_POST['lg_username'])|| empty($_POST['lg_password'])){
            $message = "Invalid Username or Password!";
        }
        else {
            // $myresult = pg_exec($connection, "SELECT * FROM table_user, table_role WHERE table_user.\"roleUserID\" = table_role.\"roleID\" AND table_user.\"user_Username\" = '" . $_POST["lg_username"] . "' AND table_user.\"user_Password\" = md5('" . $_POST["lg_password"]."')");
            $myresult = pg_exec($connection, "SELECT * FROM table_user WHERE \"user_Username\" = '" . $_POST["lg_username"] . "' AND \"user_Password\" = md5('" . $_POST["lg_password"]."')");
            $field_count = pg_numfields($myresult);
            $rows = pg_numrows($myresult);
            if ($rows != 0) {
                for ($i=0; $i < $rows; $i++) {
                  // traverse each field
                    for ($j=0; $j < $field_count; $j++) {
                        $field = pg_fieldname($myresult,$j);
                        if ($j==1) {
                            $_SESSION["username"] = pg_result($myresult,$i,$j);
                            $username = pg_result($myresult,$i,$j);
                        }
                        else if ($j==0) {
                            $_SESSION["userID"] = pg_result($myresult,$i,$j);;
                        }
                    }   
                }
            }
            else {
                $message = "Invalid Username or Password!";
            }

            if(isset($_SESSION['username'])) {
                if (!strcmp($role,"Super Admin")) {
                    # code...
                    header("Location: http://localhost/GitHub/GCaaS/manageYourself.php");
                } else {
                    # code...
                    header("Location: http://localhost/GitHub/GCaaS/index.php");
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8"> <!-- For display webpage is correct -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Protect IE display error -->
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- In case of different screen will be display suitable -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GCaaS - HOME</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/grayscale.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <i class="fa fa-play-circle"></i> GCaaS
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#download">Features</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                    <li>
                        <?php
                            if($_SESSION["username"]) {
                        ?>

                            <button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#modal-logout" style="font-size:14px;"> <?php echo $_SESSION["username"] ?> </button><br>
                        <?php
                            }
                            else {
                        ?>
                            <button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#login" style="font-size:14px;">Log in</button><br>
                        <?php
                            }
                        ?>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">GCaaS</h1>
                        <p class="intro-text">GIS with Crowdsourcing as a Service.<br>Created by Start Bootstrap.</p>
                        <a class="btn btn-default btn-lg" href="creatDeploy.php">Create Deployment</a><br>
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>About Grayscale</h2>
                <p>Grayscale is a free Bootstrap 3 theme created by Start Bootstrap. It can be yours right now, simply download the template on <a href="http://startbootstrap.com/template-overviews/grayscale/">the preview page</a>. The theme is open source, and you can use it for any purpose, personal or commercial.</p>
                <p>This theme features stock photos by <a href="http://gratisography.com/">Gratisography</a> along with a custom Google Maps skin courtesy of <a href="http://snazzymaps.com/">Snazzy Maps</a>.</p>
                <p>Grayscale includes full HTML, CSS, and custom JavaScript files along with LESS files for easy customization.</p><br>
                <a href="#download" class="btn btn-circle page-scroll">
                    <i class="fa fa-angle-double-down animated"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Download Section -->
    <section id="download" class="content-section text-center">
        <div class="download-section">
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>Download Grayscale</h2>
                    <p>You can download Grayscale for free on the preview page at Start Bootstrap.</p>
                    <a href="http://startbootstrap.com/template-overviews/grayscale/" class="btn btn-default btn-lg">Visit Download Page</a><br>
                    <a href="#contact" class="btn btn-circle page-scroll">
                        <i class="fa fa-angle-double-down animated"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Contact Start Bootstrap</h2>
                <p>Feel free to email us to provide some feedback on our templates, give us suggestions for new templates and themes, or to just say hello!</p>
                <p><a href="mailto:feedback@startbootstrap.com">feedback@startbootstrap.com</a>
                </p>
                <ul class="list-inline banner-social-buttons">
                    <li>
                        <a href="https://twitter.com/SBootstrap" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                    </li>
                    <li>
                        <a href="https://github.com/IronSummitMedia/startbootstrap" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                    </li>
                    <li>
                        <a href="https://plus.google.com/+Startbootstrap/posts" class="btn btn-default btn-lg"><i class="fa fa-google-plus fa-fw"></i> <span class="network-name">Google+</span></a>
                    </li>
                </ul><br>
                <a href="#page-top" class="btn btn-circle page-scroll">
                    <i class="fa fa-angle-double-up animated"></i>
                </a>
            </div>
            </div>
        </div>
    </section>

    <!-- Modal Login form-->
    <div class="modal fade" id="login" tabindex="-1" data-focus-on="input:first" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="text-center" style="padding:50px 30px 50px 30px;color: #333333">
                    <div class="modal-header">
                        <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h1>Log in</h1>
                    </div>
                    <!-- Main Form -->
                    <div class="modal-body login-form-1">
                        
                        <form name="frmUser" id="login-form" class="text-left" method="post" >
                            <div class="login-form-main-message"></div>
                            <div class="main-login-form">
                                <div class="login-group">
                                    <div class="form-group">
                                        <label for="lg_username" class="sr-only">Username</label>
                                        <input type="text" class="form-control" id="lg_username" name="lg_username" placeholder="username" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="lg_password" class="sr-only">Password</label>
                                        <input type="password" class="form-control" id="lg_password" name="lg_password" placeholder="password" required>
                                    </div>
                                    <!--<div class="form-group login-group-checkbox">-->
                                        <!--<input type="checkbox" id="lg_remember" name="lg_remember">-->
                                        <!--<label for="lg_remember">remember</label>-->
                                    <!--</div>-->
                                </div>

                                <span id="errorNoti"><?php echo $message; ?></span>
                                <input type="submit" class="btn btn-default btn-block" value="Submit" name="signin">
                                <!-- <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button> -->
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a data-toggle="modal" href="#forgot"><br>forgot your password?</a>
                        <a data-toggle="modal" href="#register"><br>create new account.</a>
                    </div>
                    <!-- end:Main Form -->
                </div>
            </div>
        </div>
    </div>

    <!--Modal Forgot form-->
    <div class="modal fade" id="forgot" tabindex="-1" data-focus-on="input:first" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="text-center" style="padding:50px 30px 50px 30px;color: #333333">
                    <!-- FORGOT PASSWORD FORM -->
                    <div class="text-center">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h1>forgot password</h1>
                        </div>
                        <!-- Main Form -->
                        <div class="modal-body login-form-1">
                            <form id="forgot-password-form" class="text-left">
                                <div class="etc-login-form">
                                    <p>When you fill in your registered email address, you will be sent instructions on how to reset your password.</p>
                                </div>
                                <div class="login-form-main-message"></div>
                                <div class="main-login-form">
                                    <div class="login-group">
                                        <div class="form-group">
                                            <label for="fp_email" class="sr-only">Email address</label>
                                            <input type="text" class="form-control" id="fp_email" name="fp_email" placeholder="email address">
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-default btn-block" value="Submit">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <!--<p>already have an account? <a href="#">login here</a></p>-->
                            <a data-toggle="modal" href="#register">create new account.</a>
                        </div>
                        <!-- end:Main Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Register form-->
    <div class="modal fade" id="register" tabindex="-1" data-focus-on="input:first" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="text-center" style="padding:50px 30px 50px 30px;color: #333333">
                    <!--REGISTRATION FORM -->
                    <div class="text-center">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h1>register</h1>
                        </div>
                        <!-- Main Form -->
                        <div class="modal-body login-form-1">
                            <form id="register-form" class="text-left">
                                <div class="login-form-main-message"></div>
                                <div class="main-login-form">
                                    <div class="login-group">
                                        <div class="form-group">
                                            <label for="reg_username" class="sr-only">Email address</label>
                                            <input type="text" class="form-control" id="reg_username" name="reg_username" placeholder="username">
                                        </div>
                                        <div class="form-group">
                                            <label for="reg_password" class="sr-only">Password</label>
                                            <input type="password" class="form-control" id="reg_password" name="reg_password" placeholder="password">
                                        </div>
                                        <div class="form-group">
                                            <label for="reg_password_confirm" class="sr-only">Password Confirm</label>
                                            <input type="password" class="form-control" id="reg_password_confirm" name="reg_password_confirm" placeholder="confirm password">
                                        </div>

                                        <div class="form-group">
                                            <label for="reg_firstname" class="sr-only">First Name</label>
                                            <input type="text" class="form-control" id="reg_firstname" name="reg_firstname" placeholder="first name">
                                        </div>
                                        <div class="form-group">
                                            <label for="reg_lastname" class="sr-only">Last Name</label>
                                            <input type="text" class="form-control" id="reg_lastname" name="reg_lastname" placeholder="last name">
                                        </div>
                                        <div class="form-group">
                                            <label for="reg_email" class="sr-only">Email</label>
                                            <input type="text" class="form-control" id="reg_email" name="reg_email" placeholder="e-mail">
                                        </div>
                                        <div class="form-group">
                                            <label for="reg_tel" class="sr-only">Email</label>
                                            <input type="text" class="form-control" id="reg_tel" name="reg_tel" placeholder="tel.">
                                        </div>
                                        <div class="form-group login-group-checkbox">
                                            <input type="checkbox" class="" id="reg_agree" name="reg_agree" disabled>
                                            <label for="reg_agree">i agree with <a href="#">terms</a></label>
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-default btn-block" value="Submit">
                                </div>
                            </form>
                        </div>
                        <!--<div class="modal-footer">-->
                            <!--<a data-toggle="modal" href="#login">already have an account? login here</a>-->
                        <!--</div>-->
                        <!-- end:Main Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <!--<footer>-->
        <!--<div class="container text-center">-->
            <!--<p>Copyright &copy; Your Website 2014</p>-->
        <!--</div>-->
    <!--</footer>-->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>

</body>

</html>
