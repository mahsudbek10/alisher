<?php
if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
if (isset($_SESSION['user_email']))
    header("Location: index");
$title = "Sayram "
        . "Logistic";

function test_input($data) {
    $data1 = trim($data);
    $data2 = strip_tags($data1);
    $data3 = stripslashes($data2);
    $data4 = htmlspecialchars($data3);
    $data5 = htmlentities($data4);
    return $data5;
}

//require_once './db/db.php';
$errors = array();
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['email'], $_POST['_csrf'], $_POST['pass'])) {
    $_POST['email'] = test_input($_POST['email']);
    $_POST['pass'] = test_input($_POST['pass']);
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $user = R::findOne('useraec', 'email = ?', array($_POST['email']));
        if ($user) {
            if ($user->is_blocked == 0) {
                if (password_verify($_POST['pass'], $user->pass)) {
                    //���� ������ ���������, �� ����� ������������ ������������
                    $school = R::findOne('school', 'id = ?', array($user->school));
                    $_SESSION['user_id'] = $user->id;
                    $_SESSION['user_fio'] = $user->fio;
                    $_SESSION['user_school_id'] = $user->school;
                    $_SESSION['user_school'] = $school->name . " (" . $school->description . ")";
                    $_SESSION['user_email'] = $user->email;
                    $_SESSION['user_money'] = $user->money;
                    $_SESSION['user_city_id'] = $user->city;
                    $_POST = NULL;
                    unset($_POST);
                    $user = NULL;
                    header("Location: index");
                } else {
                    $errors[] = '�������� ����� ��� ������!';
                }
            } else
                $errors[] = '��� ������� ������������';
        }$errors[] = '�������� ����� ��� ������!';
    }$errors[] = '�������� ����� ��� ������!';
}
//    header("Location: login.php");
$_POST = NULL;
$user = NULL;
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <!-- start: Meta -->
        <meta charset="utf-8">
        <title><?= $title; ?></title>
        <meta name="description" content="Bootstrap Metro Dashboard">
        <meta name="author" content="Dennis Ji">
        <meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <!-- end: Meta -->

        <!-- start: Mobile Specific -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- end: Mobile Specific -->

        <!-- start: CSS -->
        <link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
        <link id="base-style" href="css/style.css" rel="stylesheet">
        <link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
        <!-- end: CSS -->


        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
                <link id="ie-style" href="css/ie.css" rel="stylesheet">
        <![endif]-->

        <!--[if IE 9]>
                <link id="ie9style" href="css/ie9.css" rel="stylesheet">
        <![endif]-->

        <!-- start: Favicon -->
        <link rel="shortcut icon" href="img/favicon.ico">
        <!-- end: Favicon -->

        <style type="text/css">
            body { background: url(img/bg-login.jpg) !important; }
        </style>



    </head>

    <body>
        <div class="container-fluid-full">
            <div class="row-fluid">

                <div class="row-fluid">
                    <div class="login-box">
                        <div class="icons">
                            <a href="index.html"><i class="halflings-icon home"></i></a>
                            <a href="#"><i class="halflings-icon cog"></i></a>
                        </div>
                        <h2 class="text-align-center"><?= $title; ?></h2>
                        <form class="form-horizontal" action="index" method="post">
                            <fieldset>

                                <div class="input-prepend" title="Username">
                                    <span class="add-on"><i class="halflings-icon user"></i></span>
                                    <input class="input-large span10" name="username" id="username" type="text" placeholder="type login/логин"/>
                                </div>
                                <div class="clearfix"></div>

                                <div class="input-prepend" title="Password">
                                    <span class="add-on"><i class="halflings-icon lock"></i></span>
                                    <input class="input-large span10" name="password" id="password" type="password" placeholder="type password/пароль"/>
                                </div>
                                <div class="clearfix"></div>

                                <label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me/Запомнить</label>

                                <div class="button-login">	
                                    <button type="submit" class="btn btn-primary">Login/Войти</button>
                                </div>
                                <div class="clearfix"></div>
                        </form>
                        <hr>
                        <h3>Forgot Password?/Забыл пароль?</h3>
                        <p>
                            No problem, <a href="#">click here</a> to get a new password.
                        </p>	
                        <p>
                            Не проблема, <a href="#">переходи по ссылке</a> для изменения пароля.
                        </p>	
                    </div><!--/span-->
                </div><!--/row-->


            </div><!--/.fluid-container-->

        </div><!--/fluid-row-->
        <div class="common-modal modal fade" id="common-Modal1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <ul class="list-inline item-details">
                    <li><a href="http://themifycloud.com">Admin templates</a></li>
                    <li><a href="http://themescloud.org">Bootstrap themes</a></li>
                </ul>
            </div>
        </div>
        <!-- start: JavaScript-->

        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/jquery-migrate-1.0.0.min.js"></script>

        <script src="js/jquery-ui-1.10.0.custom.min.js"></script>

        <script src="js/jquery.ui.touch-punch.js"></script>

        <script src="js/modernizr.js"></script>

        <script src="js/bootstrap.min.js"></script>

        <script src="js/jquery.cookie.js"></script>

        <script src='js/fullcalendar.min.js'></script>

        <script src='js/jquery.dataTables.min.js'></script>

        <script src="js/excanvas.js"></script>
        <script src="js/jquery.flot.js"></script>
        <script src="js/jquery.flot.pie.js"></script>
        <script src="js/jquery.flot.stack.js"></script>
        <script src="js/jquery.flot.resize.min.js"></script>

        <script src="js/jquery.chosen.min.js"></script>

        <script src="js/jquery.uniform.min.js"></script>

        <script src="js/jquery.cleditor.min.js"></script>

        <script src="js/jquery.noty.js"></script>

        <script src="js/jquery.elfinder.min.js"></script>

        <script src="js/jquery.raty.min.js"></script>

        <script src="js/jquery.iphone.toggle.js"></script>

        <script src="js/jquery.uploadify-3.1.min.js"></script>

        <script src="js/jquery.gritter.min.js"></script>

        <script src="js/jquery.imagesloaded.js"></script>

        <script src="js/jquery.masonry.min.js"></script>

        <script src="js/jquery.knob.modified.js"></script>

        <script src="js/jquery.sparkline.min.js"></script>

        <script src="js/counter.js"></script>

        <script src="js/retina.js"></script>

        <script src="js/custom.js"></script>
        <!-- end: JavaScript-->

    </body>
</html>

