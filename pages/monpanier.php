<?php 

if(isset($_SESSION['client'])){
    $liste= new VuePanier($cnx);
    $liste_g=$liste->getListePanier($_SESSION['client']); // id de l'utilisateur connecté
    $nbrG=count($liste_g);
    if($nbrG==0){
        ?>
        <!-- Panier vide :-->
        <div class='bottom background2'>
            <h3 class="font-bold mrg-top-30">C'est vide içi.<br/>
            <a href="./index.php?page=articles">Acheter</a> un article ?</h3>
        </div>
        <?php
    } else{
        /* Panier non vide */
        print 'non vide';
    }
}
else{
    ?>
    <link rel="stylesheet" href="../admin/lib/css/general_css.css">
    <div class="bottom background">
        <div class="mr-bot"></div>
        <div class="error-code">:(</div>
        <h3 class="font-bold">Vous n'êtes pas connecté(e)</h3>
        <div class="error-desc">
            Connectez-vous en haut de la page<br/>
            pour pouvoir visualiser votre historique
            <div>
                <a class=" login-detail-panel-button btn">
                    <i class="fa fa-arrow-left"></i>
                    <a href="./index.php?page=accueil">Retour à la page d'accueil</a>           
                </a>
            </div>
        </div>
    </div>
    <?php 
} 
?>