<?php
if(isset($_POST['submit_login'])){
    $log=new AdminBD($cnx);
    $retour=$log->isAuthorized($_POST['login'],$_POST['password']);
    var_dump($retour);
    if($retour==1){
        $_SESSION['admin']=1;
        $message="Authentifié";
    }
    else{
        $message="Données incorrectes";
    }
}
?>

<section id="message">
    <?php if (isset($message)) print $message; ?>
</section>