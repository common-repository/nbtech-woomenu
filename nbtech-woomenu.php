<?php
/*
Plugin Name: NBTech Woomenu
Description: Automatically generated Woocommerce category menu 
Version:      1.1.4
Author:       Nikita Batischev, NBTech
Author URI:   http://www.inmysight.ru/it/
License: GPLv3
Text Domain:  nbtech-woomenu
Domain Path: /languages
*/


function nbtech_woomenu_language_load() {
	load_plugin_textdomain( 'nbtech-woomenu', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
}
add_action( 'plugins_loaded', 'nbtech_woomenu_language_load' );

function nbtech_woomenu_main_page(){
    global $wpdb;
    include 'nbtech-woomenu-main.php'; 
}

function nbtech_woomenu_menu(){
    $page_title = __('NBTech - Настройки Woomenu','nbtech-woomenu');
    $menu_title = 'NBTech Woomenu'; 
    $capability = 'edit_pages';
    $menu_slug  = 'nbtech_woomenu'; 
    $function   = 'nbtech_woomenu_main_page'; 
    $icon_url   = 'dashicons-list-view'; 
    $position   = 99; 
    add_menu_page( 
        $page_title,
        $menu_title, 
        $capability, 
        $menu_slug, 
        $function, 
        $icon_url, 
        $position 
        );
}
add_action('admin_menu', 'nbtech_woomenu_menu'); 

function nbtech_woomenu_action_links($links, $file) {
    static $this_plugin;
    if (!$this_plugin) {
        $this_plugin = plugin_basename(__FILE__);
    }
    if ($file == $this_plugin) {
        $settings_link = "<a href='" . get_bloginfo('wpurl') . "/wp-admin/admin.php?page=nbtech_woomenu'>".__('Больше информации','nbtech-woomenu')."</a>";
        array_unshift($links, $settings_link);
    }
    return $links;
}
add_filter('plugin_action_links', 'nbtech_woomenu_action_links', 10, 2);

function nbtech_woomenu_styles() {
	wp_register_style('nbtech_woomenu_styles', plugins_url('nbtech-woomenu-style.css', __FILE__));
	wp_enqueue_style('nbtech_woomenu_styles');
	wp_register_script('nbtech_woomenu_scripts', plugins_url('nbtech-woomenu-scripts.js', __FILE__));
	wp_enqueue_script('nbtech_woomenu_scripts');
}
add_action( 'wp_enqueue_scripts', 'nbtech_woomenu_styles');

function nbtech_is_woo_activated() {
	if (class_exists('woocommerce')){ 
		return true; 
	}else{ 
		return false; 
	}
}

function nbtech_woomenu_gen($attr){
	$args = shortcode_atts( array(
		'show_parent_thumbs' => 0,
		'show_child_thumbs' => 1,
		'show_brands' => 0,
		'parent_orderby' => 'none',
		'child_orderby' => 'none',
		'parent_order' => 'ASC',
		'child_order' => 'ASC',
		'hide_empty' => 1,
		'placeholder' => '',
		'mobile_title' => __('Категории товаров =','nbtech-woomenu'),
		'include' => null,
		'exclude' => null,
		'brands_taxonomy_slug' => 'brend',
        ), $attr );
	if (nbtech_is_woo_activated()){
		$categories = get_categories( [
			'taxonomy' => 'product_cat',
			'type' => 'product',
			'include' => wp_parse_id_list($args['include']),
			'exclude' => wp_parse_id_list($args['exclude']),
			'child_of' => 0,
			'parent' => 0,
			'orderby' => $args['parent_orderby'],
			'order' => $args['parent_order'],
			'hide_empty' => $args['hide_empty'],
			'hierarchical' => 1,
		] );
		if( $categories ){
			$result = "<div class='nbtech-woomenu' id='nbtech-woomenu'>";
			$result .= "<span id='nbtech-woomenu-mobiletitle' class='nbtech-woomenu-mobiletitle' onclick='nbtech_woomenu_show(this)'>".$args['mobile_title']."</span>";
			foreach( $categories as $category ){
				if ($args['show_parent_thumbs']){
					$thumbnail_id = get_term_meta( $sub_category->term_id, 'thumbnail_id', true ); 
					if ($thumbnail_id){
						$image = wp_get_attachment_url( $thumbnail_id ); 
					}else{
						$image = $args['placeholder'];
					}
				}else{
					$image = '';
				}	
				$result .= "<div id='nbtech-woomenuparent-".$category->slug."' class='nbtech-woomenuparent ".$category->slug."'>";
				$result .= "<button href='".get_term_link($category->term_id)."' class='nbtech-woomenu-parentbtn' onclick='nbtech_woomenu_parent_click(this)' style='background-image: url(".$image.");'>".$category->name."</button>";
				$sub_categories = get_categories( [
					'taxonomy' => 'product_cat',
					'child_of' => $category->term_id,
					'orderby' => $args['child_orderby'],
					'order' => $args['child_order'],
					'hide_empty' => $args['hide_empty'],
					'include' => wp_parse_id_list($args['include']),
					'exclude' => wp_parse_id_list($args['exclude']),
				] );
				if ($sub_categories){
					$result .= "<div id='nbtech-woomenusub-".$category->slug."' class='nbtech-woomenusub nbtech-woomenusub-".$category->slug."-sub'>";
					foreach ($sub_categories as $sub_category){
						if ($args['show_child_thumbs']){
							$thumbnail_id = get_term_meta( $sub_category->term_id, 'thumbnail_id', true ); 
							if ($thumbnail_id){
								$image = wp_get_attachment_url( $thumbnail_id ); 
							}else{
								$image = $args['placeholder'];
							}
						}else{
							$image = '';
						}
						$result .= "<div class='nbtech-woomenusub-item'><a href='".get_term_link($sub_category->term_id)."' style='background-image: url(".$image.");'>".$sub_category->name."</a></div>";
					}
					$result .= "</div>";
				}
				$result .= "</div>";
			}
			/* BEGIN - Beta Brands */
			if ($args['show_brands']){	
				$result .= "<div class='nbtech-woomenuparent'>";
				$result .= "<button class='nbtech-woomenu-parentbtn nbtech-woomenu-brandbtn' onclick='nbtech_woomenu_parent_click(this)' style='background-image: url();'>".__('Бренды','nbtech-woomenu')."</button>";
				$result .= "<div class='nbtech-woomenusub'>";
				$result .= nbtech_woomenu_brandlist($args['brands_taxonomy_slug'], $args['hide_empty']);
				$result .= "</div></div>";
			}
			/* END - Beta Brands */
			$result .= "</div>";
		}
	}else{
		$result = "<div class='nbtech-woomenu-error'>"._e('Woocommerce не активирован!','nbtech-woomenu')."</div>";
	}
	return $result;
}
add_shortcode('NBTECH_WOOMENU', 'nbtech_woomenu_gen');

/* BEGIN - BETA Optional brandlist generation, its like an addon but not =) */
function nbtech_woomenu_brandlist($taxonomy_slug, $hide_empty){
	$args = array('public'   => true, '_builtin' => false);
	$output = 'names';
	$operator = 'and';
	$taxonomies = get_taxonomies($args, $output, $operator); 
	$result = '';
	if ($taxonomies) {
		foreach ($taxonomies as $taxonomy ) {
			if ($taxonomy == "pa_".$taxonomy_slug){
				$terms = get_terms(['taxonomy' => $taxonomy, 'hide_empty' => $hide_empty,]);
				foreach ($terms as $term) {
					$result .= "<div class='nbtech-woomenusub-item nbtech-woomenu-brandlist-item'><a href='/$taxonomy_slug/".$term->slug."/'>".$term->name."</a></div>";
				}
			}
		}
	}
	return $result;
}
/* END - Optional brandlist generation */

?>