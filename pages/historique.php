<?php 

if(isset($_SESSION['client'])){
    $ObjCommande= new VueCommande($cnx);
    $liste_cm=$ObjCommande->getListeCommande($_SESSION['client']);
    $nbrCm=count($liste_cm);
    if($nbrCm==0){
        ?>
        <!-- Aucune commande n'est effectuée : -->
        <div class='bottom background2'>
            <h3 class="font-bold mrg-top-30">C'est par vide içi.<br/>
            <a href="./index.php?page=articles">Acheter</a> un article ?<br/>
            <a href="./index.php?page=monpanier">Gérer</a> votre panier ?</h3>
        </div>
        <?php
    } else{
        /* Une ou plusieurs commande(s) effectuée(s) : */
        $etatColor="case_blue"; //MBI : l'état de la commade
        $etat="Votre demande a été envoyée."; //MBI : l'état de la commade
       for($i=0;$i<$nbrCm;$i++){
            /* On récupère l'id de l'article pour pouvoir afficher ses données : */
            $ObjArticle = new VueArticle($cnx);
            $article=$ObjArticle->readArticle2($liste_cm[$i]['id_article']);
           ?>
            <br/><br/>
            <div class="container">
                <div class="featurette">
                <img src="./admin/images/<?php print $article['image']; ?>" class="featurette-image img-responsive pull-left px_200x200">
                <h4><?php print utf8_encode($article['nom']."<br/>"); ?></h3>
                <div class="red"><?php print $article['prix']."&euro;<br/>"?></div>
                <h4> Etat : </h4>
                <div class="<?php print $etatColor ?>">
                    <?php print $etat ?>
                    <br>le :
                    <?php 
                        $date = strtotime($liste_cm[$i]['datecom']);
                        print date('d/m/Y',$date); 
                    ?>
                </div>
                <br/><br/>
                <hr class="featurette-divider">
                </div>
            </div>
            <?php
        }
        ?><div class="mr-bot"></div><?php
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