<?php

    $type=new DAOCategorie($cnx);
    $liste_type=$type->readAll();
    $nbr=count($liste_type);
    
    if(isset($_POST['submit_login'])){
        
        $ObjAdmin=new AdminBD($cnx);
        $retour=$ObjAdmin->isAuthorized($_POST['login'],md5($_POST['password']));
        
        if($retour!=0){
            
            $ObjClient=new DAOClient($cnx);
            $User=$ObjClient->readInfoClient($_POST['login'],md5($_POST['password']));
            
            if($User['type_client']==1)
                 $_SESSION['client']=$retour;
            else
                $_SESSION['admin']=$retour;
        }
        else
            $message="Données incorrectes";

        header("Refresh:0");
    }
?>

<nav class="navbar navbar-inverse">
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
                                    $pageLink='./index.php?page=articles';
                                    $lien=$liste_type[$i]['id_categorie'];
                                    $intitule = utf8_encode($liste_type[$i]['intitule']);
                                    echo "<a href='$pageLink&link=".$lien."'>$intitule</a>"
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
            <?php 
            if(!isset($_SESSION['client']) && !isset($_SESSION['admin'])) {
                ?>
                <form action="<?php print $_SERVER['PHP_SELF']; ?>" method='post' id="form_auth_" class=" navbar-form navbar-right">
                    <div class="row">
                        <div class="mrg-left input-group col-lg-4 col-md-3 col-xs-3">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="login_" class="form-control" type="text" name="login" placeholder="Pseudo">                      
                        </div>
                        <div class="mrg-left input-group col-lg-4 col-md-3 col-xs-3">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="password_" class="form-control" type="password"  name="password" placeholder="Mot de passe">                                        
                        </div>
                        <input type="submit" class="mrg-left btn btn-primary" name="submit_login" id="submit_login_" value="Connexion"/>
                        <a type="button" class="btn btn-info" href="./index.php?page=inscription">Inscription</a>
                    </div>
                </form>
                <?php 
            }
            else{
                ?> 
                <li><a href="./index.php?page=disconnect">Déconnexion</a></li>
                <?php 
            }
            ?>
            <?php include("./pages/contact.php"); ?>
        </ul>
    </div>
    </div>
  </div>
</nav>

