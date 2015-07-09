<?php /* Template Name: Retarger */
    $templater = new Templater();
    $retarger = $templater->get(get_post_meta($post->ID, 'router_id', true));

    //var_dump($templater); exit;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <style type="text/css" media="screen">
        h1, span.edit-link {display: none; }
        #main-content {background-color: #fff !important; }
    </style>
    <title><?= $post->post_title; ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= plugin_dir_url(__FILE__) ?>../css/jquery.modal.css" type="text/css" media="screen" />
</head>
<body>
    <div id="main-content" class="main-content">
        <div id="primary" class="content-area">
            <div id="content" class="site-content" role="main">
                <?php echo $templater->iframe; ?>

                <!-- Popup -->
                <?php echo $templater->popup; ?>

                <!-- Exit Popup -->



                <script type="text/javascript">
                    var exitsplashalertmessage = '<?php echo $templater->exit_popup['description']; ?>';
                    var exitsplashmessage = '<?php echo $templater->exit_popup['description']; ?>';
                    var exitsplashpage = '<?php echo $templater->exit_popup['url']; ?>';
                    var exitsplashhelper = '<?php echo $templater->exit_popup['url']; ?>';
                </script>



            </div><!-- #content -->
        </div><!-- #primary -->
    </div><!-- #main-content -->
</body>
<input type="hidden" id="siteurl" value="<?= get_site_url(); ?>">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="<?= plugin_dir_url(__FILE__) ?>../js/jquery.modal.js" type="text/javascript" charset="utf-8"></script>
<script src="<?= plugin_dir_url(__FILE__) ?>../js/frontend.js" type="text/javascript" charset="utf-8"></script>
</html>