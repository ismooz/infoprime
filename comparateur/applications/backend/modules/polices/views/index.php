            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Liste des polices</div>
                    <div class="panel-body">
                        <a href="/comparateur/admin/polices/insert.html" class="btn btn-sm btn-default">Ajouter une police</a>
                        <br/>
                        <br/>                    
                        <table class="table table-striped table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th class="col-md-2 col-sm-2 col-xs-2">Assureur</th>
                                    <th class="col-md-3 col-sm-3 col-xs-3">Conseiller</th>
                                    <th class="col-md-2 col-sm-2 col-xs-2">Type</th>
                                    <th class="col-md-2 col-sm-2 col-xs-2">Police</th>
                                    <th class="col-md-2 col-sm-2 col-xs-2">Prime</th>
                                    <th class="col-md-1 col-sm-1 col-xs-1 txt-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    if(count($polices) < 1):
?>
                                <tr>
                                    <td colspan="5">Aucun enregistrement</td>
                                </tr>
<?php
    endif;
    // Parcours toutes les nationalités
    foreach($polices as $police): 
?>
                                <tr>
                                    <td><?php echo $police->getAssureurName(); ?></td>
                                    <td><?php echo $police->getConseillerName(); ?></td>
                                    <td><?php echo $police->getPoliceTypeName(); ?></td>
                                    <td><?php echo $police->getPolice(); ?></td>
                                    <td><?php echo $police->getPrime(); ?></td>
                                    <td style="text-align:center;white-space:nowrap"><a href="update-<?php echo($police->getId()); ?>.html" class="btn btn-sm btn-default"><i class="fa fa-edit"></i></a>&nbsp;<a href="delete-<?php echo($police->getId()); ?>.html" class="btn btn-sm btn-default" onclick="return confirmDelete('cette police');"><i class="fa fa-eraser"></i></a></td>
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
    // Affiche la pagination
    $pagination->display();
?>  
                </div>
            </div>