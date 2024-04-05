            <div class="row">
                <div class="box box-default box-theme-default">
                    <div class="box-header">Paramètres de l'application</div>
                    <div class="box-body">
                        <form action="" method="post" id="parametres">
                            <h3>Authentification</h3>
                            <label class="block">Nombre d'echecs d'authentifications</label>
                            <input type="range" name="loginTentatives" min="0" max="10" value="3" />
                            <label class="block">Délai de bloquage du compte</label>
                            <input type="range" name="loginTentatives" min="0" max="24" value="1" />
                            <h3>Journalisation</h3>
                            <div class="slide">	
                                <input type="checkbox" id="journalApplication" name="journalApplication" />    
                                <label class="button" for="journalApplication"></label>
                                <label class="txt">Journal d'application</label>
                            </div>
                            <br/>
                            <div class="slide">	
                                <input type="checkbox" id="journalSecurite" name="journalSecurite" />    
                                <label class="button" for="journalSecurite"></label>
                                <label class="txt">Journal de securité</label>
                            </div>         
                            <h3>Maintenance</h3>
                            <div class="slide">	
                                <input type="checkbox" id="maintenance" name="maintenance" />    
                                <label class="button" for="maintenance"></label>
                                <label class="txt">Définir l'application en maintenance</label>
                            </div>
                            <br/>
                            <div class="slide">	
                                <input type="checkbox" id="debug" name="debug" />    
                                <label class="button" for="debug"></label>
                                <label class="txt">Debugger l'application</label>
                            </div>
                            <h3>Sécurité</h3>
                            <div class="slide">	
                                <input type="checkbox" id="crypt" name="crypt" onchange="setDisabled('cryptKey', 'Insérer une clé de cryptage');" />    
                                <label class="button" for="crypt"></label>
                                <label class="txt">Crypté les mot de passes</label>
                            </div>
                            <label class="block">Clé de cryptage</label>
                            <input type="text" name="cryptKey" id="cryptKey" disabled="disabled" class="input-default" />
                        </form>
                    </div>
                    <div class="box-footer"></div>
                </div>
            </div>