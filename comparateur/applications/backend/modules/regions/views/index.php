            <div class="row">   
                <div class="panel panel-default">
                    <div class="panel-heading">Liste des régions</div>
                    <div class="panel-body">
                        <a href="/comparateur/admin/regions/insert.html" class="btn btn-sm btn-default">Ajouter une région</a>
                        <br/>
                        <br/>                    
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="col-md-2 col-sm-2 col-xs-2">Numéro postal</th>
                                    <th class="col-md-8 col-sm-8 col-xs-8">Localite</th>
                                    <th class="col-md-1 col-sm-1 col-xs-1 txt-center">Canton</th>
                                    <th class="col-md-1 col-sm-1 col-xs-1 txt-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    if(count($regions) < 1):
?>
                            <tr>
                                <td colspan="4">Aucun enregistrement</td>
                            </tr>
<?php
    endif;
    // Parcours toutes les régions
    foreach($regions as $region): 
?>
                            <tr>
                                <td><?php echo $region->getNpa(); ?></td>
                                <td><?php echo $region->getLocalite(); ?></td>
                                <td class="txt-center"><?php echo $region->getCanton(); ?></td>
                                <td style="text-align:center;white-space:nowrap"><a href="update-<?php echo($region->getId()); ?>.html" class="btn btn-sm btn-default"><i class="fa fa-edit"></i></a>&nbsp;<a href="delete-<?php echo($region->getId()); ?>.html" class="btn btn-sm btn-default" onclick="return confirmDelete('cette région');"><i class="fa fa-eraser"></i></a></td>
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