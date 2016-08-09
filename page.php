<?php
    get_header();
    if(have_posts()):
        while(have_posts()):the_post();
            get_template_part( 'format');
        endwhile;
        else:
            get_template_part( 'format', 'none' );
    endif;
    get_footer();