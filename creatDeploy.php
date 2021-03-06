<?php
    session_start();
    if(!$_SESSION["username"]) {
        header("Location: http://localhost/GitHub/GCaaS/index.php");
        exit(0);
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

    <title>Create Deployment</title>

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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDae56eiY1v47JpfmoaBfBXBvL-7rhTYw4&libraries=drawing"></script>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="index.php">
                    <i class="fa fa-play-circle"></i> GCaaS
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li>
                        <?php
                            if($_SESSION["username"]) {
                        ?>

                            <button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#modal-logout" style="font-size:14px;"> <?php echo $_SESSION["username"] ?> </button><br>
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

    <div class="intro-body">
          <div class="container">
              <h1><br><br>Create Deployment</h1>
              <form class="form-horizontal" role="form">
                  <div class="form-group">
                      <label for="deployName" class="col-sm-2 control-label">Deployment Name : </label>
                      <div class="col-sm-10">
                          <input class="form-control" id="deployName" type="text" placeholder="Please input here...">
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="url" class="col-sm-2 control-label">Deployment URL : </label>
                      <div class="col-sm-10">
                          <div class="input-group">
                              <span class="input-group-addon">https://GCaaS.com/</span>
                              <input type="text" class="form-control" id="url" aria-describedby="basic-addon3">
                          </div>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="hashtag" class="col-sm-2 control-label">Initial Hashtag (#) : </label>
                      <div class="col-sm-10">
                          <input class="form-control" id="hashtag" type="text">
                      </div>
                  </div>

                  <fieldset>
                      <div class="form-group">
                          <label for="typeDeploy" class="col-sm-2 control-label">Type of Deployment :</label>
                          <div class="col-sm-10" id="typeDeploy">
                              <select id="select" class="form-control">
                                <option>Please select type of deployment...</option>
                                <option>Volcano Eruptions</option>
                                <option>Floods</option>
                                <option>Fires</option>
                                <option>Earthquakes</option>
                                <option>Tsunamis</option>
                              </select>
                          </div>
                      </div>
                  </fieldset>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Description : </label>
                      <div class="col-sm-10">
                          <!--<input class="form-control" id="description" type="text" >-->
                          <textarea class="form-control" rows="5" id="description"></textarea>
                      </div>
                  </div>

                  <!--<label class="col-sm-2 control-label">Configuration :</label>-->
                  <div class="form-group">
                      <label for="area" class="col-sm-2 control-label">Area of Deployment : </label>
                      <div class="col-sm-10">
                          <input class="form-control" id="area" type="text" disabled>
                      </div>
                      <br><br><br> <!--เว้นบรรทัดแผนที่ ไปแก้ที่ grayscale.js ดู margin-top-->
                      <div id="map"></div>
                  </div>

                  <!--Map Section-->
                  <!--<div id="map"></div>-->


                  <div class="panel panel-default" style="color: #333333">
                    <div class="panel-body">
                        <div class="col-sm-4">
                            <!--<button type="button" id="static" class="btn btn-default btn-block" data-toggle="collapse" data-target="#static-list">static</button>-->
                            <!--<button type="button" id="dynamic" class="btn btn-default btn-block" data-toggle="collapse" data-target="#dynamic-list">dynamic</button>-->
                            <div class="panel-group" id="layer">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#layer" href="#static-list">Static data layer</a>
                                        </h4>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#layer" href="#collapse2">Dynamic data layer</a>
                                        </h4>
                                    </div>
                                    <div id="collapse2" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <button type="button" id="dynamic-social" class="btn btn-default btn-block" data-toggle="collapse" data-target="#social-list">Social Network</button>
                                            <button type="button" id="dynamic-native" class="btn btn-default btn-block" data-toggle="collapse" data-target="#native" disabled>Native App</button>
                                            <button type="button" id="hardware" class="btn btn-default btn-block" data-toggle="collapse" data-target="#hardware" disabled>Hardware</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-8">
                            <div class="form-group panel-collapse collapse in" id="static-list" style="margin-left: 20px">
                                <label>Select static data layer</label>
                                <form role="form">
                                    <div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" id="hospital" value="Hospital">Hospital</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" id="school" value="School">School</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" id="police" value="Police station">Police station</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" id="fire" value="Fire station">Fire station</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" id="temple" value="Temple">Temple</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group panel-collapse collapse" id="social-list" style="margin-left: 20px">
                                <label>Data from Social Network</label>
                                <form role="form">
                                    <div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" id="twitter" value="" data-toggle="collapse" data-target="#twitter-list">Twitter</label>
                                        </div>
                                        <div class="panel-collapse collapse" id="twitter-list" style="margin-left: 10px">
                                            <form role="form" >
                                                <label class="radio-inline">
                                                    <input type="radio" name="optradio" id="basic" value="Twitter-basic" onclick="cusToBasic()" checked>Basic
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="optradio" id="customize" value="Twitter-customize" onclick="basicToCus()" >Customize
                                                </label>
                                            </form>

                                            <form role="form">
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="selected" id="item1" value="item1" checked disabled>Name of User
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="selected" id="item2" value="item2" checked disabled>item 2
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="selected" id="item3" value="item3" checked disabled>item 3
                                                </label>
                                                <br>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="selected" id="item4" value="item4" checked disabled>item 4
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="selected" id="item5" value="item5" checked disabled>item 5
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="selected" id="item6" value="item6" checked disabled>item 6
                                                </label>
                                            </form>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" disabled>Facebook</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" disabled>Youtube</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <button type="button" id="submit" class="btn btn-default btn-lg" onclick="submit()">Submit</button>
              </form>
          </div>

    </div>

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
                        <form id="login-form" class="text-left">
                            <div class="login-form-main-message"></div>
                            <div class="main-login-form">
                                <div class="login-group">
                                    <div class="form-group">
                                        <label for="lg_username" class="sr-only">Username</label>
                                        <input type="text" class="form-control" id="lg_username" name="lg_username" placeholder="username">
                                    </div>
                                    <div class="form-group">
                                        <label for="lg_password" class="sr-only">Password</label>
                                        <input type="password" class="form-control" id="lg_password" name="lg_password" placeholder="password">
                                    </div>
                                    <!--<div class="form-group login-group-checkbox">-->
                                    <!--<input type="checkbox" id="lg_remember" name="lg_remember">-->
                                    <!--<label for="lg_remember">remember</label>-->
                                    <!--</div>-->
                                </div>
                                <input type="submit" class="btn btn-default btn-block" value="Submit">
                                <!--<button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>-->
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
    <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false"></script>-->

    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>

</body>

</html>
