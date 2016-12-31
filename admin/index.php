<?php

    include('./admin/pages/menu_admin.php');
    ?>

    <header class="mr-top-m20">
        <a href="./index.php?page=accueil_admin">
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
        <div class="panel panel-default black">
            <div class="panel-footer">
                <div class="centrer graytext">
                    <p> CopyRight VirtuoTech 2016 All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <a id="back-to-top" class="btn btn-primary bt-retour"><span class="glyphicon glyphicon-chevron-up"></span></a>