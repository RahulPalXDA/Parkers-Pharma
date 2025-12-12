<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();

if (have_posts()):
    while (have_posts()):
        the_post();
        $author_id = get_the_author_meta('ID');
        $author_avatar = get_avatar_url($author_id, array('size' => 150));
        $author_name = get_the_author();
        $author_bio = get_the_author_meta('description');
        $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
        ?>
        <!-- inner short banner start -->
        <section class="inner-short-banner black-gradient" style="background-image: url('<?php echo esc_url($featured_image); ?>'); 
                background-size: cover; 
                background-position: top center; 
                background-repeat: no-repeat;">
            <div class="custom-container">
                <div class="text-wrapper">
                    <?php parkers_breadcrumbs(); ?>
                    <h1><?php the_title(); ?></h1>
                </div>
            </div>
        </section>
        <!-- inner short banner end -->

        <section class="blog-details-sec">
            <div class="custom-container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                        <div class="blog-user-info">
                            <span>
                                <img src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr($author_name); ?>">
                            </span>
                            <h4><?php echo esc_html($author_name); ?></h4>
                            <?php if ($author_bio): ?>
                                <p><?php echo esc_html($author_bio); ?></p>
                            <?php endif; ?>
                            <?php
                            $social_links = array(
                                'linkedin' => array('url' => get_the_author_meta('linkedin'), 'icon' => 'fa-linkedin-in', 'type' => 'fa-brands'),
                                'twitter' => array('url' => get_the_author_meta('twitter'), 'icon' => 'fa-twitter', 'type' => 'fa-brands'),
                                'facebook' => array('url' => get_the_author_meta('facebook'), 'icon' => 'fa-facebook-f', 'type' => 'fa-brands'),
                                'instagram' => array('url' => get_the_author_meta('instagram'), 'icon' => 'fa-instagram', 'type' => 'fa-brands'),
                                'youtube' => array('url' => get_the_author_meta('youtube'), 'icon' => 'fa-youtube', 'type' => 'fa-brands'),
                                'other' => array('url' => get_the_author_meta('other_social'), 'icon' => 'fa-globe', 'type' => 'fa-solid'),
                            );

                            $active_links = array_filter($social_links, function ($link) {
                                return !empty($link['url']);
                            });
                            $active_links = array_slice($active_links, 0, 6);

                            if (!empty($active_links)):
                                ?>
                                <ul class="user-social">
                                    <?php foreach ($active_links as $platform => $link): ?>
                                        <li><a href="<?php echo esc_url($link['url']); ?>" target="_blank" rel="noopener noreferrer"><i
                                                    class="<?php echo esc_attr($link['type'] . ' ' . $link['icon']); ?>"></i></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12">
                        <div class="blog-detals-info">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    endwhile;
endif;

get_footer();