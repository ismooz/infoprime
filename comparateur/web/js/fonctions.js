/**
 * calculAge() - 
 * @param {type} naissance
 * @param {type} element
 * @returns {Boolean}
 */
function calculAge(naissance, element){
    if(naissance === ''){
        jQuery('#' + element).text('');
        return false;
    }
    var dateCourante = new Date().getFullYear();
    var age = dateCourante - naissance;
    if(age > 0){
        jQuery('#' + element).text('Vous avez ' + age + ' ans');
    } else if(age === 0) {
        jQuery('#' + element).text('Année de naissance');
    } else {
        jQuery('#' + element).text('Vous aurez ' + -age + ' ans');
    }
}

function calculDateFirst(sDate, element){
    var dt = new Date();
    if(sDate.substr(3,2) === '12'){
        dt.setDate(1);
        dt.setMonth(0);
        dt.setFullYear(parseInt(sDate.substr(6,4)) + 1);
    }else{
        dt.setDate(1);
        dt.setMonth(parseInt(sDate.substr(3,2), 10));
        dt.setFullYear(sDate.substr(6,4));        
    }
    document.getElementById(element).value = (dt.getDate()<10?'0' + dt.getDate():dt.getDate()) + '/' + ((parseInt(dt.getMonth(), 10) + 1)<10?'0' + (parseInt(dt.getMonth(), 10) + 1):parseInt(dt.getMonth(), 10) + 1) + '/' + dt.getFullYear();
}

function checkAnimaux(){
    var nom = document.getElementById('nom');
    var dtNaissance = document.getElementById('dtNaissance');
    var dtAssurance = document.getElementById('dtAssurance');    
    var errorMsg = '';
    var error = false;
    
    if(nom.value === ''){
        document.getElementById('lblNom').style.color = 'red';
        nom.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblNom').style.color = 'black';
        nom.style.color = 'black';
    } 
    
    if(dtNaissance.value === ''){
        document.getElementById('lblDateNaissance').style.color = 'red';
        dtNaissance.style.color = 'red';
        error = true;
    }else{
        var dateNow = new Date();
        var sdateNaissance = document.getElementById('dtNaissance').value;
        var dateNaissance = new Date();
        dateNaissance.setFullYear(sdateNaissance.substr(6,4));
        dateNaissance.setMonth(parseInt(sdateNaissance.substr(3,2)) -1);
        dateNaissance.setDate(sdateNaissance.substr(0,2));
        dateNaissance.setHours(0);
        dateNaissance.setMinutes(0);
        dateNaissance.setSeconds(0);
        dateNaissance.setMilliseconds(0);
        if(dateNaissance.getTime() < dateNow.getTime()){
            document.getElementById('lblDateNaissance').style.color = 'red';
            dtNaissance.style.color = 'red';
            errorMsg = 'Il n\'est pas possible de conclure une assurance pour un animal qui n\'est pas né';
            error = true;            
        }else{
            document.getElementById('lblDateNaissance').style.color = 'black';
            dtNaissance.style.color = 'black';
            
            if(dtAssurance.value === ''){
                document.getElementById('lblDateAssurance').style.color = 'red';
                dtAssurance.style.color = 'red';
                error = true;
            }else{
                var sdate1 = document.getElementById('dtNaissance').value;
                var date1 = new Date();
                if(sdate1.substr(3,2) === '12'){
                    date1.setDate(1);
                    date1.setMonth(0);
                    date1.setFullYear(parseInt(sdate1.substr(6,4)) + 1);
                }else{
                    date1.setDate(1);
                    date1.setMonth(parseInt(sdate1.substr(3,2), 10));
                    date1.setFullYear(sdate1.substr(6,4));        
                }
                date1.setHours(0);
                date1.setMinutes(0);
                date1.setSeconds(0);
                date1.setMilliseconds(0);
                var d1 = date1.getTime();

                var sdate2 = document.getElementById('dtAssurance').value;
                var date2 = new Date();
                date2.setFullYear(sdate2.substr(6,4));
                date2.setMonth(parseInt(sdate2.substr(3,2)) -1);
                date2.setDate(sdate2.substr(0,2));
                date2.setHours(0);
                date2.setMinutes(0);
                date2.setSeconds(0);
                date2.setMilliseconds(0);
                var d2 = date2.getTime();

                if(d1>d2){        
                    document.getElementById('lblDateAssurance').style.color = 'red';
                    dtAssurance.style.color = 'red';
                    errorMsg = 'La date doit être supèrieur au mois suivant de la date de naissance';
                    error = true;        
                }else{
                    document.getElementById('lblDateAssurance').style.color = 'black';
                    dtAssurance.style.color = 'black';
                }
            }
        }
    } 
    
   

    if(error){
        document.getElementById('errorAnimaux').style.display = 'block';
        if(errorMsg !== ''){
            document.getElementById('errorAnimaux').innerHTML = errorMsg;
        }else{
            document.getElementById('errorAnimaux').innerHTML = 'Veuillez corriger les champs en rouge';
        }
        return false;
    }else{    
        return true;
    }    
}

function checkAssureur(){
    var nom = document.getElementById('nom');
    var adresse = document.getElementById('adresse');
    var npa = document.getElementById('npa');
    var localite = document.getElementById('localite');
    var cp = document.getElementById('cp');
    var tel = document.getElementById('tel');
    var fax = document.getElementById('fax');
    var site = document.getElementById('site');
    var preffered = document.getElementById('preffered');
    var sousCaisse = document.getElementById('sousCaisse');
    var status = document.getElementById('status');
    var error = false;
    
    if(nom.value === ''){
        document.getElementById('lblNom').style.color = 'red';
        nom.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblNom').style.color = 'black';
        nom.style.color = 'black';
    }
    
    if(adresse.value === ''){
        document.getElementById('lblAdresse').style.color = 'red';
        adresse.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblAdresse').style.color = 'black';
        adresse.style.color = 'black';
    }
    
    if(npa.value === ''){
        document.getElementById('lblNpa').style.color = 'red';
        npa.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblNpa').style.color = 'black';
        npa.style.color = 'black';        
    }
    
    if(localite.value === ''){
        document.getElementById('lblLocalite').style.color = 'red';
        localite.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblLocalite').style.color = 'black';
        localite.style.color = 'black';        
    }
    
    if(tel.value === ''){
        document.getElementById('lblTel').style.color = 'red';
        tel.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblTel').style.color = 'black';
        tel.style.color = 'black';        
    }
    
    if(preffered.value === '-1' || isNaN(preffered.value)){
        document.getElementById('lblPreffered').style.color= 'red';
        preffered.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblPreffered').style.color= 'black';
        preffered.style.color = 'black';        
    }
    
    if(status.value === '-1' || isNaN(status.value)){
        document.getElementById('lblStatus').style.color = 'red';
        status.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblStatus').style.color = 'black';
        status.style.color = 'black';        
    }
    
    if(error){
        document.getElementById('error').style.display = 'block';
        return false;
    }else{    
        return true;
    }
}

function checkConseiller(){
    var nom = document.getElementById('nom');
    var prenom = document.getElementById('prenom');
    var adresse = document.getElementById('adresse');
    var npa = document.getElementById('npa');
    var localite = document.getElementById('localite');
    var email = document.getElementById('email');
    var status = document.getElementById('status');
    var error = false;
    
    if(nom.value === ''){
        document.getElementById('lblNom').style.color = 'red';
        nom.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblNom').style.color = 'black';
        nom.style.color = 'black';        
    }
    
    if(prenom.value === ''){
        document.getElementById('lblPrenom').style.color = 'red';
        prenom.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblPrenom').style.color = 'black';
        prenom.style.color = 'black';        
    }
    
    if(adresse.value === ''){
        document.getElementById('lblAdresse').style.color = 'red';
        adresse.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblAdresse').style.color = 'black';
        adresse.style.color = 'black';        
    }
    
    if(npa.value === ''){
        document.getElementById('lblNpa').style.color = 'red';
        npa.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblNpa').style.color = 'black';
        npa.style.color = 'black';        
    }
    
    if(localite.value === ''){
        document.getElementById('lblLocalite').style.color = 'red';
        localite.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblLocalite').style.color = 'black';
        localite.style.color = 'black';        
    }
    
    if(status.value === '-1' || isNaN(status.value)){
        document.getElementById('lblStatus').style.color = 'red';
        status.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblStatus').style.color = 'black';
        status.style.color = 'black';        
    }
    
    if(error){
        document.getElementById('error').style.display = 'block';
        return false;
    }else{
        return true;
    }
}

function checkDivision(){
    var nom = document.getElementById('nom');
    var status = document.getElementById('status');
    var error = false;
    
    if(nom.value === ''){
        document.getElementById('lblNom').style.color = 'red';
        nom.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblNom').style.color = 'black';
        nom.style.color = 'black';        
    }
    
    if(status.value === '-1'){
        document.getElementById('lblStatus').style.color = 'red';
        status.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblStatus').style.color = 'black';
        status.style.color = 'black';        
    }
    
    if(error){
        document.getElementById('error').style.display = 'block';
        return false;
    }else{
        return true;
    }    
}

function checkLangue(){
    var nom = document.getElementById('nom');
    var status = document.getElementById('status');
    var error = false;
    
    if(nom.value === ''){
        document.getElementById('lblNom').style.color = 'red';
        nom.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblNom').style.color = 'black';
        nom.style.color = 'black';        
    }
    
    if(status.value === '-1'){
        document.getElementById('lblStatus').style.color = 'red';
        status.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblStatus').style.color = 'black';
        status.style.color = 'black';        
    }
    
    if(error){
        document.getElementById('error').style.display = 'block';
        return false;
    }else{
        return true;
    }     
}

function checkNationalite(){
    var nom = document.getElementById('nom');
    var priorite = document.getElementById('priorite');
    var status = document.getElementById('status');
    var error = false;
    
    if(nom.value === ''){
        document.getElementById('lblNom').style.color = 'red';
        nom.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblNom').style.color = 'black';
        nom.style.color = 'black';        
    }
    
    if(priorite.value === '-1'){
        document.getElementById('lblPriorite').style.color = 'red';
        priorite.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblPriorite').style.color = 'black';
        priorite.style.color = 'black';        
    }
    
    if(status.value === '-1'){
        document.getElementById('lblStatus').style.color = 'red';
        status.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblStatus').style.color = 'black';
        status.style.color = 'black';        
    }
    
    if(error){
        document.getElementById('error').style.display = 'block';
        return false;
    }else{
        return true;
    }     
}

function checkOffre(){
    var userId = document.getElementById('userId');
    var assureurActuelId = document.getElementById('assureurActuelId');
    var assureurOffreId = document.getElementById('assureurOffreId');
    var suivisId = document.getElementById('suivisId');
    var ip = document.getElementById('ip');
    var primeActuelle = document.getElementById('primeActuelle');
    var primeNouvelleOffre = document.getElementById('primeNouvelleOffre');
    var tarif = document.getElementById('tarif');
    var tarifType = document.getElementById('tarifType');
    var modelStandard = document.getElementById('modelStandard');
    var modelMf = document.getElementById('modelMf');
    var modelHmo = document.getElementById('modelHmo');
    var modelTelmed = document.getElementById('modelTelmed');
    var modelAutre = document.getElementById('modelAutre');
    var status = document.getElementById('status');
    var error = false;

    if(userId.value === '-1'){
        document.getElementById('lblUserId').style.color = 'red';
        userId.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblUserId').style.color = 'black';
        userId.style.color = 'black';       
    }
    
    if(assureurActuelId.value === '-1'){
        document.getElementById('lblAssureurActuelId').style.color = 'red';
        assureurActuelId.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblAssureurActuelId').style.color = 'black';
        assureurActuelId.style.color = 'black';        
    }
    
    if(assureurOffreId.value === '-1'){
        document.getElementById('lblAssureurOffreId').style.color = 'red';
        assureurOffreId.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblAssureurOffreId').style.color = 'black';
        assureurOffreId.style.color = 'black';        
    }
    
    if(suivisId.value === '-1'){
        document.getElementById('lblSuivisId').style.color = 'red';
        suivisId.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblSuivisId').style.color = 'black';
        suivisId.style.color = 'black';        
    }
    
    if(ip.value === ''){
        document.getElementById('lblIp').style.color = 'red';
        ip.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblIp').style.color = 'black';
        ip.style.color = 'black';        
    }
    
    if(primeActuelle.value === '' || isNaN(primeActuelle.value)){
        document.getElementById('lblPrimeActuelle').style.color = 'red';
        primeActuelle.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblPrimeActuelle').style.color = 'black';
        primeActuelle.style.color = 'black';        
    }
    
    if(primeNouvelleOffre.value === '' || isNaN(primeNouvelleOffre.value)){
       document.getElementById('lblPrimeNouvelleOffre').style.color = 'red';
       primeNouvelleOffre.style.color = 'red';
       error = true;
    }else{
       document.getElementById('lblPrimeNouvelleOffre').style.color = 'black';
       primeNouvelleOffre.style.color = 'black';        
    }
    
    if(tarif.value === ''){
        document.getElementById('lblTarif').style.color = 'red';
        tarif.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblTarif').style.color = 'black';
        tarif.style.color = 'black';        
    }
    
    if(tarifType.value ===''){
        document.getElementById('lblTarifType').style.color = 'red';
        tarifType.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblTarifType').style.color = 'black';
        tarifType.style.color = 'black';       
    }
    
    if(modelStandard.checked === false && modelMf.checked === false && modelHmo.checked === false && modelTelmed.checked === false && modelAutre.checked === false){
        document.getElementById('lblModels').style.color = 'red';
        document.getElementById('lblModelStandard').style.color = 'red';
        document.getElementById('lblModelMf').style.color = 'red';
        document.getElementById('lblModelHmo').style.color = 'red';
        document.getElementById('lblModelTelmed').style.color = 'red';
        document.getElementById('lblModelAutre').style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblModels').style.color = 'black';
        document.getElementById('lblModelStandard').style.color = 'black';
        document.getElementById('lblModelMf').style.color = 'black';
        document.getElementById('lblModelHmo').style.color = 'black';
        document.getElementById('lblModelTelmed').style.color = 'black';
        document.getElementById('lblModelAutre').style.color = 'black';       
    }
    
    if(status.value === '-1'){
        document.getElementById('lblStatus').style.color = 'red';
        status.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblStatus').style.color = 'black';
        status.style.color = 'black';        
    }
    
    if(error){
        document.getElementById('error').style.display = 'block';
        return false;
    }else{
        return true;
    }
}

function checkPrime(){
    var assureurId = document.getElementById('assureurId');
    var canton = document.getElementById('canton');
    var exercice = document.getElementById('exercice');
    var enquete = document.getElementById('enquete');
    var region = document.getElementById('region');
    var classeAge = document.getElementById('classeAge');
    var accident = document.getElementById('accident');
    var tarif = document.getElementById('tarif');
    var tarifType = document.getElementById('tarifType');
    var groupeAge = document.getElementById('groupeAge');
    var etatFranchise = document.getElementById('etatFranchise');
    var franchise = document.getElementById('franchise');
    var prime = document.getElementById('prime');
    var sorte = document.getElementById('sorte');
    var estBaseP = document.getElementById('estBaseP');
    var estBaseF = document.getElementById('estBaseF');
    var nomTarif = document.getElementById('nomTarif');
    var status = document.getElementById('status');
    var error = false;
    
    if(assureurId.value === '-1'){
        document.getElementById('lblAssureurId').style.color = 'red';
        assureurId.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblAssureurId').style.color = 'black';
        assureurId.style.color = 'black';        
    }
    
    if(canton.value === ''){
        document.getElementById('lblCanton').style.color = 'red';
        canton.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblCanton').style.color = 'black';
        canton.style.color = 'black';        
    }
    
    if(exercice.value === ''){
        document.getElementById('lblExercice').style.color = 'red';
        exercice.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblExercice').style.color = 'black';
        exercice.style.color = 'black';        
    }
    
    if(enquete.value === ''){
        document.getElementById('lblEnquete').style.color = 'red';
        enquete.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblEnquete').style.color = 'black';
        enquete.style.color = 'black';        
    }
    
    if(region.value === ''){
        document.getElementById('lblRegion').style.color = 'red';
        region.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblRegion').style.color = 'black';
        region.style.color = 'black';        
    }
    
    if(classeAge.value === ''){
        document.getElementById('lblClasseAge').style.color = 'red';
        classeAge.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblClasseAge').style.color = 'black';
        classeAge.style.color = 'black';        
    }
    
    if(accident.value === ''){
        document.getElementById('lblAccident').style.color = 'red';
        accident.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblAccident').style.color = 'black';
        accident.style.color = 'black';        
    }
    
    if(tarif.value === ''){
        document.getElementById('lblTarif').style.color = 'red';
        tarif.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblTarif').style.color = 'black';
        tarif.style.color = 'black';        
    }
    
    if(tarifType.value === ''){
        document.getElementById('lblTarifType').style.color = 'red';
        tarifType.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblTarifType').style.color = 'black';
        tarifType.style.color = 'black';        
    }
    
    if(groupeAge.value === ''){
        document.getElementById('lblGroupeAge').style.color = 'red';
        groupeAge.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblGroupeAge').style.color = 'black';
        groupeAge.style.color = 'black';        
    }
    
    if(etatFranchise.value === ''){
        document.getElementById('lblEtatFranchise').style.color = 'red';
        etatFranchise.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblEtatFranchise').style.color = 'black';
        etatFranchise.style.color = 'black';       
    }
    
    if(franchise.value === ''){
        document.getElementById('lblFranchise').style.color = 'red';
        franchise.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblFranchise').style.color = 'black';
        franchise.style.color = 'black';        
    }
    
    if(prime.value === '' || isNaN(prime.value)){
        document.getElementById('lblPrime').style.color = 'red';
        prime.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblPrime').style.color = 'black';
        prime.style.color = 'black';        
    }
    
    if(sorte.value === ''){
        document.getElementById('lblSorte').style.color = 'red';
        sorte.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblSorte').style.color = 'black';
        sorte.style.color = 'black';        
    }
    
    if(estBaseP.value === ''){
        document.getElementById('lblEstBaseP').style.color = 'red';
        estBaseP.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblEstBaseP').style.color = 'black';
        estBaseP.style.color = 'black';        
    }
    
    if(estBaseF.value === ''){
        document.getElementById('lblEstBaseF').style.color = 'red';
        estBaseF.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblEstBaseF').style.color = 'black';
        estBaseF.style.color = 'black';
    }
    
    if(nomTarif.value === ''){
        document.getElementById('lblNomTarif').style.color = 'red';
        nomTarif.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblNomTarif').style.color = 'black';
        nomTarif.style.color = 'black';        
    }
    
    if(status.value === '-1'){
        document.getElementById('lblStatus').style.color = 'red';
        status.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblStatus').style.color = 'black';
        status.style.color = 'black';        
    }
    
    if(error){
        document.getElementById('error').style.display = 'block';
        return false;
    }else{
        return true;
    }    
}

function checkRegion(){
    var npa = document.getElementById('npa');
    var localite = document.getElementById('localite');
    var canton = document.getElementById('canton');
    var region = document.getElementById('region');
    var noOfs = document.getElementById('noOfs');
    var commune = document.getElementById('commune');
    var district = document.getElementById('district');
    var status = document.getElementById('status');
    var error = false;
    
    if(npa.value === ''){
        document.getElementById('lblNpa').style.color = 'red';
        npa.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblNpa').style.color = 'black';
        npa.style.color = 'black';        
    }
    
    if(localite.value === ''){
        document.getElementById('lblLocalite').style.color = 'red';
        localite.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblLocalite').style.color = 'black';
        localite.style.color = 'black';        
    }
    
    if(canton.value === ''){
        document.getElementById('lblCanton').style.color = 'red';
        canton.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblCanton').style.color = 'black';
        canton.style.color = 'black';        
    }
    
    if(region.value === '' || isNaN(region.value)){
        document.getElementById('lblRegion').style.color = 'red';
        region.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblRegion').style.color = 'black';
        region.style.color = 'black';        
    }
    
    if(noOfs.value === '' || isNaN(noOfs.value)){
        document.getElementById('lblNoOfs').style.color = 'red';
        noOfs.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblNoOfs').style.color = 'black';
        noOfs.style.color = 'black';        
    }
    
    if(commune.value === ''){
        document.getElementById('lblCommune').style.color = 'red';
        commune.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblCommune').style.color = 'black';
        commune.style.color = 'black';        
    }
    
    if(district.value === ''){
        document.getElementById('lblDistrict').style.color = 'red';
        district.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblDistrict').style.color = 'black';
        district.style.color = 'black';        
    }
    
    if(status.value === '-1' || isNaN(status.value)){
        document.getElementById('lblStatus').style.color = 'red';
        status.style.color = 'red';
        error = true;
    }else{
        document.getElementById('lblStatus').style.color = 'black';
        status.style.color = 'black';        
    }
    
    if(error){
        document.getElementById('error').style.display = 'block';
        return false;
    }else{
        return true;
    }
}

/**
 * checkFristSubmission() -
 * @returns {Boolean}
 */
function checkFirstSubmission(){
    document.getElementById('label_npa').style.color = 'black';
    document.getElementById('label_naissance').style.color = 'black';
    document.getElementById('error').style.display = 'none';
    // Récupère l'année courante
    var anneeCourante = new Date().getFullYear();
	// Récupère la date de naissance
    var naissance = document.getElementById('dateNaissance').value;
    // Vérifie que l'année de naissance soit bien un nombre
    if(naissance === '' || isNaN(naissance)){
        document.getElementById('dateNaissance').value = '';
        document.getElementById('dateNaissance').focus();
        document.getElementById('label_naissance').style.color = 'red';
        document.getElementById('error').innerHTML = 'La date de naissance doit être un nombre !';
        document.getElementById('error').style.display = 'block';
        return false;       
    }    
    // Vérifie que l'année de naissance comporte 4 chiffres
    if(naissance.length !== 4){
        document.getElementById('dateNaissance').value = '';
        document.getElementById('dateNaissance').focus();
        document.getElementById('label_naissance').style.color = 'red';
        document.getElementById('error').innerHTML = 'La date de naissance doit avoir 4 chiffres !';
        document.getElementById('error').style.display = 'block';
        return false;
    }
    // Vérifie que la personne ne soit pas plus agée que 100 ans
    if((anneeCourante - naissance) > 100){
        document.getElementById('dateNaissance').value = '';
        document.getElementById('dateNaissance').focus();
        document.getElementById('label_naissance').style.color = 'red';
        document.getElementById('error').innerHTML = 'Vous avez plus de 100 ans ? Félicitations !';
        document.getElementById('error').style.display = 'block';
        return false;        
    }
    // Vérifie que l'enfant ne naisse pas dans plus de deux ans
    if((anneeCourante - naissance)<-2){
        document.getElementById('dateNaissance').value = '';
        document.getElementById('dateNaissance').focus();
        document.getElementById('label_naissance').style.color = 'red';
        document.getElementById('error').innerHTML = 'Merci de mettre une date correcte !';
        document.getElementById('error').style.display = 'block';
        return false;            
    }
    // Récupère la région
    var region= document.getElementById('region').value;
    // Vérifie que le numéro postal soit bien un nombre
    if(region === ''){
        document.getElementById('adresseFirst').value = '';
        document.getElementById('adresseFirst').focus();
        document.getElementById('label_npa').style.color = 'red';
        document.getElementById('error').innerHTML = 'Veuillez choisir une localité';
        document.getElementById('error').style.display = 'block';
        return false;       
    } 
    // Valide le formulaire
    return true;
}    

/**
 * checkSecondSubmisssion() -
 * @returns {Boolean}
 */
function checkSecondSubmission(){
    
    // Récupération des champs à controller
    var adresseLabel = document.getElementById('lblAdresseFirst');
    var adresse = document.getElementById('adresseFirst');
    var region = document.getElementById('region');
    var assureurLabel = document.getElementById('labelAssureur');
    var assureur = document.getElementById('assureur');
    var modelesCompares = document.getElementById('modelesCompares');
    var standard = document.getElementById('standard');
    var medecinFamille = document.getElementById('medecinFamille');
    var hmo = document.getElementById('hmo');
    var telmed = document.getElementById('telmed');
    var autre = document.getElementById('autre');
    
    // Récupère le nombre d'assurés
    var nbAssures = document.getElementById('nbAssures').value;
   
   // Récupère l'année en cours
    var anneeCourante = new Date().getFullYear();
	
	//Pour les mois d'octobre à décembre on calcul sur l'année suivante 
	var moisCourrant = (new Date().getMonth()+1);
	if (moisCourrant >9 &  moisCourrant < 13){
		anneeCourante++;
	}
    
	// Initialise l'erreur
    var error = false;
   
    // Contrôle du code postal
    if(adresse.value === '' || region.value === ''){
        adresseLabel.style.color = 'red';
        adresse.style.color = 'red';
        error = true;
    }else{
        adresseLabel.style.color = 'black';
        adresse.style.color = 'black';
    }
    
    // Vérifie que l'assureur soit sélectionné
    if(assureur.value === '-1'){
        assureurLabel.style.color = 'red';
        assureur.style.color = 'red';
        error = true;
    }else{
        assureurLabel.style.color = 'black';
        assureur.style.color = 'black';        
    }
        
    // Boucle sur toutes les lignes Personne    
    for(var i=1;i<=nbAssures;i++){
        
        // Récupération des données par ligne
        var anneeNaissanceLabel = document.getElementById('form-group-label-' + i);
        var anneeNaissance = document.getElementById('form-group-input-' + i);
        var franchiseLabel = document.getElementById('form-group-label2-' + i);
        var franchise = document.getElementById('form-group-select-' + i);        
        var accidentLabel = document.getElementById('form-group-legend-' + i);
        var accident_avec = document.getElementById('form-group-radio-avec-' + i);
        var accident_sans = document.getElementById('form-group-radio-sans-' + i);
        
        // Vérification de l'année de naissance
        if(anneeNaissance.value === ''){
            anneeNaissanceLabel.style.color = 'red';
            anneeNaissance.style.color = 'red';
            error = true;
        }else{
            if(anneeNaissance.value.length < 4){
                anneeNaissanceLabel.style.color = 'red';
                anneeNaissance.style.color = 'red';
                error = true;
            }else{
                if((anneeCourante - anneeNaissance.value) > 100){
                    anneeNaissanceLabel.style.color = 'red';
                    anneeNaissance.style.color = 'red'; 
                    error = true;
                }else{
                    if((anneeCourante - anneeNaissance.value) < -2){
                        anneeNaissanceLabel.style.color = 'red';
                        anneeNaissance.style.color = 'red'; 
                        error = true;
                    }else{
                        anneeNaissanceLabel.style.color = 'black';
                        anneeNaissance.style.color = 'black'; 
                    }                   
                }
            }          
        }
        
        // Vérifie la franchise
        if(franchise.disabled === true || franchise.value === '-1'){
            franchiseLabel.style.color = 'red';
            franchise.style.color = 'red';
            error = true;
        }else{
            franchiseLabel.style.color = 'black';
            franchise.style.color = 'black';            
        }
        
        // Vérifie la couverture accident
        if(accident_avec.checked === false && accident_sans.checked === false){
            accidentLabel.style.color = 'red';
            error = true;
        }else{
            accidentLabel.style.color = 'black';
        }
    }
    
    // Vérifie qu'un modes comparés soit sélectionné
    if(standard.checked === false && medecinFamille.checked === false && hmo.checked === false && telmed.checked === false && autre.checked === false){
        modelesCompares.style.color = 'red';
        error = true;
    }else{
        modelesCompares.style.color = 'black';
    }
    
    // Vérifie qu'il n'y ait pas d'erreur
    if(error === true){
        document.getElementById('error').innerHTML = 'Veuillez corriger les champs en rouge';
        document.getElementById('error').style.display = 'block';
        return false;
    } else {
        return true;
    }
}

function checkEmail(element, email){
    if(email === ''){
        $('#check').remove();
        $('#close').remove();        
    }else{
        $.ajax({
            type:'GET',
            url:'/comparateur/library/json/checkEmail.php',
            data:{
                email:email
            },
            dataType:'text',
            success:function(data){
                if(data === 'valide'){
                    $('#check').remove();
                    $('#close').remove();
                    $('#' + element).after('<i id="check" class="fa fa-2x fa-check txt-green"></i>');
                }else{
                    $('#check').remove();
                    $('#close').remove();                
                    $('#' + element).after('<i id="close" class="fa fa-2x fa-close txt-red"></i>');
                }
            }      
        });
    }
}

/**
 * checkFourthSubmisssion() - 
 * @returns {Boolean}
 */
function checkFourthSubmission(){

    var nbAssures = document.getElementById('nbAssures').value;
    var adresse = document.getElementById('adresse');
    var adresseNo = document.getElementById('adresseNo');
    var npa = document.getElementById('adresseFirst');
    var tel = document.getElementById('tel');
    var tel2 = document.getElementById('tel2');
    var mobile = document.getElementById('mobile');
    var email = document.getElementById('email');
    var langue = document.getElementById('langue');
	var cg = document.getElementById('cg');
	var error = false;
    var errorTel = false;
   
    //for(var i=1;i<=nbAssures;i++){
        
        var nom = document.getElementById('nom-' + i);
        var prenom = document.getElementById('prenom');
        var naissance = document.getElementById('naissance-' + i);
        // var sexeMasculin = document.getElementById('sexeMasculin-' + i);
        // var sexeFeminin = document.getElementById('sexeFeminin-' + i);
        // var lamal = document.getElementById('lamal-' + i);
        // var lca = document.getElementById('lca-' + i);
        // var nationalite = document.getElementById('nationalite-' + i);
        // var permis = document.getElementById('permis-' + i);
       
        // Vérifie que le nom soit renseigné
        if(nom.value === ''){
            document.getElementById('lblNom').style.color = 'red';
            nom.style.color = 'red';
            error = true;
        } else {
            document.getElementById('lblNom').style.color = 'black';
            nom.style.color = 'black';        
        }
        // Vérifie que le prénom soit renseigné
        if(prenom.value === ''){
            document.getElementById('lblPrenom').style.color = 'red';
            prenom.style.color = 'red';
            error = true;
        } else {
            document.getElementById('lblPrenom').style.color = 'black';
            prenom.style.color = 'black';        
        } 
		
        // Vérifie que la date de naissance soit renseignée
        if(naissance.value === ''){
            document.getElementById('lblNaissance-' + i).style.color = 'red';
            naissance.style.color = 'red';
            error = true;        
        } else {
            document.getElementById('lblNaissance-' + i).style.color = 'black';
            naissance.style.color = 'black';        
        }
        // Vérifie que le sexe soit renseigné
/*         if(sexeMasculin.checked === false && sexeFeminin.checked === false){
            document.getElementById('lblSexe-' + i).style.color = 'red';
            error = true;        
        } else {
            document.getElementById('lblSexe-' + i).style.color = 'black';      
        }       */  
        // Vérifie qu'une langue soit sélectionnée
        // if(lamal.value === '-1'){
            // document.getElementById('lblLamal-' + i).style.color = 'red';
            // lamal.style.color = 'red';
            // error = true;                
        // } else {
            // document.getElementById('lblLamal-' + i).style.color = 'black';
            // lamal.style.color = 'black';        
        // }        
        // Vérifie que la complémentaire soit sélectionnées 
		// Vérification annulée par IG le 12.10.2016
        /*if(lca.value === '-1'){
            document.getElementById('lblLca-' + i).style.color = 'red';
            lca.style.color = 'red';
            error = true;                
        } else {
            document.getElementById('lblLca-' + i).style.color = 'black';
            lca.style.color = 'black';        
        }*/
        // Vérifie qu'une nationalité soit sélectionnée
        // if(nationalite.value === '-1'){
            // document.getElementById('lblNationalite-' + i).style.color = 'red';
            // nationalite.style.color = 'red';
            // error = true;
        // } else {
            // document.getElementById('lblNationalite-' + i).style.color = 'black';
            // nationalite.style.color = 'black';        
        // }
        // Vérifie qu'un permis soit sélectionné
/*         if(nationalite.value != '98' && nationalite.value != '-1'){
            if(permis.value === '-1'){
                document.getElementById('lblPermis-' + i).style.color = 'red';
                permis.style.color = 'red';
                error = true;               
            }else{
                document.getElementById('lblPermis-' + i).style.color = 'black';
                permis.style.color = 'black';                       
            }
        } */
    //}

    // Vérifie que l'adresse soit renseignée
    if(adresse.value === ''){
        document.getElementById('lblAdresse').style.color = 'red';
        adresse.style.color = 'red';
        error = true;
    } else {
        document.getElementById('lblAdresse').style.color = 'black';
        adresse.style.color = 'black';        
    }

    // Vérifie que le numéro d'adresse soit renseignée
    if(adresseNo.value === ''){
        document.getElementById('lblAdresseNo').style.color = 'red';
        adresseNo.style.color = 'red';
        error = true;
    } else {
        document.getElementById('lblAdresseNo').style.color = 'black';
        adresseNo.style.color = 'black';        
    }

    // Vérifie que le npa soit renseigné
/*     if(npa.value === ''){
        document.getElementById('lblNpa').style.color = 'red';
        npa.style.color = 'red';
        error = true;
    } else {
        document.getElementById('lblNpa').style.color = 'black';
        npa.style.color = 'black';        
    } */
	
    // Vérifie que le téléphone soit renseigné
    if(tel.value === '' && mobile.value === ''){
        document.getElementById('lblTel').style.color = 'red';
        document.getElementById('lblMobile').style.color = 'red';
        tel.style.color = 'red';
        mobile.style.color = 'red';
        errorTel = true;
    } else {
        document.getElementById('lblTel').style.color = 'black';
        document.getElementById('lblMobile').style.color = 'black';
        tel.style.color = 'black';        
    }
    
    // Vérifie que l'adresse mail soit renseignée
    if(email.value === ''){
        document.getElementById('lblEmail').style.color = 'red';
        email.style.color = 'red';
        error = true;
    } else {
        document.getElementById('lblEmail').style.color = 'black';
        email.style.color = 'black';       
    }     
    
    // Vérifie qu'une langue soit sélectionnée
     if(langue.value === '-1'){
        document.getElementById('lblLangue').style.color = 'red';
        langue.style.color = 'red';
        error = true;                
    } else {
        document.getElementById('lblLangue').style.color = 'black';
        langue.style.color = 'black';        
    } 
     	

	 // Vérifie que les conditions générales soient validées
	if(cg.checked ===false){
		document.getElementById('lblCg').style.color = 'red';
		cg.style.color = 'red';
		error = true;
	} else {
		document.getElementById('lblCg').style.color = 'black';
		cg.style.color = 'black';        
	}
    // Vérifie qu'il n'y ait pas d'erreur
    if(error === true){
        document.getElementById('error').innerHTML = 'Veuillez corriger les champs en rouge';
        document.getElementById('error').style.display = 'block';
        return false;
    } else {
        if(errorTel === true){
            document.getElementById('error').innerHTML = 'Veuillez insérer au minimum un moyen telephonique de vous contacter !';
            document.getElementById('error').style.display = 'block';
            return false;
        }
        return true;
    }
}

function checkNaissanceLight( e, f){
	var dateCourante = (new Date().getFullYear());
    
	//Pour les mois d'octobre à décembre on calcul sur l'année suivante 
	var moisCourrant = (new Date().getMonth()+1);
	if (moisCourrant >9 &  moisCourrant < 13){
		dateCourante++;
	}
	//alert(moisCourrant);
    var counter = e.name.substring(e.name.lastIndexOf('-') + 1);
  
    // Vérifie que le champ Ne soit pas vide
    if(e.value === ''){
        document.getElementById('form-group-label').style.color = 'red';
        document.getElementById('form-group-error').innerHTML = 'Veuillez insérer une date !';
   
        return false;
    }
    // Vérifie que l'année de naissance comporte au moins 4 chiffres§ 
    if(e.value.length !== 4){    
        document.getElementById('form-group-label' ).style.color = 'red';
        document.getElementById('form-group-error' ).innerHTML = 'Veuillez insérer une date valide !';
        return false;
    }
	// Vérifie que le client n'a pas plus de 100 ans
    if((dateCourante - e.value) > 120){
        document.getElementById('form-group-label' ).style.color = 'red';
        document.getElementById('form-group-error' ).innerHTML = 'Vous avez plus de 120 ans ? Félicitations !';
        return false;
    } 
	// Vérifie que le client va naître dans l'année
    if((dateCourante - e.value) < -2){
        document.getElementById('form-group-label' ).style.color = 'red';
        document.getElementById('form-group-error' ).innerHTML = 'Merci de mettre une date correcte !';
        return false;
    }

    // Efface l'erreur (champ valide)
    document.getElementById('form-group-label' ).style.color = 'black';
    document.getElementById('form-group-error' ).innerHTML = '';
    return true;
	
}

/**
/**
 * checkNaissance() -
 * @param {type} e
 * @paran {string} franchise
 * @returns {Boolean}
 */
function checkNaissance(e, f){
    var dateCourante = (new Date().getFullYear());
    
	//Pour les mois d'octobre à décembre on calcul sur l'année suivante 
	var moisCourrant = (new Date().getMonth()+1);
	if (moisCourrant >9 &  moisCourrant < 13){
		dateCourante++;
	}
	//alert(moisCourrant);
    var counter = e.name.substring(e.name.lastIndexOf('-') + 1);
    var franchise = document.getElementById('form-group-select-' + counter);
    var accidentAvec = document.getElementById('form-group-radio-avec-' + counter);
    var accidentSans = document.getElementById('form-group-radio-sans-' + counter);
    var primesEnfant = ["0", "100", "200", "300", "400", "500", "600"];
    var primesAdulte = ["300", "500", "1000", "1500", "2000", "2500"];
    
    // Vérifie que le champ de soit pas vide
	// Vérifie que l'année de naissance comporte 4 chiffres
	var	re = /[0-9]{4}/;
	if(! re.exec(e.value)){
		document.getElementById('form-group-label-' + counter).style.color = 'red';
        document.getElementById('form-group-error-' + counter).innerHTML = 'Veuillez insérer une date valide !';
        franchise.disabled = true;
        return false;
	}
		
    if((dateCourante - e.value) > 100){
        document.getElementById('form-group-label-' + counter).style.color = 'red';
        document.getElementById('form-group-error-' + counter).innerHTML = 'Vous avez plus de 100 ans ? Félicitations !';
        franchise.disabled = true;
        return false;
    } 
    if((dateCourante - e.value) < -2){
        document.getElementById('form-group-label-' + counter).style.color = 'red';
        document.getElementById('form-group-error-' + counter).innerHTML = 'Merci de mettre une date correcte !';
        franchise.disabled = true;
        return false;
    }
    // Vérifie l'age pour afficher la franchise
    if((dateCourante - e.value) < 19){
        franchise.options.length = 0;
        var option = document.createElement('option');
        option.text = '- Veuillez sélectionner -';
        option.value = '-1';
        franchise.add(option);
        for(var i=0; i<primesEnfant.length; i++) {
            var option = document.createElement('option');
			if(i==0){f=''}else{f='s'}
            option.text = primesEnfant[i] + ' franc'+f;
            option.value = primesEnfant[i];
			//alert(primesEnfant[i]);
            if(i == 0){
                option.selected = 'selected';
            }
            franchise.add(option);
        }
        accidentAvec.checked = true;
    } else {
        franchise.options.length = 0;
        var option = document.createElement('option');
        option.text = '- Veuillez sélectionner -';
        option.value = '-1';
        franchise.add(option);
        for(var i=0; i<primesAdulte.length; i++) {
			
            var option = document.createElement('option');
            option.text = primesAdulte[i] + ' francs';
            option.value = primesAdulte[i];
            if(i==primesAdulte.length-1){
                option.selected = 'selected';
            }   
            franchise.add(option);
        }
        accidentSans.checked = true;
    }
    // Efface l'erreur (champ valide)
    document.getElementById('form-group-label-' + counter).style.color = 'black';
    document.getElementById('form-group-error-' + counter).innerHTML = '';
    franchise.disabled = false;
    franchise.focus();
    return true;
}

function checkNationality(element, target){
    if(element.value !== '98' && element.value !== '-1'){
        $(target).css({
            display:'block'
        });
    }else{
        $(target).css({
           display:'none' 
        }); 
    }
}

function checkLca(element, target){
    if(element.value !== 'non'){
        $(target).css({
            display:'block'
        });
    }else{
        $(target).css({
           display:'none' 
        }); 
    }
}

function copieDivFormSecond(){
    // Récupère le nombre d'assurés
    var counter = parseInt(document.getElementById('nbAssures').value);
    // Vérifie le nombre maximum d'assurés (10)
    if(counter >= 10){
        alert('10 personnes sont permises !');
        return false;
    }
    // Ajoute un assuré
    counter++;
    // Crée la nouvelle ligne
    var newDiv = $('#form-group-1').clone();
    newDiv.attr('id', 'form-group-' + counter);
    if(counter % 2 === 0){
        newDiv.attr('class', 'subPersonne');
    }
    newDiv.find('#form-group-title-1').attr('id', 'form-group-title-' + counter).html('Personne n° ' + counter);
    newDiv.find('#form-group-label-1').attr('id', 'form-group-label-' + counter).attr('for', 'form-group-input-' + counter).css('color', 'black');
    newDiv.find('#form-group-input-1').attr('name', 'naissance-' + counter).attr('id', 'form-group-input-' + counter);
    newDiv.find('#form-group-input-' + counter).val('');
    newDiv.find('#form-group-error-1').attr('id', 'form-group-error-' + counter).html('');
    newDiv.find('#form-group-label2-1').attr('id', 'form-group-label2-' + counter).attr('for', 'form-group-select-' + counter);
    newDiv.find('#form-group-select-1').attr('name', 'franchise-' + counter).attr('id', 'form-group-select-' + counter).attr('disabled', 'disabled');
    newDiv.find('#form-group-legend-1').attr('id', 'form-group-legend-' + counter);
    newDiv.find('#form-group-radio-avec-1').attr('id', 'form-group-radio-avec-' + counter).attr('name', 'accident-' + counter).removeAttr('checked');
    newDiv.find('#form-group-label3-1').attr('id', 'form-group-label3-' + counter).attr('for', 'form-group-radio-avec-' + counter);
    newDiv.find('#form-group-radio-sans-1').attr('id', 'form-group-radio-sans-' + counter).attr('name', 'accident-' + counter).removeAttr('checked');
    newDiv.find('#form-group-label4-1').attr('id', 'form-group-label4-' + counter).attr('for', 'form-group-radio-avec-' + counter);
    newDiv.find('#form-group-label5-1').attr('id', 'form-group-label5-' + counter).attr('for', 'form-group-radio-sans-' + counter);
    newDiv.fadeIn('500');
    newDiv.appendTo('#form-group');
    document.getElementById('nbAssures').value = counter;
}

function copieChamp(element, target){
    $('#' + target).val($('#' + element).val());
}

/**
 * confirmDelete() -
 * @param {type} $txt - Texte de confirmation
 * @returns {Boolean}
 */
function confirmDelete($txt){
   var result = confirm('Voulez vous vraiment supprimer ' + $txt + ' .');
   if(result === true){
       return true;
   }else{
       return false;
   }
}

function dateValidation(d,e) {
    var pK = e ? e.which : window.event.keyCode;
    
    if(pK == 8) {
        d.value = substr(0,d.value.length-1); 
        return;
    }
    
    var dt = d.value;
    var da = dt.split('/');
    
    for(var a = 0; a < da.length; a++) {
        if (da[a] != +da[a])
            da[a] = da[a].substr(0,da[a].length-1);
    }
    
    if (da[0] > 31) {
        da[1] = da[0].substr(da[0].length-1,1);da[0] = '0'+da[0].substr(0,da[0].length-1);
    }
    
    if (da[1] > 12) {
        da[2] = da[1].substr(da[1].length-1,1);da[1] = '0'+da[1].substr(0,da[1].length-1);
    }
    
    if (da[2] > 9999) {
        da[1] = da[2].substr(0,da[2].length-1);
    }
    
    dt = da.join('/');
    
    if (dt.length == 2 || dt.length == 5){ 
        dt += '/';
    }
    
    d.value = dt;
}

function setDisabled(id, title){
    var element = document.getElementById(id);
    if(element.disabled === true){
        element.disabled = false;
        element.title = title;
        // Tooltip champ de formulaire
        $(element).tooltip({
            position:{
                my:"left top",
                at:"right+30 top-1"
            }
        });
    }else{
        element.disabled = true;
        element.value = '';
        element.title = '';
    }
}

/**
 * toggleRow() - Afficher ou masque les lignes du tableau
 * @param {type} element - 
 * @param {type} counterAssureur - 
 * @returns {undefined}
 */
function toggleRow(element, counterAssureur){
    // Modifie l'icone + ou -
    if($('#' + element).hasClass('fa-plus-square')){
        $('#' + element).removeAttr('class').attr('class', 'fa fa-minus-square');
    } else {
        $('#' + element).removeAttr('class').attr('class', 'fa fa-plus-square');
    }
    // Parcours les ligne à afficher
    for(var i=1;i<=10;i++){
        var $row = $('#tr-personne-' + counterAssureur + '-' + i);
        if($row.css('display') === 'none'){
            $row.css({
                display:'table-row'
            });
        } else {
            $row.css({
                display:'none'
            });
        }
    }
}

function toggleDiv(element, div){
    var toggle = $(element);
    // Modifie l'icone + ou -
    if(toggle.hasClass('fa-plus-square')){
        toggle.removeAttr('class').attr('class', 'fa fa-minus-square');
    } else {
        toggle.removeAttr('class').attr('class', 'fa fa-plus-square');
    }
    var $div = $('#' + div);
    if($div.css('display') === 'none'){
        $div.css({
           display:'block' 
        });
    }else{
        $div.css({
            display:'none'
        });
    }    
}

function toggleAllDiv(type){
    var lignes = document.getElementsByClassName('detail');
    for(var i=1;i<lignes.length;i++){
        if(type === 'standard'){
            lignes[i].style.display = 'none';
        }else{
            lignes[i].style.display = 'block';
        }
    }
}

function toggleRowOffre(element, row){
    // Modifie l'icone + ou -
    if($('#' + element).hasClass('fa-plus-square')){
        $('#' + element).removeAttr('class').attr('class', 'fa fa-minus-square');
    } else {
        $('#' + element).removeAttr('class').attr('class', 'fa fa-plus-square');
    }
    var $row = $('#' + row);
    if($row.css('display') === 'none'){
        $row.css({
           display:'table-row' 
        });
    }else{
        $row.css({
            display:'none'
        });
    }
}

/**
 * toggleAllRow() -
 * @param {type} type
 * @returns {undefined}
 */
function toggleAllRow(type){
    // Récupère le nombre de lignes
    var lignes = document.getElementById('primes').rows.length;
    for(var i=0;i<=lignes;i++){
        var $row = $(document.getElementById('primes').rows[i]);
        // Modifie l'icone + ou -
        if($row.find('i').hasClass('fa-plus-square')){
            $row.find('i').removeAttr('class').attr('class', 'fa fa-minus-square');
        } else {
            $row.find('i').removeAttr('class').attr('class', 'fa fa-plus-square');
        }        
        if(type === 'standard'){
            if($($row).attr('id') !== undefined){
                $row.css({
                    display:'none'
                });
            }
        } else {
            if($($row).attr('id') !== undefined){
                $row.css({
                    display:'table-row'
                });
            }
        }
    }
}

function toggleCheckbox(className){
    var elements = document.getElementsByClassName('class');
    for(var item in elements){
        console.log('oui');
        console.log(item);
    }
}

function changeName(id){
	if(document.getElementById('nom-'+id).value != '' || document.getElementById('prenom-'+id).value != ''  ){
		var prenom = document.getElementById('prenom-'+id).value.substr(0,1).toUpperCase() + 
		document.getElementById('prenom-'+id).value.substr(1).toLowerCase();
		var nom = document.getElementById('nom-'+id).value.substr(0).toUpperCase();
		document.getElementById('title-pers-'+id).innerHTML = '<strong>'+ prenom +' '+nom +'</strong>';
	}else{
		document.getElementById('title-pers-'+id).innerHTML = '<strong>Personne'+ id +'</strong>';
	}
	
}