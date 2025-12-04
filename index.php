<?php
/**
 * The main template file
 */

get_header(); 
?>

<div class="content-area">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            
            // This is the "hyphen call" you requested:
            // It looks for template-parts/content-helloworld.php
            get_template_part( 'template-parts/content', 'helloworld' );

            // Or typically you might use:
            // the_content();

        endwhile;
    else :
        echo '<p>No posts found.</p>';
    endif;
    ?>
</div>

<?php 
get_footer();