            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Liste des demandes de contact</div>
                    <div class="panel-body">
                        <a href="/comparateur/admin/contacts/insert.html" class="btn btn-sm btn-default">Ajouter une demande de contact</a>
                        <br/>
                        <br/>
                        <table class="table table-striped table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th class="col-md-3 col-sm-3 col-xs-3">Nom</th>
                                    <th class="col-md-4 col-sm-4 col-xs-4">Email</th>
                                    <th class="col-md-2 col-sm-2 col-xs-2">Type</th>
                                    <th class="col-md-2 col-sm-2 col-xs-2">Etat</th>
                                    <th class="col-md-1 col-sm-1 col-xs-1 txt-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    // Vérifie qu'un conct existe
                                    if(count($contacts) < 1): 
                                ?>
                                <tr>
                                    <td colspan="5" class="txt-center">Aucune demande de contact</td>
                                </tr>
                                <?php
                                    endif;
                                    // Parcours tous les clients
                                    foreach($contacts as $contact): 
                                ?>
                                <tr>
                                    <td><?php echo($contact->getNom()); ?></td>
                                    <td><?php echo($contact->getEmail()); ?></td>
                                    <td><?php echo($contact->getNomType()); ?></td>
                                    <td><?php echo($contact->getNomEtat()); ?></td>
                                    <td style="text-align:center;white-space:nowrap"><a href="update-<?php echo($contact->getId()); ?>.html" class="btn btn-sm btn-default"><i class="fa fa-edit"></i></a>&nbsp;<a href="delete-<?php echo($contact->getId()); ?>.html" class="btn btn-sm btn-default" onclick="return confirmDelete('cette demande de contact');"><i class="fa fa-eraser"></i></a></td>
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