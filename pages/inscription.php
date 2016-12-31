<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

<div class="background">
<div class="container">
<div class="margin-top"></div>

<?php
   if(isset($_POST['submit_register'])){
        $ObjClient=new DAOClient($cnx);
        $retour=null;
        /* NYI : Controle de saisie */
        if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['pseudo']) && !empty($_POST['mdp'])  && !empty($_POST['email'])){
            
            /* Le type par défaut de l'utilisateur est 1 = client, qui est enregistré dans la fonction create_client */
            $retour=$ObjClient->create_client($_POST['nom'],$_POST['prenom'],$_POST['pseudo'],$_POST['mdp'],$_POST['email']);
            if($retour==1){
                ?>
                <div class="alert alert-success alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Inscription effectuée!
                </div>
                <?php
            }
            else{
                ?>
                <div class="alert alert-danger alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    L'inscription n'a pas été effectuée!
                </div>
                <?php
            }
        }else{
            ?>
            <div class="alert alert-danger alert-dismissable fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Veuillez remplir tous les champs.
            </div>
            <?php
        }
    }
?>
<form action="index.php?page=inscription" method="post" id="form_auth_2_">
    <div class="row mrg-top">
        <div class="col-lg-2 col-md-1 col-sm-1"></div>
        <div class="pad-bot col-lg-4 col-md-5 col-sm-5">
            <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-user fa"></i></span>
                <input type="text" class="form-control" name="nom" id="nom"  placeholder="Entrez votre nom"/>
            </div>
        </div>
        <div class="pad-bot col-lg-4 col-md-5 col-sm-5">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user fa"></i></span>
                <input type="text" class="form-control" name="prenom" id="prenom"  placeholder="Entrez votre prénom"/>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-2 col-md-1 col-sm-1"></div>
        <div class="pad-bot col-lg-8 col-md-10 col-sm-10">
            <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-envelope fa"></i></span>
                <input type="text" class="form-control" name="email" id="email"  placeholder="Entrez votre email"/>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-2 col-md-1 col-sm-1"></div>
        <div class="pad-bot col-lg-4 col-md-5 col-sm-5">
            <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-users fa"></i></span>
                <input type="text" class="form-control" name="pseudo" id="pseudo"  placeholder="Entrer votre pseudo"/>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-2 col-md-1 col-sm-1"></div>
        <div class="pad-bot col-lg-4 col-md-5 col-sm-5">
            <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-lock fa-lg"></i></span>
                <input type="password" class="form-control" name="mdp" id="mdp"  placeholder="Mot de passe"/>
            </div>
        </div>
        <div class="pad-bot col-lg-4 col-md-5 col-sm-5">
            <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-lock fa-lg"></i></span>
                <input type="password" class="form-control" name="confirm" id="confirm"  placeholder="Confirmez Mot de passe"/>
            </div>
        </div>
    </div>
    
    <div class="pad bot col-lg-4 col-md-3 col-sm-3"></div>
    
    <div class="pad-bot col-lg-4 col-md-5 col-sm-5">
        <input type="submit" class="btn btn-primary btn-md btn-block" name="submit_register" id="submit_register" value="S'inscrire"/>
    </div>
    
    <div class="margin-bot"></div>
</form>
</div>
</div>