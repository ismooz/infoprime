            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Liste des assureurs</div>
                    <div class="panel-body">
                        <a href="/comparateur/admin/assureurs/insert.html" class="btn btn-sm btn-default">Ajouter un assureur</a>
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
    if(count($assureurs) < 1):
?>
                            <tr>
                                <td colspan="5">Aucun enregistrement</td>
                            </tr>
<?php
    endif;
    // Parcours toutes les langues
    foreach($assureurs as $assureur): 
?>
                            <tr>
                                <td><?php echo $assureur->getName(); ?></td>
                                <td style="text-align:center;white-space:nowrap"><a href="/comparateur/admin/assureurs/update-<?php echo($assureur->getId()); ?>.html" class="btn btn-sm btn-default"><i class="fa fa-edit"></i></a>&nbsp;<a href="/comparateur/admin/assureurs/delete-<?php echo($assureur->getId()); ?>.html" class="btn btn-sm btn-default" onclick="return confirmDelete('cette langue');"><i class="fa fa-eraser"></i></a></td>
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