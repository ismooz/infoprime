            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Liste des conseillers</div>
                    <div class="panel-body">
                        <a href="/comparateur/admin/conseillers/insert.html" class="btn btn-sm btn-default">Ajouter un conseiller</a>
                        <br/>
                        <br/>
                        <table class="table table-striped table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th class="col-md-3 col-sm-3 col-xs-3">Nom</th>
                                    <th class="col-md-3 col-sm-3 col-xs-3">Prenom</th>
                                    <th class="col-md-3 col-sm-3 col-xs-3">Adresse</th>
                                    <th class="col-md-1 col-sm-1 col-xs-1 txt-center">Npa</th>
                                    <th class="col-md-1 col-sm-1 col-xs-1">Ville</th>
                                    <th class="col-ms-1 col-sm-1 col-xs-1 txt-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    if(count($conseillers)< 1):
?>
                                <tr>
                                    <td colspan="6">Aucun enregistrement</td>
                                </tr> 
<?php
    endif;
    // Parcours tous les conseillers
    foreach($conseillers as $conseiller):     
?>
                                <tr>
                                    <td><?php echo $conseiller->getNom(); ?></td>
                                    <td><?php echo $conseiller->getPrenom(); ?></td>
                                    <td><?php echo $conseiller->getAdresse(); ?></td>
                                    <td><?php echo $conseiller->getNpa(); ?></td>
                                    <td><?php echo $conseiller->getVille(); ?></td>
                                    <td style="text-align:center;white-space:nowrap"><a href="update-<?php echo($conseiller->getId()); ?>.html" class="btn btn-sm btn-default"><i class="fa fa-edit"></i></a>&nbsp;<a href="delete-<?php echo($conseiller->getId()); ?>.html" class="btn btn-sm btn-default" onclick="return confirmDelete('ce conseiller');"><i class="fa fa-eraser"></i></a></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>
            <div class="row">
                <div class="txt-center">
<?php
    // Affiche la pagination
    $pagination->display();
?>
                </div>
            </div>