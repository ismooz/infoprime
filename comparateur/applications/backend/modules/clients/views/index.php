            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Liste des clients</div>
                    <div class="panel-body">
                        <a href="/comparateur/admin/clients/insert.html" class="btn btn-sm btn-default">Ajouter un client</a>
                        <br/>
                        <br/>
                        <table class="table table-striped table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th class="col-md-2 col-sm-2 col-xs-1">Nom</th>
                                    <th class="col-md-2 col-sm-2 col-xs-2">Prenom</th>
                                    <th class="col-md-3 col-sm-3 col-xs-3">Adresse</th>
                                    <th class="col-md-1 col-sm-1 col-xs-1">Npa</th>
                                    <th class="col-md-3 col-sm-3 col-xs-3">Ville</th>
                                    <th class="col-md-1 col-sm-1 col-xs-1 txt-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    // Vérifie qu'une client existe
    if(count($clients) < 1):
?>
                                <tr>
                                    <td colspan="6">Aucun enregistrement</td>
                                </tr>
<?php
    endif;
    // Parcours tous les clients
    foreach($clients as $client): 
?>
                                <tr>
                                    <td><?php echo $client->getNom(); ?></td>
                                    <td><?php echo $client->getPrenom(); ?></td>
                                    <td><?php echo $client->getAdresse(); ?></td>
                                    <td><?php echo $client->getNpa(); ?></td>
                                    <td><?php echo $client->getVille(); ?></td>
                                    <td style="text-align:center;white-space:nowrap"><a href="update-<?php echo($client->getId()); ?>.html" class="btn btn-sm btn-default"><i class="fa fa-edit"></i></a>&nbsp;<a href="delete-<?php echo($client->getId()); ?>.html" class="btn btn-sm btn-default" onclick="return confirmDelete('ce client');"><i class="fa fa-eraser"></i></a></td>
                                </tr>
<?php 
    endforeach; 
?>
                            </tbody>
                        </table>
                    </div>
                    <div class="panel-footer"></div> 
                </div>
                <div class="row">
                    <div class="txt-center">
<?php
    // Affiche la pagination
    $pagination->display();
?>                   
                    </div>
                </div>
            </div>