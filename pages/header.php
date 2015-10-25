<?php include 'admin/pages/config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <script data-cfasync="false" type="text/javascript" src="js/jquery.js"></script>
    <script data-cfasync="false" type="text/javascript" src="js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <meta charset="UTF-8" />
    <script data-cfasync="false" type="text/javascript" src="js/tinymce/jquery.tinymce.min.js"></script>
    <script data-cfasync="false" type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
    <title>ASBF - Actions Solidaires Brony Francophone</title>
</head>
<body>
    <div class="container-fluid">
        <center>
            <!-- TODO: wtf -->
            <br>
            <a href="/"><img height="25%" src="img/header.png"></a>
            <br>
            <br>
        </center>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/"><i class="fa fa-home"></i></a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-search"></i>&nbsp;Bénévolat <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="offres.php"><i class="fa fa-street-view"></i> Offres</a></li>
                                <!-- <li><a href="benevolat.php"><i class="fa fa-life-ring" disabled></i> Qu'est-ce que c'est ?</a></li> -->
                            </ul>
                        </li>
                        <li><a href="http://wiki.asbf.fr/wiki/asbf/accueil"><i class="fa fa-plus"></i>&nbsp;Rejoindre l'association</a></li>
                    </ul>
                </div>
            </div>
        </nav>
