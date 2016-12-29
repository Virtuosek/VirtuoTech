<?php

    $ObjArticle = new VueArticle($cnx);
    $listeArti = $ObjArticle->readAll();
    $nbrArti = count($listeArti);
    
    /* Affichage des catégories : */
    $ObjCategorie = new DAOCategorie($cnx);
    $listeCat = $ObjCategorie->readAll();
    $nbrCat = count($listeCat);
    
    /* Gestion de suppression : */
    for($i=0;$i<999;$i++){
        if(isset($_POST['id'.$i])){
            //$ObjArticle->deleteArticle($i);
            print 'deleted '.$i;
        }
    }
?>

<div class="background3">
<div class="container">
    <div class="row">
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Articles</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span>Filtrer</button>
                </div>
            </div>
            <table class="table table-hover" id="tab_logic">
                <thead>
                    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="Identifiant" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Nom" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Description" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Image" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Prix" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Catégorie" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Sup" disabled></th>
                    </tr>
                </thead>
                <tbody> 
                    <?php
                    for($i=0;$i<$nbrArti;$i++){ ?>
                        <tr>
                            <td><?php print $listeArti[$i]['id_article']; ?></td>
                            <td><?php print utf8_encode($listeArti[$i]['nom']); ?></td>
                            <td><?php print utf8_encode($listeArti[$i]['description']); ?></td>
                            <td><?php print $listeArti[$i]['image']; ?></td>
                            <td><?php print $listeArti[$i]['prix']; ?></td>
                            <?php 
                                $categorie="-";
                                for($j=0;$j<$nbrCat;$j++)
                                    if($listeArti[$i]['fk_categorie']==$j+1)
                                        $categorie=$listeCat[$j]['intitule'];
                            ?>
                            <td><?php print utf8_encode($categorie); ?></td>
                            <th>
                                <form method="post">
                                    <?php $id=$listeArti[$i]['id_article'];?>
                                    <button class="btn btn-danger btn-xs" data-toggle="confirmation" id="id<?php print $i; ?>" name="id<?php print $id; ?>">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </form>
                            </th>
                        </tr>
                        <?php
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
    <a id="add_row" class="btn btn-default pull-left">Ajouter un article</a>
</div>
</div>