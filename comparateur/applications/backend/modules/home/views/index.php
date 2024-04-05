            <div class="box box-default box-theme-default">
                <div class="box-header">Accueil</div>
                <div class="box-body">
                    <h3>Demandes de contact</h3>
                    <p>Vous avez <?php echo($nbContacts > 1?'<strong>' . $nbContacts . '</strong> demandes':'<strong>' . $nbContacts . '</strong> demande'); ?> de contact en attente.</p>
                    <br/>
                    <br/>
                    <div id="chart" class="col_2"></div>
                    <div id="chart2" class="col_2"></div>
                    <div class="clear"></div>
                </div>
                <div class="box-footer"></div>
            </div>