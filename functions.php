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

/**
* Add print statements for post header. 
* Uses action ps_post_header.
*/
function ps_post_head(){
    ?>
    <?php if(is_single()||is_page()):?>
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

/**
* Execute some lines of code in post footer.
* Uses action ps_post_footer
*/
function ps_post_foot(){
    ?>
    <?php  if(is_single()||is_page()):
        do_action('ps_author_details');
        comments_template();
        endif;
    ?>
    <?php
}
add_action( 'ps_post_footer','ps_post_foot' );

/**
* Print out details of author.
* uses action ps_author_details
*/
function ps_print_author_meta(){
    ?>
    <article>
        <header>
            <figure>
                <?php echo get_avatar(get_the_author_meta('ID')); ?>
            </figure>
            <?php if(is_author()):?>
                <h1><?php the_author_meta('display_name');?></h1>
            <?php else:?>
                <h3><?php the_author_posts_link(); ?></h3>
            <?php endif;?>
        </header>
    <p><?php the_author_meta('user_description');?></p>
    </article>
    <?php
}
add_action('ps_author_details', 'ps_print_author_meta');

/**
* Register menus for the theme.
*/
function ps_register_menu() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
    )
  );
}
add_action( 'init', 'ps_register_menu' );

/**
* Customize excerpt using 'excerpt_more' filter.
*/
function ps_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'ps_excerpt_more' );

/**
* An action to add pagination.
*/
function ps_post_pagination(){
    the_posts_pagination( array(
	'mid_size'  => 2,
	'prev_text' => __( 'New', 'textdomain' ),
	'next_text' => __( 'Older', 'textdomain' ),
) );
}
add_action( 'ps_pagination', 'ps_post_pagination' );
