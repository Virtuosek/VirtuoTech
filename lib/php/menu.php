<?php
    $type=new Type_articleDB($cnx);
    $liste_type=$type->getType_article();
    $nbr=count($liste_type);
    if(isset($_POST['submit_login'])){
        $log=new AdminBD($cnx);
        $retour=$log->isAuthorized($_POST['login'],$_POST['password']);
        if($retour!=0){
            $_SESSION['client']=$retour; // récupération de l'id du client connecté
        }
        else{
            //exception handling
            $message="Données incorrectes";
        }
    }
?>
<link href='../admin/lib/css/general_css.css' type='text/css'/>

<nav class="navbar navbar-inverse mrg-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="./index.php?page=accueil">Accueil</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" role="button">Articles<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <?php
                    /* Articles : */
                    for($i=0;$i<$nbr;$i++){ ?>
                        <div class="no-deco">
                            <li>
                                <?php 
                                    /* Menu dynamique avec envoie de l'id de la catégorie à la page articles.php */
                                    $lien= $_SESSION['type_article']=$liste_type[$i]->id_categorie;
                                    $intitule = utf8_encode($liste_type[$i]->intitule);
                                    $pageLink='./index.php?page=articles';
                                    echo "<a href='$pageLink&link=".$lien."'>$intitule</a>";
                                ?>
                            </li>
                        </div>
                        <li class="divider"></li>
                       <?php       
                    } ?>
                </ul>
            </li>
            <li><a href="./index.php?page=monpanier">Mon Panier</a></li> 
            <li><a href="./index.php?page=historique">Historique</a></li> 
            <li><a data-toggle="modal" data-target="#contact" data-original-title>Contact</a></li>
        <!-- Form de Login -->
            <?php if(!isset($_SESSION['client'])){?>
            <form action="<?php print $_SERVER['PHP_SELF']; ?>" method='post' id="form_auth_" class=" navbar-form navbar-right">
                <div class="row">
                    <div class="input-group col-lg-4 col-md-3 col-xs-5">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login_" class="form-control" type="text" name="login" placeholder="Pseudo">                      
                    </div>
                    <div class="input-group col-lg-4 col-md-3 col-xs-5">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password_" class="form-control" type="password"  name="password" placeholder="Mot de passe">                                        
                    </div>
                    <input type="submit" class="btn btn-primary" name="submit_login" id="submit_login_" value="Connexion"/>
                    <a type="button" class="btn btn-info" href="./index.php?page=inscription">Inscription</a>
                </div>
            </form>
        <?php }else {?> 
                <li><a href="./index.php?page=disconnect">Déconnexion</a></li>
        <?php } ?>
        </ul>
        </div>
        <!-- Modal de contact -->
        <form action="" method="post">
        <div class="row">
            <div class="modal fade" id="contact">
                <div class="modal-dialog">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="panel-title" id="contactLabel">Une question ? Contactez-nous</h4>
                        </div>
                        <form action="#" method="post" accept-charset="utf-8">
                        <div class="modal-body">
                            <div class="row">
                                <div class="pad-bot col-lg-6 col-md-6 col-sm-6">
                                    <input class="form-control" name="firstname" placeholder="Prénom" type="text" required autofocus />
                                </div>
                                <div class="pad-bot col-lg-6 col-md-6 col-sm-6">
                                    <input class="form-control" name="lastname" placeholder="Nom" type="text" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="pad-bot col-lg-12 col-md-12 col-sm-12">
                                    <input class="form-control" name="email" placeholder="E-mail" type="text" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class=" pad-bot col-lg-12 col-md-12 col-sm-12">
                                    <input class="form-control" name="subject" placeholder="Sujet" type="text" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <textarea  class="form-control" placeholder="Message..." rows="6" name="comment" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="pad-bot panel-footer">
                            <input type="submit" class="btn btn-primary" value="Envoyer"/>
                            <input type="reset" class="btn btn-default" value="Vider" />
                            <button class="right-float btn btn-default btn-close" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        </form>    
    </div>
  </div>
</nav>

