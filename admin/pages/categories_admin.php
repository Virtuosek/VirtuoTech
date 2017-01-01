<div class="background3">
<div class="container">
    
<?php
    $ObjCategorie = new DAOCategorie($cnx);
    $listeCat = $ObjCategorie->readAll();
    $nbrCat = count($listeCat);
    
/* Create (Form) : */
    if(isset($_POST['newCategory'])){
       ?>
        <span class="margin-center"></span>
        <table>
            <form method="post">
                <td><input id='intitule' name='intitule' type='text' placeholder='Intitulé' class=' form-control centrer'></td>
                <td><input  name='createCategory' type='submit' value='Ajouter' class='mrg-left btn btn-success btn-sm'></td>
                <td><input  name='cancel' type='submit' value='Annuler' class='btn btn-danger btn-sm'></td>
            </form>
        </table>
        <?php
    }
    
/* Create (DB) */
    if(isset($_POST['createCategory'])){
        
        $intitule = $_POST['intitule'];
            
        if(!empty($intitule)){
            /* Ajout de l'article : */
            $newCat = $ObjCategorie->create_category($intitule);
            if($newCat!=0)
                alert("alert-success","La catégorie a été ajoutée.");
            else
                alert("alert-danger","L'ajout n'a pas été effectué.");
        }else
            alert("alert-danger","Veuillez remplir tous les champs.");
    }
    
/* Update (Form) : */
    for($i=0;$i<999;$i++){
        if(isset($_POST['up'.$i])){
            /* Comme pour la création, créer une ligne comprenant l'intitulé de la catégorie sélectionnée : */
            $categorieUp = $ObjCategorie->read($i);
            ?>
            <span class="margin-center"></span>
            <table>
                <form method="get">
                    <td><input readonly name='idCatUp' type='text' value="<?php print utf8_encode($categorieUp['id_categorie']);?>" class='form-control'></td>
                    <td><input  name='intituleUp' type='text' value="<?php print utf8_encode($categorieUp['intitule']); ?>" class='form-control'></td>
                    <td><input name='updateC' type='submit' value='Modifier' class='mrg-left btn btn-warning btn-sm'></td>
                    <td><input name='cancel' type='submit' value='Annuler' class='btn btn-danger btn-sm'></td>
                </form>
            </table>
            <?php
        }
    }
    
/* Update (DB) : */
    if(isset($_GET['updateC'])){
        $idCatUp = $_GET['idCatUp'];
        $intituleUp = $_GET['intituleUp'];

        if(!empty($intituleUp)){
            $updatedCategory = $ObjCategorie->update_category($idCatUp, $intituleUp);
            if($updatedCategory!=0 && $idCatUp!=0)
                alert("alert-success","La catégorie a été modifiée.");
        }
        else
            alert("alert-danger","Veuillez remplir tous les champs.");
    }
    
/* Delete (DB) : */
    for($i=0;$i<999;$i++){
        if(isset($_POST['id'.$i])){
            $deleted=$ObjCategorie->delete($i);
            if($deleted!==null)
                alert("alert-success","La catégorie  a été supprimée.");
        }
    }
?>
<div class="row">
    <div class="panel panel-primary filterable">
        <div class="panel-heading">
            <h3 class="panel-title">Catégories</h3>
            <div class="pull-right">
                <form method="post" class="inline mrg-left">
                    <input type="submit" name="newCategory" id="newClient" class="btn btn-primary btn-xs pull-left" value="Ajouter">
                </form>
                <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span>Filtrer</button>
            </div>
        </div>
        <table class="table table-hover table-responsive" id="tab_logic">
            <thead>
                <tr class="filters">
                    <th><input class="centrer" type="text" class="form-control" placeholder="Identifiant" disabled></th>
                    <th><input class="centrer" type="text" class="form-control" placeholder="Intitulé" disabled></th>
                    <th><input class="margin-center" type="text" class="form-control" placeholder="Modifier" disabled></th>
                    <th><input class="margin-center" type="text" class="form-control" placeholder="Supprimer" disabled></th>
                </tr>
            </thead>
            <tbody>
                <?php
                for($i=0;$i<$nbrCat;$i++){ ?>
                    <tr>
                        <td class="centrer"><?php print $listeCat[$i]['id_categorie']; ?></td>
                        <td class="centrer"><?php print utf8_encode($listeCat[$i]['intitule']); ?></td>
                        <td>
                            <?php $id=$listeCat[$i]['id_categorie'];?>
                            <form method="post">
                                <button class="margin-center btn btn-primary btn-xs confirm-delete" id="up<?php print $i; ?>" name="up<?php print $id; ?>">
                                    Modifier
                                </button>
                            </form>
                        </td>
                        <td>
                            <form method="post">
                                <button class="margin-center btn btn-danger btn-xs confirm-delete" id="id<?php print $i; ?>" name="id<?php print $id; ?>">
                                    Supprimer
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
            <a href="index.php?page=categories_admin" data-dismiss="alert" class="btn btn-inverse btn-xs pull-left glyphicon glyphicon-refresh close"></a>
        </div>
        <?php
    }
?>
