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
    <script src="./admin/lib/js/personal_js.js"></script>
    <script src="./admin/lib/js/functionsJqueryAdmin.js.js"></script>
    <script src="./admin/lib/js/functionsJqueryVal.js.js"></script>
    <script src="./admin/lib/js/messagesJqueryVal.js.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.10/cookieconsent.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <title>VirtuoTech</title>
</head>

<body>
    <div class="">
        <!-- Menu : -->
        <?php
        if(!isset($_SESSION['admin'])){
            if(file_exists('./lib/php/menu.php')){
                include('./lib/php/menu.php');
            }
        }else{
            if(file_exists('./admin/pages/menu_admin.php')){
                include('./admin/pages/menu_admin.php');
            }
        }
        ?>
        
        <!-- Header -->
        <?php if(!isset($_SESSION['admin'])){ ?>
            <header class="margin-bot">
                <a href="./index.php?page=accueil">
                    <img src="./admin/images/ban2.png" alt="VirtuoTech" class="img-responsive"/>
                </a>
            </header>
            <?php
        }else{ ?>
           <header class="margin-bot">
                <a href="./index.php?page=accueil">
                    <img src="./admin/images/ban1.jpg" alt="VirtuoTech" class="img-responsive"/>
                </a>
            </header class="margin-bot">
            <?php
        }
        
        /* Pages : */
        if(!isset($_SESSION['page'])){
            if(isset($_SESSION['admin']))
                $_SESSION['page']="accueil_admin";
            else
                 $_SESSION['page']="accueil";
        }
        
        if(isset($_GET['page'])){
            $_SESSION['page']=$_GET['page'];
        }
        
        if(isset($_SESSION['admin']))
            $path='./admin/pages/'.$_SESSION['page'].'.php';
        else {
            $path='./pages/'.$_SESSION['page'].'.php';
        }
       
        if(file_exists($path)){
            include($path);
        }
        else{
            include './pages/404.php';
        }
        ?>
        <!-- Footer -->
        <footer>
            <div class="navbar navbar-inverse navbar-fixed-bottom">
                <div class="centrer">
                    <div class= "text-muted txt100">
                    <p> CopyRight VirtuoTech 2016 All Rights Reserved.</p>
                </div>
            </div>
        </footer>
    </div>
    <a id="back-to-top" class="btn btn-primary bt-retour"><span class="glyphicon glyphicon-chevron-up"></span></a>
</body>
</html>
