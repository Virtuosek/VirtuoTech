<?php

    $ObjClient = new DAOClient($cnx);
    $listeCli = $ObjClient->readAll();
    $nbrCli = count($listeCli);
?>

<div class="background3">
<div class="container mr-bot">
    <div class="row">
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Utilisateurs</h3>
                <div class="pull-right">
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
                        </tr>
                        <?php
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>