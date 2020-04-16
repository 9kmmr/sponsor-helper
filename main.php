<?php 


/*
* @link              mxvice.com
* @since             1.0.0
* @package           Sponsor_Helper
*
* @wordpress-plugin
* Plugin Name:       Sponsor Support
* Plugin URI:        mxvice.com
* Description:       This plugin create sponsor sections for articles
* Version:           1.0.0
* Author:            yourmindhasgone
* Author URI:        mxvice.com
* License:           GPL-2.0+
* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
* Text Domain:       
* Domain Path:       
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
   die;
}
// display meta box
add_action( 'add_meta_boxes', 'sponsor_helper_add_meta_box' );
function sponsor_helper_add_meta_box(){

    add_meta_box("sponsor_support", "Sponsor", 'sponsor_support_display',  array( 'post'), 'side');
}
function sponsor_support_display(){
    global $post;
    
    $sponsor_name = get_post_meta($post->ID, 'sponsor_name', true);
    $sponsor_url = get_post_meta($post->ID, 'sponsor_url', true);
    $sponsor_logo = get_post_meta($post->ID, 'sponsor_logo', true);
    $button = 'Choose Sponsor Logo';
    $display = 'none';

    if ($sponsor_logo) {
        $button = '<img class="true_pre_image" src="' . $sponsor_logo . '" style="max-width:95%;display:block;" />';
        $display = 'inline-block';
    }

    include 'metabox.php';
}

// save meta data
add_action( 'save_post', 'sponsor_helper_save_sponsor_data' );
function sponsor_helper_save_sponsor_data($post_id){

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return;

    if (!current_user_can('edit_post', $post_id)) {  
            return $post_id;  
    }

    $sponsor_name = $_POST['sponsor_name'];
    $sponsor_url = $_POST['sponsor_url'];
    $sponsor_logo = $_POST['sponsor_logo'];

    update_post_meta($post_id,'sponsor_name',$sponsor_name);
    update_post_meta($post_id,'sponsor_url',$sponsor_url);
    update_post_meta($post_id,'sponsor_logo',$sponsor_logo);
}

// add custom meta data to rest wp
function sponsor_helper_rest_add_meta_data($data, $post, $context){
    $sponsor_name = get_post_meta( $post->ID, 'sponsor_name', true ) ;
    $sponsor_url = get_post_meta( $post->ID, 'sponsor_url', true );
    $sponsor_logo = get_post_meta( $post->ID, 'sponsor_logo', true );

    
    $data->data['sponsor_name'] = $sponsor_name;
    $data->data['sponsor_url'] = $sponsor_url;
    $data->data['sponsor_logo'] = $sponsor_logo;    

    return $data; 
}
add_filter('rest_prepare_post','sponsor_helper_rest_add_meta_data',10,3);

