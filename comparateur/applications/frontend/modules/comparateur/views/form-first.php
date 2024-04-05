            <div class="panel panel-default">
                <div class="panel-heading">
                    Assurance maladie de base
                </div>
                <div class="box-body">
                    <p>Comparez les primes vite et bien et payez moins d'assurance maladie, tous les mois</p>
                    <form action="index.php?page=form-second" method="post" class="form-maladie" onsubmit="return checkFirstSubmission();">
                        <fieldset class="col_3">
                            <label id="label_naissance" for="naissance" class="bold">Année de naissance</label><br/>
                            <input type="text" name="dateNaissance" id="dateNaissance" maxlength="4" placeholder="Année" class="petit txt-center" onblur="calculAge(this.value, 'age');" />
                            <span id="age"></span>
                        </fieldset>
                        <fieldset class="col_3">
                            <label id="label_npa" for="npa" class="bold">Numéro postal</label><br/>
                            <input type="text" name="adresse" id="adresse" placeholder="NPA ou localité" />
                            <input type="hidden" id="region" name="idRegion" value="" />
                            <div class="autocomplete-suggestions-container" id="suggestions-container"></div>
                            <div class="clear"></div>
                        </fieldset>
                        <fieldset class="col_3">
                            <input type="submit" id="submit" value="Valider" class="btn btn-default" />
                        </fieldset>                        
                        <div class="clear"></div>                        
                        <div id="error" class="error txt-center"></div>
                    </form>
                </div>
                <div class="panel-footer"></div>
            </div>