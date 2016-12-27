<?php 
/* Client connecté : */
if(isset($_SESSION['client'])){
    
    /* Récupérer la liste des articles ajoutés au panier */
    $ObjPanier= new VuePanier($cnx);
    $liste_g=$ObjPanier->getListePanier($_SESSION['client']);
    $nbrG=count($liste_g);
    for($j=0;$j<999;$j++){
        
        /* Suppression des articles de la table Panier (voir plus bas) :  */
        if(isset($_POST['id'.$j])){
            $idDel = $j;
            $ret2 = $ObjPanier->deleteFromCart($idDel);
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
            $ObjCommande = new VueCommande($cnx);
            $idCmd=$ObjCommande->addCommande($idArtiCm, $idClient, $quantite, $date);
            if($idCmd==null || $idCmd==0){
                /* Exception handling : cas où la commannde n'a pas été effectuée : */
                ?>
                <div class="alert alert-danger alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    La commande n'a pas été effectuée!
                </div>
                <?php
            }
            else{ /* Commande effectuée : */
                /* Supprimer du panier les articles qui ont été commandés : */
                $idArt=$j;
                $idCli=$_SESSION['client'];
                $delArt=$ObjPanier->deleteArticleFromCart($idArt, $idCli);
                
                if($delArt!=0 || $delArt!=null){
                    /* Exception handling : cas où la suppression de l'article commandé n'a pas été effectuée : */
                    ?>
                    <div class="alert alert-danger alert-dismissable fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        La suppression de l'article commandé n'a pas été effectuée!
                    </div>
                    <?php
                }else{
                    header("Refresh:0");
                }
            }
            // NYI : 
                /* Envoi d'un mail à l'administrateur pour l'informer qu'un client a commandé un ou plusieurs articles: */
                /*$to = 'remagkes@gmail.com';
                $subject = 'Commande VirtuoTech';
                $message = 'Le client a commandé';
                $headers[] = 'MIME-Version: 1.0';
                $headers[] = 'Content-type: text/html; charset=iso-8859-1';
                mail($to, $subject, $message, implode("\r\n", $headers));*/
        }
    }
    
    /* Bouton : tout commander */
    if(isset($_POST['submit_all'])){
        for($x=0;$x<$nbrG;$x++){
            $idArtiCm = $liste_g[$x]['id_article'];
            $idClient = $_SESSION['client'];
            $quantite = 1; //NYI : gestion de quantité
            date_default_timezone_set('CET');
            $date = date("d/m/y");
            $ObjCommande = new VueCommande($cnx);
            $idCmd=$ObjCommande->addCommande($idArtiCm, $idClient, $quantite, $date);
            $delArt=$ObjPanier->deleteArticleFromCart($idArtiCm, $idClient);
        }
        header("Refresh:0");
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
                <form method="post">
                    <div class="input-group col-lg-2 col-md-2 col-sm-2 col-xs-3">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
                        <button id="submit_all" name="submit_all" type="submit" class='form-control btn btn-info btn-sm col-md-4 col-lg-4'>Tout commander</button>
                    </div>
                </form>
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
                        <img src="./admin/images/<?php print $liste_a[$j]['image']; ?>"  class="featurette-image img-responsive pull-left img_200x200">
                        <h3><?php print utf8_encode($liste_a[$j]['nom']."<br/>"); ?></h3>
                        <div class="red"><?php print $liste_a[$j]['prix']."&euro;<br/>"?></div>
                        <?php print utf8_encode($liste_a[$j]['description']);?>
                        <br/><br/>
                        <form method="post">
                            <div class="row">
                                <div class="mrg-left20px input-group col-lg-2 col-md-2 col-sm-2 col-xs-3">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-trash"></i></span>
                                    <?php $id=$liste_g[$i]['id_panier'];?>
                                    <button type="submit" id="id<?php print $i; ?>" name="id<?php print $id; ?>" 
                                            class='form-control btn btn-danger btn-sm col-md-4 col-lg-4'>Supprimer</button>
                                </div>
                                <div class="mrg-left20px input-group col-lg-2 col-md-2 col-sm-2 col-xs-3">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-thumbs-up"></i></span>
                                    <?php $id=$liste_g[$i]['id_article'];?>
                                   <button type="submit" id="cm<?php print $i; ?>" name="cm<?php print $id; ?>"
                                           class='form-control btn btn-primary btn-sm col-md-4 col-lg-4' onclick="init()">Commander</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr class="featurette-divider">
                </div>
            <?php
            }
        }
        ?><div class="mr-bot"></div><?php
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