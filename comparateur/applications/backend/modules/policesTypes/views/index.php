            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Liste des types de polices</div>
                    <div class="panel-body">
                        <a href="/comparateur/admin/policesTypes/insert.html" class="btn btn-sm btn-default">Ajouter un type de police</a>
                        <br/>
                        <br/>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="col-md-11 col-sm-11 col-xs-11">Nom</th>
                                    <th class="col-md-1 col-sm-1 col-xs-1 txt-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    // Vérifie qu'un type de police existe
    if(count($policesTypes) < 1): 
?>
                                <tr>
                                    <td colspan="5" class="txt-center">Aucun enregistrement</td>
                                </tr>
<?php
    endif;
    // Parcours tous les types de polices
    foreach($policesTypes as $policeType): 
?>
                                <tr>
                                    <td><?php echo $policeType->getName(); ?></td>
                                    <td style="text-align:center;white-space:nowrap"><a href="update-<?php echo($policeType->getId()); ?>.html" class="btn btn-sm btn-default"><i class="fa fa-edit"></i></a>&nbsp;<a href="delete-<?php echo($policeType->getId()); ?>.html" class="btn btn-sm btn-default" onclick="return confirmDelete('ce type de police');"><i class="fa fa-eraser"></i></a></td>
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