            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Liste des nationalités</div>
                    <div class="panel-body">
                        <a href="/comparateur/admin/nationalites/insert.html" class="btn btn-sm btn-default">Ajouter une nationalité</a>
                        <br/>
                        <br/>                    
                        <table class="table table-striped table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th>Allemand</th>
                                    <th>Anglais</th>
                                    <th>Français</th>
                                    <th>Italien</th>
                                    <th class="action">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    if(count($nationalites) < 1):
?>
                                <tr>
                                    <td colspan="5">Aucun enregistrement</td>
                                </tr>
<?php
    endif;
    // Parcours toutes les nationalités
    foreach($nationalites as $nationalite): 
?>
                                <tr>
                                    <td><?php echo $nationalite->getNameDe(); ?></td>
                                    <td><?php echo $nationalite->getNameEn(); ?></td>
                                    <td><?php echo $nationalite->getNameFr(); ?></td>
                                    <td><?php echo $nationalite->getNameIt(); ?></td>
                                    <td style="text-align:center;white-space:nowrap"><a href="update-<?php echo($nationalite->getId()); ?>.html" class="btn btn-sm btn-default"><i class="fa fa-edit"></i></a>&nbsp;<a href="delete-<?php echo($nationalite->getId()); ?>.html" class="btn btn-sm btn-default" onclick="return confirmDelete('cette nationalité');"><i class="fa fa-eraser"></i></a></td>
                                </tr>
<?php 
    endforeach; 
?>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer"></div>
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