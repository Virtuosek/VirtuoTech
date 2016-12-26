<?php 
/* Client connecté : */
if(isset($_SESSION['client'])){
    
    /* Récupérer la liste des articles ajoutés au panier */
    $liste= new VuePanier($cnx);
    $liste_g=$liste->getListePanier($_SESSION['client']);
    $nbrG=count($liste_g);
    
    for($j=0;$j<999;$j++){
        /* Suppression des articles de la table Panier (voir plus bas) :  */
        if(isset($_POST['id'.$j])){
            $idDel = $j;
            $ret2 = $liste->deleteFromCart($idDel);
            if($ret2!=0){
                /* Exception handling : cas où la suppression n'a pas été effectuée : */
                ?>
                <div class="alert alert-danger alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    La suppression n'a pas été effectuée!
                </div>
                <?php
            }else{
                /* Actualiser la page pour remarquer la suppression : */
                header("Refresh:0");
            }
        }
        /* Ajout à la table Commande les articles souhaités (voir plus bas) :  */
        if(isset($_POST['cm'.$j])){
            $idArtiCm =  $j;
            $idClient = $_SESSION['client'];
            $quantite = 1; //NYI : gestion de quantité
            date_default_timezone_set('CET');
            $date = date("d/m/y");
            $logCm = new VueCommande($cnx);
            $logCm->addCommande($idClient, $idArtiCm, $quantite, $date);
        }
    }
        
    if($nbrG==0){
        ?>
        <!-- Panier vide :-->
        <div class='bottom background2'>
            <h3 class="font-bold mrg-top-30">C'est vide par içi.<br/>
            <a href="./index.php?page=articles&link=1">Acheter</a> un article ?</h3>
        </div>
        <?php
    }else{
        /* Panier non vide */?>
        <br>
        <div class="container">
            <div class="row">
                <div class="input-group col-lg-2 col-md-2 col-sm-2 col-xs-3">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
                    <button id="submit_all" name="submit_all" type="submit" class='form-control btn btn-info btn-sm col-md-4 col-lg-4'>Tout commander</button>
                </div>
            </div>
        </div>
        <br><br>
        <?php
        for($i=0;$i<$nbrG;$i++){
            /* Pour chaque id_article dans Panier, récupérer ses informations depuis la table Article : */
            $log = new VueArticle($cnx);
            $idArticle=$liste_g[$i]['id_article'];
            $liste_a = $log->readArticle($idArticle);
            $nbrA = count($liste_a);
            /* Affichage des articles du panier : */
            for($j=0;$j<$nbrA;$j++){
                ?>
                <br/><br/>
                <div class="container">
                    <div class="featurette">
                        <img src="./admin/images/<?php print $liste_a[$j]['image']; ?>"  class="featurette-image img-responsive pull-left px_200x200">
                        <h3><?php print utf8_encode($liste_a[$j]['nom']."<br/>"); ?></h3>
                        <div class="red"><?php print $liste_a[$j]['prix']."&euro;<br/>"?></div>
                        <?php print utf8_encode($liste_a[$j]['description']);?>
                        <br/><br/>
                        <form method="post">
                            <div class="row">
                                <div class="input-group col-lg-2 col-md-2 col-sm-2 col-xs-3">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-trash"></i></span>
                                    <?php $id=$liste_g[$i]['id_panier'];?>
                                    <button type="submit" id="id<?php print $i; ?>" name="id<?php print $id; ?>" 
                                            class='form-control btn btn-danger btn-sm col-md-4 col-lg-4'>Supprimer</button>
                                </div>
                                <div class="input-group col-lg-2 col-md-2 col-sm-2 col-xs-3">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-thumbs-up"></i></span>
                                    <?php $id=$liste_g[$i]['id_article'];?>
                                   <button type="submit" id="cm<?php print $i; ?>" name="cm<?php print $id; ?>" 
                                            class='form-control btn btn-primary btn-sm col-md-4 col-lg-4'>Commander</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr class="featurette-divider">
                    <div class="mr-bot"></div>
                </div>
            <?php
            }
        }
    }
}
/* Client non connecté : */
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