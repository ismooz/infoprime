            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Liste des utilisateurs</div>
                    <div class="panel-body">
                        <a href="/comparateur/admin/utilisateurs/insert.html" class="btn btn-sm btn-default">Ajouter un utilisateur</a>
                        <br/>
                        <br/>
                        <table class="table table-striped table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th class="col-md-4 col-sm-4 col-xs-4">Login</th>
                                    <th class="col-md-4 col-sm-4 col-xs-4">Password</th>
                                    <th class="col-md-2 col-sm-2 col-xs-2">Groupe</th>
                                    <th class="col-md-1 col-sm-1 col-xs-1 txt-center">Etat</th>
                                    <th class="col-md-1 col-sm-1 col-xs-1 txt-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    // Vérifie qu'un client existe
    if(count($utilisateurs) < 1):
?>
                                <tr>
                                    <td colspan="6">Aucun enregistrement</td>
                                </tr>
<?php
    endif;
    // Parcours tous les utilisateurs
    foreach($utilisateurs as $utilisateur): 
?>
                                <tr>
                                    <td><?php echo $utilisateur->getLogin(); ?></td>
                                    <td><?php echo $utilisateur->getPassword(); ?></td>
                                    <td><?php echo $utilisateur->getUtilisateurGroupeName(); ?></td>
                                    <td class="txt-center"><?php echo $utilisateur->getState()?'Actif':'Inactif'; ?></td>
                                    <td style="text-align:center;white-space:nowrap"><a href="update-<?php echo($utilisateur->getId()); ?>.html" class="btn btn-sm btn-default"><i class="fa fa-edit"></i></a>&nbsp;<a href="delete-<?php echo($utilisateur->getId()); ?>.html" class="btn btn-sm btn-default" onclick="return confirmDelete('cet utilisateur');"><i class="fa fa-eraser"></i></a></td>
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
