
<div class="background3">
<div class="container mr-bot">

<?php
    $ObjClient = new DAOClient($cnx);
    $listeCli = $ObjClient->readAll();
    $nbrCli = count($listeCli);
    
/* Create (Form) : */
    if(isset($_POST['newClient'])){
       ?>
        <span class="margin-center"></span>
        <table class="container">
            <form method="post">
                <td><input id='nom' name='nom' type='text' placeholder='Nom' class='form-control'></td>
                <td><input id='prenom' name='prenom' type='text' placeholder='Prénom' class='form-control'></td>
                <td><input id='pseudo' name='pseudo' type='text' placeholder='Pseudo'  class='form-control'></td>
                <td><input id='email' name='email'type='text' placeholder='Email'  class='form-control'></td>
                <td>
                    <select class="custom-select form-control" name="Types[]">
                        <option selected>Type</option>
                        <option value='1'>Client</option>
                        <option value='2'>Administrateur</option>
                    </select>
                </td>
                <td><input  name='createUser' type='submit' value='+' class='mrg-left btn btn-success btn-sm'></td>
                <td><input  name='cancel' type='submit' value='X' class='btn btn-danger btn-sm'></td>
            </form>
        </table>
        <?php
    }
    
/* Create (DB) */
    if(isset($_POST['createUser'])){
        
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
            
        if(!empty($nom) && !empty($prenom) && !empty($pseudo) && !empty($email)){
            
            /* Aucun article n'est sélectionné : */
            $type=0;
            foreach ($_POST['Types'] as $a) {
                $type=$a;
            }
            if($type==0){
                alert("alert-danger","Veuillez selectionner une catégorie");
            }
            else{
               /* Ajout de l'article : */
               $addedArt = $ObjArticle->create_article($nom, $description, $image, $idCategorie, $prix);
               if($addedArt!=0){
                   alert("alert-success","L'article <?php print $nom ?> a été ajouté.");
               }
               else
                   alert("alert-danger","L'ajout n'a pas été effectué.");
           }
        }else
            alert("alert-danger","Veuillez remplir tous les champs.");
    }
    
?>
        
<div class="row">
    <div class="panel panel-primary filterable">
        <div class="panel-heading">
            <h3 class="panel-title">Utilisateurs</h3>
            <div class="pull-right">
                <form method="post" class="inline mrg-left">
                    <input type="submit" name="newClient" id="newClient" class="btn btn-primary btn-xs pull-left" value="Ajouter">
                </form>
                <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span>Filtrer</button>
            </div>
        </div>
        <table class="table table-hover">
            <thead>
                <tr class="filters">
                    <th><input type="text" class="form-control" placeholder="Identifiant" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Nom" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Prénom" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Pseudo" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Email" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Type" disabled></th>
                    <th><input type="text" class="form-control" placeholder="MAJ" disabled></th>
                    <th><input type="text" class="form-control" placeholder="SUP" disabled></th>
                </tr>
            </thead>
            <tbody> 
                <?php
                for($i=0;$i<$nbrCli;$i++){ ?>
                    <tr>
                        <td><?php print $listeCli[$i]['id_client']; ?></td>
                        <td><?php print $listeCli[$i]['nom_client']; ?></td>
                        <td><?php print $listeCli[$i]['prenom']; ?></td>
                        <td><?php print $listeCli[$i]['pseudo']; ?></td>
                        <td><?php print $listeCli[$i]['email']; ?></td>
                        <?php if($listeCli[$i]['type_client']==1)  $type="Client"; else  $type="Administrateur"; ?>
                        <td><?php print $type ?></td>
                        <?php $id=$listeCli[$i]['id_client'];?>
                        <td>
                            <form method="post">
                                <button class="btn btn-primary btn-xs confirm-delete" id="up<?php print $i; ?>" name="up<?php print $id; ?>">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form method="post">
                                <?php $id=$listeCli[$i]['id_client'];?>
                                <button class="btn btn-danger btn-xs confirm-delete" id="id<?php print $i; ?>" name="id<?php print $id; ?>">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php
                } ?>
            </tbody>
        </table>
    </div>
</div>
        
</div>
</div>

<?php 
    function alert($type,$message){ ?>
        <span class="margin-center"></span>
        <div class="centrer alert <?php print $type?> alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php print $message;?>
            <a href="#" data-dismiss="alert" class="btn btn-inverse btn-xs pull-left glyphicon glyphicon-refresh close" onClick="window.location.href=window.location.href"></a>
        </div>
        <?php
    }
?>