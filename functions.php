<?php

function university_files(){
    wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'),
    //microtime avoids caching
    NULL, microtime(), true);
    wp_enqueue_style('custome-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles',get_stylesheet_uri(),NULL, microtime());
}

//first argument-tell wordpress what type of instructions we are giving it
//second argument-tell the name of the function we are gonna run
add_action('wp_enqueue_scripts','university_files');

//this add title of each page in the browser tap
function university_features(){
    // register_nav_menu( 'headerMenuLocation', 'Header Menu Location' );
    // register_nav_menu( 'footerFirstLocation', 'Footer First Location');
    // register_nav_menu( 'footerSecondLocation', 'Footer Second Location');

    add_theme_support('title-tag');
}

add_action( 'after_setup_theme', 'university_features');

function university_adjust_queries($query){
    //check this query is only running in this indecated url
    if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()){
        $today = date('Ymd');
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
                array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
                )
            ));
        }
}

add_action('pre_get_posts', 'university_adjust_queries');