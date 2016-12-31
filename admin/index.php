<?php

    include('./admin/pages/menu_admin.php');
    ?>

    <header class="mr-top-m20">
        <a href="./index.php?page=accueil">
            <img src="./admin/images/ban1.jpg" alt="VirtuoTech" class="img-responsive"/>
        </a>
    </header>
    <?php

    /* Pages : */
    if(!isset($_SESSION['page']))
        $_SESSION['page']="accueil_admin";
    
    if(isset($_GET['page']))
        $_SESSION['page']=$_GET['page'];
    
    $path='./admin/pages/'.$_SESSION['page'].'.php';

    if(file_exists($path))
        include($path);
    else
        include './pages/404.php';
    
    ?>

    <footer>
        <!--<div class="mrg-bot-200"></div>-->
        <div class="navbar navbar-inverse navbar-fixed-bottom">
            <div class="centrer">
                <div class= "text-muted txt100">
                    <p> CopyRight VirtuoTech 2016 All Rights Reserved.</p>
                </div>
            </div>
    </footer>

    <a id="back-to-top" class="btn btn-primary bt-retour"><span class="glyphicon glyphicon-chevron-up"></span></a>