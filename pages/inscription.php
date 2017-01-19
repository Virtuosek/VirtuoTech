<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

<div class="background">
<div class="container">
<div class="margin-top"></div>

<?php
   if(isset($_POST['submit_register'])){
        $ObjClient=new DAOClient($cnx);
        $retour=null;
        $fname = ($_POST['nom']);
        $lname = ($_POST['prenom']);
        $username = ($_POST['pseudo']);
        $pass1 = ($_POST['mdp']);
        $pass2 = ($_POST['confmdp']);
        $email = ($_POST['email']);
        if(!empty($fname) && !empty($lname) && !empty($username) && !empty($pass1) && !empty($pass2)  && !empty($email)){
            if(!matches("@([A-Za-z]{2,})@",$fname) || !matches("@([A-Za-z]{2,})@",$lname))
                alert("alert-danger","Le nom et prénom ne doivent contenir que des lettres (au moins 2)");
            else if(!matches("@(^.{5,}$)@",$pass1) || !matches("@(^.{5,}$)@",$username))
                alert("alert-danger","Votre pseudo et mot de passe doivent contenir au moins 5 caractères");
            else if($pass1!=$pass2)
                alert("alert-danger","Les deux mots de passe sont différents");
            else
                /* Le type par défaut de l'utilisateur est 1 : client */
                $retour=$ObjClient->create_client($lname,$fname,$username,$pass1,$email,1);
            if($retour==1)
                alert("alert-success","Inscription effectuée!");
        }else
            alert("alert-danger"," Veuillez remplir tous les champs.");
    }
?>
<form action="index.php?page=inscription" method="post" id="register">
    <div class="row mrg-top">
        <div class="col-lg-2 col-md-1 col-sm-1"></div>
        <div class="pad-bot col-lg-4 col-md-5 col-sm-5">
            <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-user fa"></i></span>
                <input type="text" class="form-control" name="nom" id="nom"  placeholder="Entrez votre nom"/></label>
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
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users fa"></i></span>
                <input type="text" class="form-control color" name="pseudo" id="pseudo"  placeholder="Entrer votre pseudo"/>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-2 col-md-1 col-sm-1"></div>
        <div class="pad-bot col-lg-4 col-md-5 col-sm-5">
            <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-lock fa-lg"></i></span>
                <input type="password" class="form-control" name="mdp" id="password"  placeholder="Mot de passe"/>
            </div>
        </div>
        <div class="pad-bot col-lg-4 col-md-5 col-sm-5">
            <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-lock fa-lg"></i></span>
                <input type="password" class="form-control" name="confmdp" id="vpassword"  placeholder="Confirmez Mot de passe"/>
            </div>
        </div>
    </div>
    
    <div class="pad bot col-lg-4 col-md-3 col-sm-3"></div>
    
    <div class="pad-bot col-lg-4 col-md-5 col-sm-5">
        <input type="submit" class="btn btn-primary btn-md btn-block" name="submit_register" id="submit_register" value="S'inscrire"/>
    </div>
    </form>

    <div class="margin-bot"></div>

</div>
</div>

<?php 
    function alert($type,$message){ ?>
        <span class="margin-center"></span>
        <div class="centrer alert <?php print $type?> alert-dismissable fade in" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php print $message;?>
        </div>
        <?php
    }
    
    function matches($pattern,$subject){
        return preg_match($pattern,$subject);
    }
?>