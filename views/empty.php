<?php /* Template Name: My Custom Page */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style type="text/css" media="screen">
        h1, span.edit-link{display:none;}
    </style>
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
</html>