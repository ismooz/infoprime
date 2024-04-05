            <div class="row">    
                <div class="panel panel-default">
                    <div class="panel-heading">Liste des primes</div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>assureurId</th>
                                    <th>Canton</th>
                                    <th>Exercice</th>
                                    <th>Enquête</th>
                                    <th>Région</th>
                                    <th>Classe d'age</th>
                                    <th>Accident</th>
                                    <th>Tarif</th>
                                    <th>Tarif-type</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    // Vérifie qu'il y ait des primes
    if(count($primes) < 1):
?>
                                <tr>
                                    <td colspan="9">Aucun enregistrement</td>
                                </tr>
<?php
    endIf;
    // Parcours toutes les primes
    foreach($primes as $prime):
?>
                                <tr>
                                    <td><?php echo $prime->getAssureurId(); ?></td>
                                    <td><?php echo $prime->getCanton(); ?></td>
                                    <td><?php echo $prime->getExercice(); ?></td>
                                    <td><?php echo $prime->getEnquete(); ?></td>
                                    <td><?php echo $prime->getRegion(); ?></td>
                                    <td><?php echo $prime->getClasseAge(); ?></td>
                                    <td><?php echo $prime->getAccident(); ?></td>
                                    <td><?php echo $prime->getTarif(); ?></td>
                                    <td><?php echo $prime->getTarifType(); ?></td>
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