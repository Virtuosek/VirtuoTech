<?php

    /*  Récupération de l'id de la catégorie choisie au menu : */
    if(isset($_GET['link'])){
        $_SESSION['type_article']=$_GET['link'];
        extract($_GET,EXTR_OVERWRITE);
        $liste=new VueArticle($cnx);
        /* Récupération de la liste des articles en envoyant en paramètre l'id de la catégorie */
        $liste_g=$liste->getListeArticle($_SESSION['type_article']);
        $nbrG=count($liste_g);
        $id=0;
    }

    /* Ajout des articles souhaités à la table Panier : */
    if(isset($_SESSION['client'])){
        for($i=0;$i<999;$i++){
            if(isset($_POST['id'.$i])){
                $log=new VuePanier($cnx);
                // Eventually : MAJ de la quantité d'un article ajouté au panier.
                $idClient = $_SESSION['client'];
                $idArticle = $i;
                $retour=$log->addToCart($idClient,$idArticle);
                if($retour==0){
                    /* Exception handling : cas où l'ajout n'a pas été effectué : */
                    ?>
                    <div class="alert alert-danger alert-dismissable fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        L'ajout de l'article à votre panier n'a pas été effectué
                    </div>
                    <?php
                }
            }
        }
    }
    
if(isset($nbrG) && $nbrG>0){ ?>

    <div class="container">
    <?php 
        for($i=0;$i<$nbrG;$i++){
            ?>
            <br/><br/>
            <!-- Contenu -->
            <div class="featurette">
                <img src="./admin/images/<?php print $liste_g[$i]['image']; ?>"  class="featurette-image img-responsive pull-left img_250x250">
                <h2 class="featurette-heading"><?php print utf8_encode($liste_g[$i]['nom']."<br/>"); ?></h2>
                <div class="red"><?php print $liste_g[$i]['prix']."&euro;<br/>"?></div>
                <a tabindex="0" data-trigger="focus" data-toggle="popover" data-content="<?php print utf8_encode($liste_g[$i]['description']);?>">Plus d'informations</a>
                <br/><br/>
                <form method="post">
                    <div class="row">
                        <div class="input-group col-lg-2 col-md-2 col-sm-2 col-xs-3">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-shopping-cart"></i></span>
                            <!-- Le bouton a comme nom l'id de l'article auquel il correspond : -->
                            <?php $id=$liste_g[$i]['id_article'];?>
                            <button id="id<?php print $i; ?>" name="id<?php print $id; ?>" class='form-control btn btn-info btn-sm col-md-4 col-lg-4' 
                               data-toggle='modal' data-target='#myModal'>Ajouter à mon panier</button>
                        </div>
                    </div>
                </form>
            </div>
            <hr class="featurette-divider">
            <div class="mr-bot"></div>
        <?php
        }  ?>
            
        <div class="col-sm-1">
            <?php if(isset($_SESSION['client'])){ ?>
                <!-- modal : utilisateur connecté -->
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Mon Panier</h4>
                            </div>
                            <div class="modal-body inner">
                                <img src="./admin/images/Cart.png" alt="Article ajouté" class="img_115x115 mrg-bot-10">
                                Cet article à été ajouté à votre panier.
                            </div>
                            <div class="modal-footer">
                                <a type="button" class="btn btn-default" href="./index.php?page=monpanier">Mon panier</a>
                                <button name="dismiss" type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
            }
            else{ ?>
            <!-- modal : utilisateur non connecté -->
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Erreur</h4>
                            </div>
                            <div class="modal-body inner">
                                <img src="./admin/images/sad_face.png" alt="Non connecté" class="img_115x115 mrg-bot-10">
                                Vous n'êtes pas connecté(e) pour pouvoir effectuer cette opération.
                            </div>
                            <div class="modal-footer">
                                <button name="ok" type="button" class="btn btn-default" data-dismiss="modal">D'accord</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
            } ?>
        </div>
    ?>
</div>
<?php  }else{
    print 'Empty Database';
}