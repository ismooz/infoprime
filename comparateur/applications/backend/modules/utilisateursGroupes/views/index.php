            <div class="row">    
                <div class="panel panel-default">
                    <div class="panel-heading">Liste des états demande de contacts</div>
                    <div class="panel-body">
                        <a href="/comparateur/admin/utilisateursGroupes/insert.html" class="btn btn-sm btn-default">Ajouter un groupe d'utilisateurs</a>
                        <br/>
                        <br/>
                        <table class="table table-striped table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th class="col-lg-11 col-md-11 col-sm-11 col-xs-11">Nom</th>
                                    <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 txt-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    // Vérifie qu'il y ait un groupe d'utilisateurs
    if(count($utilisateursGroupes) < 1):
?>
                                <tr>
                                    <td colspan="6">Aucun enregistrement</td>
                                </tr>
<?php
    endif;
    // Parcours tous les groupes d'utilisateurs
    foreach($utilisateursGroupes as $utilisateurGroupe): 
?>
                                <tr>
                                    <td><?php echo $utilisateurGroupe->getName(); ?></td>
                                    <td style="text-align:center;white-space:nowrap"><a href="update-<?php echo($utilisateurGroupe->getId()); ?>.html" class="btn btn-sm btn-default"><i class="fa fa-edit"></i></a>&nbsp;<a href="delete-<?php echo($utilisateurGroupe->getId()); ?>.html" class="btn btn-sm btn-default" onclick="return confirmDelete('cet groupe d\'utilisateurs');"><i class="fa fa-eraser"></i></a></td>
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