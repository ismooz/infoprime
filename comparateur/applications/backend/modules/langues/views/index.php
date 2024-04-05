            <div class="row">    
                <div class="panel panel-default">
                    <div class="panel-heading">Liste des langues</div>
                    <div class="panel-body">
                        <a href="/comparateur/admin/langues/insert.html" class="btn btn-sm btn-default">Ajouter une langue</a>
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
    if(count($langues) < 1):
?>
                                <tr>
                                    <td colspan="5">Aucun enregistrement</td>
                                </tr>
<?php
    endif;
    // Parcours toutes les langues
    foreach($langues as $langue): 
?>
                                <tr>
                                    <td><?php echo $langue->getNameDe(); ?></td>
                                    <td><?php echo $langue->getNameEn(); ?></td>
                                    <td><?php echo $langue->getNameFr(); ?></td>
                                    <td><?php echo $langue->getNameIt(); ?></td>
                                    <td style="text-align:center;white-space:nowrap"><a href="update-<?php echo($langue->getId()); ?>.html" class="btn btn-sm btn-default"><i class="fa fa-edit"></i></a>&nbsp;<a href="delete-<?php echo($langue->getId()); ?>.html" class="btn btn-sm btn-default" onclick="return confirmDelete('cette langue');"><i class="fa fa-eraser"></i></a></td>
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