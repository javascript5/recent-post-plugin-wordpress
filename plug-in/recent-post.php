<?php
/**
 * Crunchify Hello World Plugin is the simplest WordPress plugin for beginner.
 * Take this as a base plugin and modify as per your need.
 *
 * @package Crunchify Hello World Plugin
 * @author Crunchify
 * @license GPL-2.0+
 * @link https://crunchify.com/tag/wordpress-beginner/
 * @copyright 2017 Crunchify, LLC. All rights reserved.
 *
 *            @wordpress-plugin
 *            Plugin Name: GTR Recent Post
 *            Plugin URI: http://178.128.125.232/
 *            Description: Show post detail
 *            Version: 3.0
 *            Author: Crunchify
 *            Author URI: https://crunchify.com/
 *            Text Domain: crunchify-hello-world
 *            Contributors: Crunchify
 *            License: GPL-2.0+
 *            License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */


function get_register_admin_menu() {
	add_submenu_page ( "options-general.php", "GTR Recent Post", "GTR Recent Post", "manage_options", "crunchify-hello-world", "crunchify_hello_world_page" );
}
add_action ( "admin_menu", "get_register_admin_menu" );


add_action( 'wp_enqueue_scripts', 'my_styles' );
function my_styles() {
    wp_register_style( 'custom_wp_admin_css', plugins_url( 'css/style.css', __FILE__ ));

    wp_register_style( 'custom_wp_admin_css_2', plugins_url( 'css/animate.css', __FILE__ ));
    wp_enqueue_style( 'custom_wp_admin_css' );
    wp_enqueue_style( 'custom_wp_admin_css_2' );
}



function promotion_display( $atts ){
    wp_enqueue_script( 'my_script', plugins_url( 'js/script.js', __FILE__ ), array( 'jquery' ), null, true );
    $promotion_args = array(
        'order'=> 'DESC',
        'post_type'=> 'promotions',
        'post_status'=> 'publish',
        'suppress_filters' => true 
    );
    $cats = get_categories($promotion_args);
    
    //Filter
    echo '<div class="promotion_filter">
    <div class="category_filter">
        <select class="post_filter">
            <option value="more">ดูทั้งหมด</option>
            ';

            foreach($cats as $category){
                echo '<option value="'.$category->cat_name.'">'.$category->cat_name.'</option>';
            }

            echo'
        </select>
    </div>
    <div class="list_and_grid_button">
        <div class="list_button">
            <img src="http://178.128.125.232/wp-content/uploads/2019/03/listview.png" />
        </div>
        <div class="grid_button">
        <img src="http://178.128.125.232/wp-content/uploads/2019/03/grid.png" />
        </div>
    </div>
</div>';
            
    $posts = get_posts( $promotion_args ); 
    echo '<div class="posts">';
    foreach($posts as $rows){
        $default_images = "<img src='https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png' />";
        $post_title = $rows->post_title;
        $post_thumbnail = get_the_post_thumbnail( $rows->ID, 'full' );
        $post_content =  wp_trim_words( $rows->post_content, 50, NULL);;
        $post_link =  get_permalink( $rows);
        $post_categorys = get_the_category( $rows-> ID);
        if($post_thumbnail == null){
            $post_thumbnail = $default_images;
        }

        
        $category = "";

       echo '
       
       <div class="post_item list_item animated" category="'.$post_categorys[0]->cat_name.'">
           <div class="post_thumbnail">
               '.$post_thumbnail.'
           </div>
           <div class="right_post_item">
               <div class="post_title">
                    <a href="'.$post_link.'">
                        <h3>'.$post_title.'</h3>
                    </a>
               </div>
               <div class="post_description">
                   <span>
                       '.$post_content.'
                   </span>
               </div>
               <div class="read_more_button">
                   <a href="'.$post_link.'">
                        <button>อ่านเพิ่มเติม</button>
                   </a>
               </div>
           </div></div>';
    }

    echo '</div>';
	
}
add_shortcode( 'recent_promotion', 'promotion_display' );
