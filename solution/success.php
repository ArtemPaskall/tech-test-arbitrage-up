<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Purchase!</title>
</head>
<body>
    <?php 
        $name = isset($_GET['firstname']) ? htmlspecialchars($_GET['firstname']) : 'Unknown';

        echo "<p>$name</p>";
        echo "Thank You for Purchase!";
    ?>
    <?php
    $pixelId = isset($_GET['pixel']) ? htmlspecialchars($_GET['pixel']) : '111111111111'; 
    ?>
    <script>
      (function(f,b,e,v,n,t,s) {
        if(f.fbq)return; n=f.fbq=function() {
          n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if(!f._fbq)f._fbq=n; n.push=n; n.loaded=!0; n.version='2.0';
        n.queue=[]; t=b.createElement(e); t.async=!0;
        t.src=v; s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)
      })(window, document,'script','https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '<?php echo $pixelId; ?>'); 
      fbq('track', 'Lead'); 
    </script>
    <noscript>
      <img height="1" width="1" style="display:none"
           src="https://www.facebook.com/tr?id=<?php echo $pixelId; ?>&ev=Lead&noscript=1"/>
    </noscript>
</body>
</html>
