<!DOCTYPE html>
<?php
    ob_start(); // Permet l'actualisation de certaines pages
    include ('./admin/lib/php/adm_liste_include.php');
    $cnx=Connexion::getInstance($dsn, $user, $password);
    session_start();    
    //error_reporting(0); // Supprimer les alertes/notices... de PHP
?>
<html> 
<head>
    <meta charset="utf-8">
    <link href="./admin/lib/css/general_css.css" rel="stylesheet">
    <script src="./admin/lib/js/jquery.js"></script>
    <script src="./admin/lib/js/personal_js.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.10/cookieconsent.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <title>VirtuoTech</title>
</head>

<body>
<?php
    /* Index Administrateur : */
    if(isset($_SESSION['admin'])){
        if(file_exists('./admin/index.php'))
            include('./admin/index.php');
        else
            include './pages/404.php';
    }
    /* Index Client : */
    else{
        
        if(file_exists('./lib/php/menu.php'))
            include('./lib/php/menu.php');
        ?>
        
        <header class="mr-top-m20">
            <a href="./index.php?page=accueil">
                <img src="./admin/images/ban2.png" alt="VirtuoTech" class="img-responsive"/>
            </a>
        </header>
        
        <?php
        /* Pages : */
        if(!isset($_SESSION['page']))
            $_SESSION['page']="accueil";
        else if(isset($_GET['page']))
            $_SESSION['page']=$_GET['page'];
        
        $path='./pages/'.$_SESSION['page'].'.php';
        if(file_exists($path))
            include($path);
        else
            include './pages/404.php';
        
        ?>

        <footer id="<?php if($_SESSION['page']!="accueil" && $_SESSION['page']!="articles") print 'footer' ?>">
            <div class="panel panel-default black">
                <div class="panel-footer">
                    <div class="centrer graytext">
                        <p> CopyRight VirtuoTech 2016 All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </footer>

        <a id="back-to-top" class="btn btn-primary bt-retour"><span class="glyphicon glyphicon-chevron-up"></span></a>
        <?php 
    }
    ?>
</body>
</html>
