
<?php 
/* Client connecté : */
if(isset($_SESSION['client'])){
    $ObjCommande= new DAOCommande($cnx);
    $liste_cm=$ObjCommande->getListeCommande($_SESSION['client']);
    $nbrCm=count($liste_cm);
    if($nbrCm==0){
        ?>
        <!-- Aucune commande n'est effectuée : -->
        <div class="background">
        <div class="container">
        <div class="margin-top"></div>

        <div class='centrer'>
            <h3 class="font-bold mrg-top-30">C'est vide par içi.<br/><br/>
            <a href="./index.php?page=articles&link=1">Acheter</a> un article ?<br/><br/>
            <a href="./index.php?page=monpanier">Gérer</a> votre panier ?</h3>
        </div>
        </div>
            </div>
        <?php
    } else{
        /* Une ou plusieurs commande(s) effectuée(s) : */
        $etatColor="case_blue";
       for($i=0;$i<$nbrCm;$i++){
            /* On récupère l'id de l'article et l'etat pour afficher les données : */
            $ObjArticle = new DAOArticle($cnx);
            $article=$ObjArticle->readArticle2($liste_cm[$i]['id_article']);
            $ObjEtat = new DAOEtat($cnx);
            $etat = $ObjEtat->read($liste_cm[$i]['id_etat']);
           ?>
            <br/><br/>
            <div class="container">
                <div class="featurette">
                <img src="./admin/images/<?php print $article['image']; ?>" class="featurette-image img-responsive pull-left img_200x200">
                <h4><?php print utf8_encode($article['nom']."<br/>"); ?></h3>
                <div class="red"><?php print $article['prix']."&euro;<br/>"?></div>
                <h5> 
                    Etat : 
                    <span class="<?php print $etatColor ?>"> <?php print utf8_encode($etat['description']); ?> </span>
                    <br/><br/>
                    Date de commande :
                    <span class="<?php print $etatColor ?>"> <?php $date = strtotime($liste_cm[$i]['datecom']); print date('d/m/Y',$date); ?> </span>
                </h5>
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
/* Client non connecté : */
else{
    ?>
    <div class="background">
        <div class="container">
            <div class="margin-top"></div>
            <div class=" centrer">
                <div class="error-code">:(</div>
                <h3 class="font-bold">Vous n'êtes pas connecté</h3>
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
        </div>
    </div>
    <?php 
} 
?>

<div class='margin-bot'></div>
</div>
</div>