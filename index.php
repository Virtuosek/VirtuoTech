<!DOCTYPE html>
<?php
    ob_start(); // Permet l'actualisation de certaines pages
    include ('./admin/lib/php/adm_liste_include.php');
    $cnx=Connexion::getInstance($dsn, $user, $password);
    session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <link href="./admin/lib/css/bootstrap-3.3.7/dist/css/bootstrap.css" rel="stylesheet">
    <link href="./admin/lib/css/general_css.css" rel="stylesheet">
    <script src="./admin/lib/js/jquery.js"></script>
    <script src="./admin/lib/js/bootstrap.min.js"></script>
    <script src="./admin/lib/js/personal_js.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.10/cookieconsent.min.js"></script>
    <title>VirtuoTech</title>
</head>
<body>
    <div class="background">
        <!-- Menu responsive -->
        <?php
        //$_SESSION['admin']=1;
        if(!isset($_SESSION['admin'])){
            if(file_exists('./lib/php/menu.php')){
                include('./lib/php/menu.php');
            }
        }/*else{
            if(file_exists('./admin/pages/menu_admin.php')){
                include('./admin/pages/menu_admin.php');
            }
        }*/
        ?>
        <!-- Header -->
        <?php if(!isset($_SESSION['admin'])){ ?>
            <header class="header-image margin-bot">
                <a href="./index.php?page=accueil">
                    <img src="./admin/images/ban2.png" alt="VirtuoTech" class="img-responsive"/>
                </a>
            </header>
            <?php
        }else{ ?>
           <header class="header-image margin-bot">
                <a href="./index.php?page=accueil">
                    <img src="./admin/images/ban1.jpg" alt="VirtuoTech" class="img-responsive"/>
                </a>
            </header>
            <?php
        }
        /* Pages : */
        if(!isset($_SESSION['page'])){
        $_SESSION['page']="accueil";
        }
        if(isset($_GET['page'])){
            $_SESSION['page']=$_GET['page'];
        }
        $path='./pages/'.$_SESSION['page'].'.php';
        if(file_exists($path)){
            include($path);
        }else{
            include './pages/404.php';
        }
        ?>
        <!-- Footer -->
        <footer>
            <div class="navbar navbar-inverse navbar-fixed-bottom">
                <div class="container centrer">
                    <div class= "text-muted txt100">
                    <p> CopyRight VirtuoTech 2016 All Rights Reserved.</p>
                </div>
            </div>
        </footer>
    </div>
    <a id="back-to-top" class="btn btn-primary bt-retour"><span class="glyphicon glyphicon-chevron-up"></span></a>
</body>
</html>
