<?php 
    get_header();
    do_action( 'ps_author_details' );
    if(have_posts()):
        while(have_posts()):the_post();
            get_template_part( 'format', get_post_format() );
        endwhile;
        do_action('ps_pagination');
        else:
            get_template_part( 'format', 'none' );
    endif;
    get_footer();