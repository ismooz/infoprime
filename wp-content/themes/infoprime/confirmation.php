<?php
/* Template Name: confirmation */
get_header();

?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Confirmation d'envoi</title>
    <!-- Facebook Conversion Code for Inscriptions maladie Infoprime -->
    <script>
        (function() {
            var _fbq = window._fbq || (window._fbq = []);
            if (!_fbq.loaded) {
                var fbds = document.createElement('script');
                fbds.async = true;
                fbds.src = '//connect.facebook.net/en_US/fbds.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(fbds, s);
                _fbq.loaded = true;
            }
        })();
        window._fbq = window._fbq || [];
        window._fbq.push(['track', '6035816430240', {
            'value': '0.00',
            'currency': 'CHF'
        }]);
    </script>
    <noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6035816430240&amp;cd[value]=0.00&amp;cd[currency]=CHF&amp;noscript=1" /></noscript>
</head>

<body>
<!-- confirmation.php -->
    <div id="main-content-comparateur">
        <div class="container">
            <div id="confirmation" class="text-center form-maladie" style="height:850px">
                <img src="http://www.infoprime.ch/wp-content/uploads/2015/10/check.png" width="300" height="300" alt="Remerciements" />
                <h3><?php echo ($_GET['assureur']); ?></h3>
                <p>
                    Merci pour votre demande d'offre auprès de la compagnie <strong><?php echo ($_GET['assureur']); ?></strong> nous vous contacterons dans les plus brefs délais.
                </p>
            </div>
        </div>
    </div>
    <?php get_footer(); ?>
    <script>
        function countdown() {
            // your code goes here
            var count = 10;
            var timerId = setInterval(function() {
                count--;
                if (count === 0) {
                    clearTimeout(timerId);
                    document.location.href = 'http://www.infoprime.ch/';
                }
            }, 1000);
        }
        countdown();
    </script>
</body>

</html>