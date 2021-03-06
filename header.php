<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Cover
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
    
<meta name="theme-color" content="#026ed2">

</head>

<?php

$header_class = '';
if ( ! ( is_single() || is_page() || is_archive() || is_author() || is_search() || is_404() || cover_has_featured_posts() ) ) {
    $header_class = ' bg';
}

$nav_primary = 'primary';
$nav_social  = 'social_header';

$build_overlay = false;
if (
        has_nav_menu( $nav_primary ) ||
        has_nav_menu( $nav_social ) ||
        is_active_sidebar( 'cover-overlay' ) ) {
    $build_overlay = true;
}

?>

<body <?php body_class(); ?>>

<?php do_action( 'ase_theme_body_inside_top' ); ?>

<header class="header<?php echo $header_class; ?>">
    <div class="backdrop" data-0-top="opacity: 0;" data-0-top-bottom="opacity: 1;" data-anchor-target=".cover"></div>

	<div class="site-nav">
		<a class="site-search" data-action="toggle-overlay" data-overlay-id="search-overlay" href="#search-overlay"><span class="fa fa-search"></span></a>
		<?php if ( $build_overlay ) { ?>
			<a class="hamburger" data-action="toggle-overlay" data-overlay-id="menu-overlay" href="#menu-overlay"><span></span></a>
		<?php } ?>
	</div>
    
    <div class="site-info">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-title"><?php bloginfo( 'name' ); ?></a>
        <span class="site-description"><?php bloginfo( 'description' ); ?></span>
	</div>
    
</header>

<?php if ( $build_overlay ) { ?>
    <div id="menu-overlay" class="overlay">
        <noscript>
            <div class="header">
                <div class="site-nav">
                    <a class="hamburger close" href="#"><span></span></a>
                </div>
            </div>
        </noscript>
        
        <?php if ( has_nav_menu( $nav_primary ) ) { ?>
            <nav class="main-navigation">
                <?php wp_nav_menu( array( 'theme_location' => $nav_primary ) ); ?>
            </nav>
        <?php } ?>

        <?php if ( has_nav_menu( $nav_social ) ) { ?>
            <nav class="social-navigation">
                <?php wp_nav_menu( array(
                    'theme_location' => $nav_social,
                    'link_before'    => '<span class="fa-stack fa-2x"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-stack-1x social-icon"></i><span class="screen-reader-text">',
                    'link_after'     => '</span></span>',
                ) ); ?>
            </nav>
        <?php } ?>
        
        <?php get_sidebar( 'overlay' ); ?>
    </div>
<?php } ?>

<div id="search-overlay" class="overlay overlay-search">
    <span class="overlay-icon fa fa-search"></span>
    <noscript>
        <div class="header">
            <div class="site-nav">
                <a class="hamburger close" href="#"><span></span></a>
            </div>
        </div>
    </noscript>
    
    <?php get_search_form(); ?>
</div>
