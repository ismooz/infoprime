            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Liste des types de demandes de contact</div>
                    <div class="panel-body">
                        <a href="/comparateur/admin/contactsTypes/insert.html" class="btn btn-sm btn-default">Ajouter un type de demande de contact</a>
                        <br/>
                        <br/>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="col-md-11 col-sm-11 col-xs-11">Nom</th>
                                    <th class="col-md-1 col-ms-1 col-xs-1 txt-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    // Vérifie qu'un conct existe
    if(count($contactsTypes) < 1): 
?>
                                <tr>
                                    <td colspan="5" class="txt-center">Aucun enregistrement</td>
                                </tr>
<?php
    endif;
    // Parcours tous les clients
    foreach($contactsTypes as $contactType): 
?>
                                <tr>
                                    <td><?php echo $contactType->getName(); ?></td>
                                    <td style="text-align:center;white-space:nowrap"><a href="update-<?php echo($contactType->getId()); ?>.html" class="btn btn-sm btn-default"><i class="fa fa-edit"></i></a>&nbsp;<a href="delete-<?php echo($contactType->getId()); ?>.html" class="btn btn-sm btn-default" onclick="return confirmDelete('cette demande de contact');"><i class="fa fa-eraser"></i></a></td>
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