<?php

session_start();

require_once __DIR__ . '/../../core/security/Password.php';
require_once __DIR__ . '/../../core/database/PDODriver.php';

if (!isset($_SESSION['login']) || empty($_SESSION['login'])) {
    header('Location: login.php');
    die();
}

$bdd = PDODriver::getDriver();
$user = $bdd->queryOne('SELECT * FROM users WHERE login = :login', [':login' => $_SESSION['login']]);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ASBF -- ADMIN</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script data-cfasync="false" type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script data-cfasync="false" type="text/javascript" src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script data-cfasync="false" type="text/javascript" src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script data-cfasync="false" type="text/javascript" src="bower_components/raphael/raphael-min.js"></script>
    <script data-cfasync="false" type="text/javascript" src="bower_components/morrisjs/morris.min.js"></script>
    <script data-cfasync="false" type="text/javascript" src="js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script data-cfasync="false" type="text/javascript" src="dist/js/sb-admin-2.js"></script>

    <script data-cfasync="false" type="text/javascript" src="js/tinymce/jquery.tinymce.min.js"></script>
    <script data-cfasync="false" type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><span style="color:red;">AS</span><span style="color:blue;">BF</span> -- <span style="color:red;">Ad</span><span style="color:blue;">min</span></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= $user->login ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Déconexion</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                             <a href="offre.php"><i class="fa fa-street-view fa-fw"></i> Offres</a>
                        </li>
                        <li>
                             <a href="news.php"><i class="fa fa-newspaper-o fa-fw"></i> News</a>
                        </li>
                        <?php if ($user->rank == 1): ?>
                        <hr />
                        <li>
                             <a href="newuser.php"><i class="fa fa-user fa-fw"></i> Nouveau utilisateur</a>
                             <a href="gest_users.php"><i class="fa fa-user fa-fw"></i> Gestion des utilisateurs</a>
                        </li>
                        <?php endif ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-collapse -->
        </nav>
