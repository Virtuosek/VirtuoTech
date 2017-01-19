
<div class="background3">
<div class="container">
<?php

    $ObjArticle = new DAOArticle($cnx);
    $listeArti = $ObjArticle->readAll();
    $nbrArti = count($listeArti);
    
    /* Affichage des catégories : */
    $ObjCategorie = new DAOCategorie($cnx);
    $listeCat = $ObjCategorie->readAll();
    $nbrCat = count($listeCat);
    
/* Create (Form) : */
    if(isset($_POST['newArticle'])){
       ?>
        <span class="margin-center"></span>
        <table class="container">
            <form method="post">
                <td><input  name='nom' type='text' placeholder='Nom' class='form-control'></td>
                <td><input  name='description' type='text' placeholder='Description' class='form-control'></td>
                <td><input  name='image' type='text' placeholder='Image'  class='form-control'></td>
                <td><input  name='prix' type='text' placeholder='Prix'  class='form-control'></td>
                <td>
                    <select class="custom-select form-control" name="Types[]">
                        <option selected>Catégorie</option>
                        <?php 
                            /* Menu dynamique de catégories : */
                            for($x=0;$x<$nbrCat;$x++){
                                $title = $listeCat[$x]['intitule'];
                                $id = $listeCat[$x]['id_categorie'];
                                ?>
                                <option value='<?php print $id; ?>'>
                                    <?php print utf8_encode($title);?>
                                </option>
                                <?php
                            }
                        ?>
                    </select>
                </td>
                <td>
                    <button  name='createArticle' type='submit' class='mrg-left btn btn-success btn-sm'>
                        <span class="glyphicon glyphicon-saved"></span>
                    </button>
                    </td>
                <td>
                    <button name='cancel' type='submit' class=' btn btn-danger btn-sm'>
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                </td>
            </form>
        </table>
        <?php
    }
    
/* Create (DB) : */
    if(isset($_POST['createArticle'])){
        
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $image = $_POST['image'];
        $prix = $_POST['prix'];
        
        if(!empty($nom) && !empty($description) && !empty($image) && !empty($prix)){
            
            /* Récupération de l'id de la catégorie sélectionnée : */
            $idCategorie=0;
            foreach ($_POST['Types'] as $idCat)
                $idCategorie=$idCat;
            
            /* Aucun article n'est sélectionné : */
            if($idCategorie==0)
                alert("alert-danger","Veuillez selectionner une catégorie");
            
            else{
               /* Ajout de l'article : */
               $addedArt = $ObjArticle->create_article($nom, $description, $image, $idCategorie, $prix);
               if($addedArt!=0)
                   alert("alert-success","L'article <?php print $nom ?> a été ajouté.");
               else
                   alert("alert-danger","L'ajout n'a pas été effectué.");
           }
        }else
            alert("alert-danger","Veuillez remplir tous les champs.");
    }
    
/* Update (Form) : */
    for($i=0;$i<999;$i++){
        if(isset($_POST['up'.$i])){
            /* Comme pour la création, créer une ligne comprenant les infos de l'article sélectionné : */
            $idUp = $i;
            $articleUp = $ObjArticle->readArticle2($idUp);
            ?>
            <span class="margin-center"></span>
            <table class="container">
                <form method="get">
                    <td><input readonly name='idUp' type='text' value="<?php print utf8_encode($articleUp['id_article']);?>" class='form-control'></td>
                    <td><input  name='nomUp' type='text' value="<?php print utf8_encode($articleUp['nom']); ?>" class='form-control'></td>
                    <td><input  name='descriptionUp' type='text'value="<?php print utf8_encode($articleUp['description']); ?>" class='form-control'></td>
                    <td><input  name='imageUp' type='text' value="<?php print utf8_encode($articleUp['image']); ?>"  class='form-control'></td>
                    <td><input  name='prixUp' type='text' value="<?php print utf8_encode($articleUp['prix']); ?>"  class='form-control'></td>
                    <td>
                        <select class="custom-select form-control" name="Cats[]">
                            <?php
                                /* Afficher par défaut la catégorie à laquelle l'article correspond :  */
                                for($x=0;$x<$nbrCat;$x++){
                                    $title = $listeCat[$x]['intitule'];
                                    $id = $listeCat[$x]['id_categorie'];
                                    if($id==$articleUp['fk_categorie']){
                                        ?> <option selected><?php print utf8_encode($title);?></option> <?php 
                                    }else{
                                        ?> <option value='<?php print $id; ?>'> <?php print utf8_encode($title);?> </option> <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                    <td>
                        <button name='updateArticle' id='updateArticle' type='submit' class='mrg-left btn btn-warning btn-sm'>
                            <span class="glyphicon glyphicon-saved"></span>
                        </button>
                    </td>
                    <td>
                        <button name='cancel' type='submit' class='btn btn-danger btn-sm'>
                            <span class="glyphicon glyphicon-remove"></span>
                        </button>
                    </td>
                </form>
            </table>
            <?php
        }
    }
    
/* Update (DB) : */
    if(isset($_GET['updateArticle'])){
        
        $idArt = $_GET['idUp'];
        $nomUp = $_GET['nomUp'];
        $descriUp = $_GET['descriptionUp'];
        $imageUp = $_GET['imageUp'];
        $prixUp = $_GET['prixUp'];

        if(!empty($nomUp) && !empty($descriUp) && !empty($imageUp) && !empty($prixUp)){
            $catUp=0;
            $idCatUp;

            foreach ($_GET['Cats'] as $idCat)
                $catUp=$idCat;

            /* $idCat change entre String et int : */
            for($w=0;$w<$nbrCat;$w++)
                if($listeCat[$w]['intitule']==$catUp || $listeCat[$w]['id_categorie']==$catUp)
                    $idCatUp = $listeCat[$w]['id_categorie'];

            $updatedArticle = $ObjArticle->updateArticle($idArt, $nomUp, $descriUp, $imageUp, $idCatUp, $prixUp);

            if($updatedArticle!=0 && $idArt!=0){
                alert("alert-success","L'article <?php print $nomUp ?> a été modifié.");
            }
            else
                alert("alert-danger","Veuillez remplir tous les champs.");
        }
    }
    
/* Delete (DB)  : */
    for($i=0;$i<999;$i++){
        if(isset($_POST['id'.$i])){
            $deleted=$ObjArticle->deleteArticle($i);
            if($deleted<=0)
                alert("alert-success","L'article a été supprimé.");
            /* Exception Handling : dans le DAO Article */
        }
    }
?>
    
<div class="row">
    <div class="panel panel-primary filterable">
        <div class="panel-heading">
            <h3 class="panel-title">Articles</h3>
            <div class="pull-right">
                <form method="post" class="inline mrg-left">
                    <input type="submit" name="newArticle" id="newArticle" class="btn btn-primary btn-xs pull-left" value="Ajouter">
                </form>
                <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span>Filtrer</button>
            </div>
        </div>
        <table class="table table-hover table-responsive" id="tab_logic">
            <thead>
                <tr class="filters">
                    <th><input type="text" class="form-control" placeholder="Identifiant" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Nom" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Description" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Image" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Prix" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Catégorie" disabled></th>
                    <th><input type="text" class="form-control" placeholder="MAJ" disabled></th>
                    <th><input type="text" class="form-control" placeholder="SUP" disabled></th>
                </tr>
            </thead>
            <tbody>
                <?php
                /* Read : */
                for($i=0;$i<$nbrArti;$i++){ ?>
                    <tr>
                        <td><?php print $listeArti[$i]['id_article']; ?></td>
                        <td><?php print utf8_encode($listeArti[$i]['nom']); ?></td>
                        <td><?php print utf8_encode($listeArti[$i]['description']); ?></td>
                        <td><?php print $listeArti[$i]['image']; ?></td>
                        <td><?php print $listeArti[$i]['prix']; ?></td>
                        <?php
                            $categorie='-';
                            for($j=0;$j<$nbrCat;$j++){
                                if($listeArti[$i]['fk_categorie']==$listeCat[$j]['id_categorie'])
                                    $categorie=$listeCat[$j]['intitule'];
                            }
                        ?>
                        <td><?php print utf8_encode($categorie); ?></td>
                        <?php $id=$listeArti[$i]['id_article']; $lastId = $i;?>
                        <td>
                            <form method="post">
                                <button class="btn btn-primary btn-xs confirm-delete" id="up<?php print $i; ?>" name="up<?php print $id; ?>">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form method="post">
                                <?php $id=$listeArti[$i]['id_article']; $lastId = $i;?>
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
        <div class="centrer alert <?php print $type?> alert-dismissable fade in" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php print $message;?>
            <a id="refreshAlert" href="index.php?page=articles_admin" data-dismiss="alert" class="btn btn-inverse btn-xs pull-left glyphicon glyphicon-refresh close" ></a>
        </div>
        <?php
    }
?>