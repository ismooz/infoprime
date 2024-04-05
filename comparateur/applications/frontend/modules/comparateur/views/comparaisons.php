            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Mes demandes</div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th class="col-md-1 col-sm-1 col-xs-1 txt-center">Date</th>
                                    <th class="col-md-8 col-sm-8 col-xs-8">Assurance</th>
                                    <th class="col-md-1 col-sm-1 col-xs-1 txt-center">Tarif</th>
                                    <th class="col-md-2 col-sm-2 col-xs-2">Primes</th>
                                    <th class="col-md-1 col-sm-1 col-xs-1 txt-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    // Parcours le comparaisons
    foreach($comparaisons as $comparaison):
?>
                                <tr>
                                    <td class="txt-center">25.04.2015</td>
                                    <td>Assura</td>
                                    <td class="txt-center">TAR_BASE</td>
                                    <td class="txt-right">234.40</td>
                                    <td style="text-align:center;white-space:nowrap"><a href="" class="btn btn-default"><i class="fa fa-edit"></i></a>&nbsp;<a href="" class="btn btn-default" onclick="return confirmDelete('Cette comparaison');"><i class="fa fa-eraser"></i></a></td>
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
    $sql = 'SELECT COUNT(*) as total FROM courtiers';
    $pagination = new library\pagination($sql, 10, 1, '/comparateur/comparateur/comparaisons/');
    $pagination->display();
?>
                </div>                    
            </div>
                   