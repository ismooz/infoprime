(function($) {

    $.fn.infoprime_modal = function($options) {

        var $this = $(this);
        var modal = null;

        var settings = $.extend({
            width:640,
            height:480,
            top:10,
            left:10,
            title:'Information de l\'assureur',
            body:'test'
        });

        function createModal(){
            modal = $('<div class="modal"><div class="modal-content-html"></div></div>');
            // Get document width and height
            var docWidth = (($(window).outerWidth()/2)-320)+ 'px';
            var docHeight = (Math.max($(window).height() - settings.height)/2) + $(window).scrollTop() + 'px';
            // Set centered position of modal
            modal.css({
                'top':docHeight,
                'left':docWidth,
                'width':settings.width + 'px',
                'height':settings.height + 'px'
            });
            $('.mask').before(modal);
      }

        // Create the mask and add this on page
        function createMask(modal){
            var pageWidth = $(window).width();
            var pageHeight  = $(document).height();
            var mask = $('<div class="mask"></div>');
            $(mask).css({
                'position':'absolute',
                'display':'box',
                'top':'0',
                'left':'0',
                'background-color':'#000',
                'height':pageHeight,
                'width':pageWidth,
                'z-index':'100',
                'opacity':'0'
            });
            // Display the mask
            $('body').append(mask);
            $('.mask').fadeTo("fast", 0.6);
            $(mask).click(function(){
                    remove();
            });
        }

        function remove(){
            modal.fadeOut(function(){
                modal.remove();
            });
            // Supprime le bouton
            $('.modal-button').fadeOut(function(){
                $('.modal-button').remove();
            });
            // Supprime le mask
            $('.mask').fadeOut(function(){
                $('.mask').remove();
            });
        }

        this.click(function(e){
            e.preventDefault();
            createMask();
            createModal();
            var id = $(this).attr('data-id');
            var montant = $(this).attr('data-montant');
            $('.modal-content-html').load('https://www.infoprime.ch/offre-maladie/infos-assureurs/?id=' + id + '&economies=' + montant);
        });

        // Close the modal with Esc keyboard key
        $('body').on('keydown', function(e){
            if(e.keyCode === 27){
                remove();
            }
        });

    };

}(jQuery));
