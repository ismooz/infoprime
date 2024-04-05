            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Liste des status de clients</div>
                    <div class="panel-body">
                        <a href="/comparateur/admin/clientsStatus/insert.html" class="btn btn-sm btn-default">Ajouter un status client</a>
                        <br/>
                        <br/>
                        <table class="table table-striped table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th class="col-md-11 col-sm-11 col-xs-11">Nom</th>
                                    <th class="col-md-1 col-sm-1 col-xs-1 txt-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    // Vérifie qu'une client existe
    if(count($clientsStatus) < 1):
?>
                                <tr>
                                    <td colspan="6">Aucun enregistrement</td>
                                </tr>
<?php
    endif;
    // Parcours tous les clients
    foreach($clientsStatus as $clientStatus): 
?>
                                <tr>
                                    <td><?php echo $clientStatus->getName(); ?></td>
                                    <td style="text-align:center;white-space:nowrap"><a href="update-<?php echo($clientStatus->getId()); ?>.html" class="btn btn-sm btn-default"><i class="fa fa-edit"></i></a>&nbsp;<a href="delete-<?php echo($clientStatus->getId()); ?>.html" class="btn btn-sm btn-default" onclick="return confirmDelete('ce client');"><i class="fa fa-eraser"></i></a></td>
                                </tr>
<?php 
    endforeach; 
?>
                            </tbody>
                        </table>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>
            <div class="row">
                <div class="txt-center">
<?php
    $pagination->display();
?>
                </div>
            </div>