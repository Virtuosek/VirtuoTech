<div class="background3">
<div class="container">

<?php
    $ObjCommande = new DAOCommande($cnx);
    $listeCom = $ObjCommande->readAll();
    $nbrCom = count($listeCom);
    
/* Update (Form) : */
    $idCom=0;
    $ObjEtat = new DAOEtat($cnx);
    $listeEtat = $ObjEtat->readAll();
    $nbrEt = count($listeEtat);
    for($i=0;$i<999;$i++){
        if(isset($_POST['up'.$i])){
            $idCom=$i;
            $commande = $ObjCommande->read($i);
            ?>
            <span class="margin-center"></span>
            <table>
                <form method="get">
                    <td><input readonly name='idCom' type='text' value="<?php print $commande['id_commande'];?>" class='form-control' readonly></td>
                    <td>
                        <select class="custom-select form-control" name="Case[]">
                            <?php
                            for($x=0;$x<$nbrEt;$x++){
                                ?>
                                <option value='<?php print utf8_encode($listeEtat[$x]['description']); ?>'>
                                <?php print utf8_encode($listeEtat[$x]['description']); ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                    <td><input name='updateCom' id='updateCom' type='submit' value='Modifier' class='mrg-left btn btn-warning btn-sm'></td>
                    <td><input name='cancel' type='submit' value='Annuler' class='btn btn-danger btn-sm'></td>
                </form>
            </table>
            <?php
        }
    }
    
/* Update (DB) : */
    if(isset($_GET['updateCom'])){
        $type="";
        $idtype=0;
        $idCom = $_GET['idCom'];
        $commande = $ObjCommande->read($idCom);
        foreach ($_GET['Case'] as $a)
            $type=$a;
        /* Récupération de l'id de l'état sélectionné : */
        for($x=0;$x<$nbrEt;$x++){
            if(utf8_encode($listeEtat[$x]['description'])==$type){
                $idtype=$listeEtat[$x]['id_etat'];
            }
        }
        $updatedCom = $ObjCommande->update_commande($idCom, $idtype);
        if($updatedCom!=0 && $idCom!=0)
            alert("alert-success","L'état de la commande a été modifié.");
    }
    
/* Delete (DB) */
    for($i=0;$i<999;$i++){
        if(isset($_POST['id'.$i])){
            $deleted=$ObjCommande->delete($i);
            if($deleted!==null)
                alert("alert-success","La commande a été supprimée.");
        }
    }
?>

<div class="row">
    <div class="panel panel-primary filterable">
        <div class="panel-heading">
            <h3 class="panel-title">Articles</h3>
            <div class="pull-right">
                <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span>Filtrer</button>
            </div>
        </div>
        <table class="table table-hover table-responsive" id="tab_logic">
            <thead>
                <tr class="filters">
                    <th><input type="text" class="form-control" placeholder="Identifiant" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Article" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Client" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Quantité" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Date" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Etat" disabled></th>
                    <th><input type="text" class="form-control" placeholder="MAJ" disabled></th>
                    <th><input type="text" class="form-control" placeholder="SUP" disabled></th>
                </tr>
            </thead>
            <tbody> 
                <?php
                /* Read : */
                for($i=0;$i<$nbrCom;$i++){ ?>
                    <tr>
                        <?php /* Les articles, clients et etats sont des FK, on doit récupérer leurs valeurs : */
                            $ObjArticle = new DAOArticle($cnx);
                            $article = $ObjArticle->read($listeCom[$i]['id_article']);
                            $ObjClient = new DAOClient($cnx);
                            $client = $ObjClient->readCli($listeCom[$i]['id_client']);
                            $ObjEtat = new DAOEtat($cnx);
                            $etat = $ObjEtat->read($listeCom[$i]['id_etat']);
                        ?>
                        <td><?php print $listeCom[$i]['id_commande']; ?></td>
                        <td><?php print utf8_encode($article['nom']); ?></td>
                        <td><?php print  utf8_encode($client['nom_client']); ?></td>
                        <td><?php print $listeCom[$i]['quantite']; ?></td>
                        <td><?php print $listeCom[$i]['datecom']; ?></td>
                        <td><?php print utf8_encode($etat['description']); ?></td>
                        <?php
                            /*$categorie='-';
                            for($j=0;$j<$nbrCat;$j++){
                                if($listeArti[$i]['fk_categorie']==$listeCat[$j]['id_categorie'])
                                    $categorie=$listeCat[$j]['intitule'];
                            }*/
                        ?>
                        <?php $id=$listeCom[$i]['id_commande']; ?>
                        <td>
                            <form method="post">
                                <button class="btn btn-primary btn-xs confirm-delete" id="up<?php print $i; ?>" name="up<?php print $id; ?>">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form method="post">
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
            <a href="index.php?page=commandes_admin" data-dismiss="alert" class="btn btn-inverse btn-xs pull-left glyphicon glyphicon-refresh close"></a>
        </div>
        <?php
    }
?>