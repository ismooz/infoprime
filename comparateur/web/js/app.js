// Vérifie que le document soit chargé
jQuery(document).ready(function(){


	jQuery('#form-first').submit(function(){
        // Vérifie le formulaire
        return checkFirstSubmission();
    });

    //
    jQuery('#button-add').click(function(event){
        // Désactive l'événement du bouton par défaut
        event.preventDefault();
        // Copie le ligne de l'assuré
        counter = copieDivFormSecond();
        // Tooltip
        jQuery('i.fa-info').tooltip({
            content:function(){
                var attribut = jQuery(this).attr('data-content');
                return jQuery('#' + attribut).html();
            }
        });
    });

    jQuery("#button-remove").click(function(event) {
        // Désactive l'événement par défaut
        event.preventDefault();
        // Récupère le nombre d'abonnés
        var counter = document.getElementById('nbAssures').value;
        // Vérifie le nombre minimum de ligne à supprimer
        if(counter === '1'){
            alert('Vous avez supprimé toutes les personnes supplémentaires');
            return false;
        }
        // Enlève la ligne de l'assuré
        jQuery("#form-group-" + counter).remove();
        // Met à jour le compteur
        document.getElementById('nbAssures').value = counter - 1;
    });

    // Tooltip
    jQuery('i.fa-info').tooltip({
        content:function(){
            var attribut = jQuery(this).attr('data-content');
            return jQuery('#' + attribut).html();
        }
    });

    // Tooltip champ de formulaire
    jQuery('li[title]').tooltip({
        position:{
            my:"left top",
            at:"right+10 top+11"
        }
    });

    // Tooltip champ de formulaire
    jQuery('input[title]').tooltip({
        position:{
            my:"left top",
            at:"right+10 top-1"
        }
    });

    // Tooltip textarea
    jQuery('textarea[title]').tooltip({
        position:{
            my:"left top",
            at:"right+10 top-1"
        }
    });

    // Tooltip select de formulaire
    jQuery('select[title]').tooltip({
        position:{
            my:"left top",
            at:"right+10 top-2"
        }
    });

    jQuery('select').each(function(){
        jQuery(this).wrap('<div class="select-style"></div>');
    });

    // Autocomplection
    jQuery('#adresseFirst').autocomplete({
        autoSelectFirst:true,
        serviceUrl:'/comparateur/library/json/localites.php',
        dataType:'json',
        appendTo:'#suggestions-container',
        width:'100%',
        forceFixPosition:true,
        orientation:'auto',
        onSelect:function(suggestion){
            jQuery(this).val(suggestion.value);
            jQuery('#region').val(suggestion.data);
        }
    });

    // Autocomplection
    jQuery('#npaFourth').autocomplete({
        autoSelectFirst:true,
        serviceUrl:'/comparateur/library/json/localites.php',
        dataType:'json',
        appendTo:'#suggestions-container',
        width:'100%',
        forceFixPosition:true,
        orientation:'auto',
        onSelect:function(suggestion){
            var result = suggestion.value.split(" ");
            jQuery(this).val(result[0]);
            jQuery('#villeFourth').val(result[1] + ' ' + result[2]);
        }
    });
    // Autocomplection
    jQuery('#villeFourth').autocomplete({
        autoSelectFirst:true,
        serviceUrl:'/comparateur/library/json/localites.php',
        dataType:'json',
        appendTo:'#suggestions-container',
        width:'100%',
        forceFixPosition:true,
        orientation:'auto',
        onSelect:function(suggestion){
            var result = suggestion.value.split(" ");
            jQuery(this).val(result[1] + ' ' + result[2]);
            jQuery('#npaFourth').val(result[0]);
        }
    });
    // Ajoute le plugin datapicker
    jQuery(".datepicker").datepicker({
        altField:this,
        currentText:'Aujourd\'hui',
        monthNames:['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthNamesShort:['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
        dayNames:['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        dayNamesShort:['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
        dayNamesMin:['D', 'L', 'M', 'M', 'J', 'V', 'S'],
        weekHeader:'Sem.',
        dateFormat:'dd/mm/yy',
        firstDay:1,
        showOtherMonths:true,
        changeYear:true,
        changeMonth:true,
        yearRange:"-100:+0"
    });

    jQuery(".flash").each(function(){
        var timeout = '';
        jQuery(this).css({
           display:'block',
           opacity:0
        });
        jQuery(this).animate({
            top:'0',
            opacity:1
        }, 500);
        clearTimeout(timeout);
        timeout = setTimeout('$(".flash").fadeOut("1000")', 4000);
    });

    jQuery('.chart').each(function(){
        easyPieChart({
            animate:500,
            barColor:'#315391'
        });
    });

    jQuery('#graph').each(function(){
        Morris.Bar({
            element:this,
            data:[
              {x:'Janvier', y:530, z:120},
              {x:'Février', y:820, z:140},
              {x:'Mars', y:430, z:120},
              {x:'Avril', y:620, z:130},
              {x:'Mai', y:70, z:10}
            ],
            xkey:'x',
            ykeys:['y', 'z'],
            labels:['Pages vues', 'Visiteurs']
        });
    });

    jQuery('#graph2').each(function(){
        Morris.Bar({
            element:this,
            data:[
              {x:'Janvier', y:13, z:12, a:3},
              {x:'Février', y:12, z:14, a:1},
              {x:'Mars', y:11, z:21, a:4},
              {x:'Avril', y:12, z:14, a:3},
              {x:'Mai', y:1, z:1, a:0}
            ],
            xkey:'x',
            ykeys:['y', 'z', 'a'],
            labels:['Offres', 'Polices', 'Résilations']
        });
    });

    jQuery('#donut').each(function(){
        // Morris Donut Chart
        Morris.Donut({
            element:this,
            data:[
                {label:'Vazquez Luis', value:35},
                {label:'Gashi Ismael', value:40},
                {label:'Rochebain Darius', value:15},
                {label:'Ducros Emil', value:10}
            ],
            colors:["#0b62a4", "#7a92a3", "#4da74d"],
            formatter:function(y){return y + "%";}
        });
    });

    jQuery('#donut2').each(function(){
        // Morris Donut Chart
        Morris.Donut({
            element:this,
            data:[
                {label:'Vazquez Luis', value:30},
                {label:'Gashi Ismael', value:15},
                {label:'Rochebain Darius', value:15},
                {label:'Ducros Emil', value:40}
            ],
            colors:["#0b62a4", "#7a92a3", "#4da74d"],
            formatter:function(y){return y + "%";}
        });
    });

    jQuery('.modal-box').each(function(){
        jQuery(this).infoprime_modal();
    });

});
