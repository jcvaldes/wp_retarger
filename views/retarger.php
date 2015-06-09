<?php /* Template Name: Retarger */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <style type="text/css" media="screen">
        h1,
        span.edit-link {
            display: none;
        }

        #main-content {
            background-color: #fff !important;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= get_site_url(); ?>/wp-content/plugins/wp_retarger/classes/../css/jquery.modal.css" type="text/css" media="screen" />
</head>
<body>
    <div id="main-content" class="main-content">
        <div id="primary" class="content-area">
            <div id="content" class="site-content" role="main">
                <?php
                    // Start the Loop.
                    while ( have_posts() ) : the_post();
                        // Include the page content template.
                        get_template_part( 'content', 'page' );
                        // If comments are open or we have at least one comment, load up the comment template.
                    endwhile;
                ?>


            </div><!-- #content -->
        </div><!-- #primary -->
    </div><!-- #main-content -->
</body>
<input type="hidden" id="siteurl" value="<?= get_site_url(); ?>">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="<?= get_site_url(); ?>/wp-content/plugins/wp_retarger/js/jquery.modal.js" type="text/javascript" charset="utf-8"></script>
</html>