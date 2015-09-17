<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    

 <?php

function get_page() {
    ?>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Hispanic heritage month</title>

    <!-- Bootstrap -->
    <link href="/assets/css/style.css" rel="stylesheet">
<!-- Google Analytics -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-27604548-4', 'auto');
ga('send', 'pageview');

</script>
<!-- End Google Analytics -->

  </head>
  <body>
    <div id="home"></div>
    <div id="content">
        <div id="container">
            <label for="lastname">Escribe tu apellido y presiona Enter</label>
            <div><input id="lastname" type="text" name="lastname"></div>
            <br>
            <div id="enter"></div>
        </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    
    <script>
        
        $(document).ready(function(){
            $('#enter').on('click', function() {
                goToDescription();
            });

            $(document).keypress(function(e) {
                if(e.which == 13) {
                    goToDescription();
                }
            });

            function goToDescription() {
                var lastname = $('#lastname').val();
                var url = encodeURIComponent(lastname);
                location.replace("http://<?php echo $_SERVER['HTTP_HOST'] ?>/lastname/" + url);
            }
    });

    </script>

    </body>
</html>
    <?php
}


function get_page_lastname($word) {
    try {
        $found = true;
        $name = urldecode($word);
        $name = strtolower($name);
        $name = clean_string($name);
        $lastname = DB::queryFirstRow("SELECT headword, IFNULL(description_spa, '') AS description_spa FROM lastnames WHERE headword = '$name'");

        if (count($lastname) == 0) {
            $found = false;
            $lastname['id'] = 0;
            $lastname['headword'] = $name;
            $lastname['description_spa'] = not_found();
        } 
    } catch (Exception $e) {
	$found = false;
	$lastname['id'] = 0;
	$lastname['headword'] = urldecode($word);
	$lastname['description_spa'] = not_found();
    }

    ?>
    <meta property="og:url" content="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="AT&amp;T: Conoce tu apellido" />
    <meta property="og:description" content="Descubre el origen de tu apellido haciendo clic en la imagen. ¡No olvides compartir el resultado! Mis resultados: <?php echo ucwords(urldecode($word)); ?> - <?php echo str_replace('<br>', '', $lastname['description_spa']); ?>" />
    <meta property="og:image" content="https://s3.amazonaws.com/conocetuapellido.com/thumbnail.png" />
    <link rel="image_src" href="https://s3.amazonaws.com/conocetuapellido.com/thumbnail.png"/>
    <link rel="video_src" href="https://s3.amazonaws.com/conocetuapellido.com/Desktop.swf"/>
    <meta name="video_width" content="470"/>
    <meta name="video_height" content="250"/>
    <meta name="video_type" content="application/x-shockwave-flash"/>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Hispanic heritage month</title>

    <!-- Bootstrap -->
    <link href="/assets/css/style.css" rel="stylesheet">
<!-- Google Analytics -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-27604548-4', 'auto');
<?php if($found) { ?>
ga('send', 'event', 'page', 'found', '<?php echo $name; ?>');
<?php } else { ?>
ga('send', 'event', 'page', 'not-found', '<?php echo $name; ?>');
<?php } ?>

</script>
<!-- End Google Analytics -->
  </head>
  <body>
    <div id="home2"></div>
    <div id="content">
        <div id="container">
                <div id="lastname"><?php echo ucwords(urldecode($word)); ?></div><br>
                <div id="up"></div>
                <div id="description"><?php echo $lastname['description_spa']; ?></div>
                <div id="down"></div>
                <br>
                <div id="share"></div>
                <?php if ($found) { ?>
                <div class="legal"><span>Traducciones al español provienen de entradas en el OUP’s</span> <span>Dictionary of American Family Names, ©2003, Patrick Hanks.</span></div>
                <?php } ?>
                <div class="centerBottom"><div id="back"></div></div>
        </div>

    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
        
        $(document).ready(function(){
            
            if($('#description')[0].scrollHeight > 120) {
                $('#up').show();
                $('#down').show();
            }

            $('#share').on('click', function() {
                ga('send', 'event', 'page', 'share', '<?php echo $name; ?>');
                window.open("https://www.facebook.com/sharer/sharer.php?u=http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>");
            });

            $('#back').on('click',function() {
                location.replace("http://<?php echo $_SERVER['HTTP_HOST'] ?>/lastname");
            });

            $("#down").on("click" ,function(){
                scrolled=$("#description").scrollTop()+90;

                $("#description").animate({
                    scrollTop:  scrolled
                });
            });

            $("#up").on("click" ,function(){
                scrolled=$("#description").scrollTop()-90;

                $("#description").animate({
                    scrollTop:  scrolled
                });
            });


        });

        

    </script>

    </body>
    </html>
    <?php
}

?>