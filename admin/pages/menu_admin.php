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
    $liste=array("Clients","Articles","Catégories","Commandes");
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
        <?php for($i=0;$i<4;$i++) {
            ?>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button"><?php print $liste[$i]; ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <div class="no-deco">
                            <li>Liste</li>
                            <li class="divider"></li>
                            <li>Création</li>
                            <li class="divider"></li>
                            <li>Recherche</li>
                            <li class="divider"></li>
                            <li>Suppression</li>
                            <li class="divider"></li>
                            <li>Mise à jour</li>
                            <li class="divider"></li>
                        </div>
                    </ul>
                </li>
                <?php
            } ?>
        <!-- Form de Login -->
            <?php if(!isset($_SESSION['client'])){?>
            <form action="<?php print $_SERVER['PHP_SELF']; ?>" method='post' id="form_auth_" class=" navbar-form navbar-right">
                <div class="row">
                    <div class="input-group col-lg-4 col-md-3 col-xs-5 mrg-left">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login_" class="form-control" type="text" name="login" placeholder="Pseudo">                      
                    </div>
                    <div class="input-group col-lg-4 col-md-3 col-xs-5 mrg-left">
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
    </div>
  </div>
</nav>

