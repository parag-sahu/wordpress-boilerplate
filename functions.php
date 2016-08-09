<?php

/**
* This is a sample functions php to add some 
* functionality and tweaks.
**/

if(!function_exists('ps_theme_setup')){

    /**
    * Add theme features on theme initialization 
    */
    function ps_theme_setup(){

        /**
        * Add the title featutre to the wordpress theme.
        * By this the theme automatically adds title to 
        * the page when wp_head() is called in header.
        */
        add_theme_support( 'title-tag' );

        /**
        * Add a custom logo option to the wordpress theme
        * which was first done by a lot of tweaks. Requires
        * WP 4.5+ 
        */
        add_theme_support( 'custom-logo' );

        /**
        * Enable feed for the RSS feed for posts you
        * write and comments you get.
        */
        add_theme_support( 'automatic-feed-links' );

        /**
        * Enables post formats in the posts.
        */
        //delete-it: Remove the post types that are not needed by the theme.
        add_theme_support( 'post-formats', array( 'status', 'quote', 'gallery', 'image', 'video', 'audio', 'link', 'aside', 'chat' ) );

        /**
        * Enable post types to have thumbnails. 
        */
        //delete-it: Add the custom post types you need thumbnail in.
        add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );

        /**
        * Make wordpress generate HTML5 tags on its core
        * elements that are generated from its function.
        */
        add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
    }
}

add_action( 'after_setup_theme', 'ps_theme_setup');


/**
* Adding backwards compatiblity for the 
* feature title-tag
*/
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function theme_slug_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'theme_slug_render_title' );
}


/**
* $content_width allows us to set max width for
* oEmbeds and images used in the posts.
*/
if ( ! isset( $content_width ) )
	$content_width = 1920;

/**
* Add some lines of code to the head of every
* file using wp_head action
*/
function ps_add_html_to_head(){
    /**
    * Adds a magic responsive tag to every page of the wordpress site.
    */
    ?>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <?php
    
    /**
    * Add further scripts that are much required like google analytics!
    *
    * ---------------------left as a placeholder for further editing
    *
    */

}
add_action( 'wp_head', 'ps_add_html_to_head' );


function ps_post_head(){
    ?>
    <?php if(is_single()):?>
        <h1><?php the_title(); ?></h1>
    <?php else: ?>
        <a href="<?php the_permalink(); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
    <?php endif;?>   
    <p>Written by: <?php the_author_posts_link(); ?></p>
    <?php edit_post_link('edit', '<p>', '</p>'); ?>
    <p><?php the_time('F jS, Y'); ?></p>
    <?php
}

add_action( 'ps_post_header','ps_post_head' );

function ps_post_foot(){
    ?>
    <?php  if(is_single()):
        do_action('ps_author_details');
        comments_template();
        endif;
    ?>
    <?php
}

add_action( 'ps_post_footer','ps_post_foot' );

function ps_print_author_meta(){
    ?>
    <?php echo get_avatar(get_the_author_meta('ID')); ?>
    <?php the_author_meta('display_name');?>
    <?php the_author_meta('user_description');?>
    <?php
}

add_action('ps_author_details', 'ps_print_author_meta');