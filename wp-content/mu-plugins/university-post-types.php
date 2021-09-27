<?php

function university_post_types() {

    // Event Post Type
    register_post_type('event',array(
    	'capability_type' => 'event',
    	'map_meta_cap' => true,
        'rewrite' => array(
            'slug' => 'events'
        ),
        'supports' => array(
            'title','editor','excerpt'
        ),
        'has_archive' => true,
        'menu_icon' => 'dashicons-calendar-alt',
        'show_in_rest' => true,        
        'labels' => array(
            'name' => 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event',
        ),
        'public' => true
    ));

    // Campues Post Type
    register_post_type('campus',array(
        'rewrite' => array(
            'slug' => 'campuses'
        ),
        'supports' => array(
            'title','editor','excerpt'
        ),
        'has_archive' => true,
        'menu_icon' => 'dashicons-location-alt',
        'show_in_rest' => true,        
        'labels' => array(
            'name' => 'Campus',
            'add_new_item' => 'Add New Campus',
            'edit_item' => 'Edit Campus',
            'all_items' => 'All Campuses',
            'singular_name' => 'Campus',
        ),
        'public' => true
    ));

    //Program Post Type

    register_post_type('program',array(
        'rewrite' => array('slug' => 'programs'),
        'supports' => array('title'),
        'has_archive' => true,
        'menu_icon' => 'dashicons-awards',
        'show_in_rest' => true,        
        'labels' => array(
            'name' => 'Programs',
            'add_new_item' => 'Add New Program',
            'edit_item' => 'Edit Program',
            'all_items' => 'All Programs',
            'singular_name' => 'Program',
        ),
        'public' => true
    ));

    //Professor Post Type
    register_post_type('professor',array(
        'supports' => array('title','editor','thumbnail'),
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'show_in_rest' => true,        
        'labels' => array(
            'name' => 'Professor',
            'add_new_item' => 'Add New Professor',
            'edit_item' => 'Edit Professor',
            'all_items' => 'All Professors',
            'singular_name' => 'Professor',
        ),
        'public' => true
    ));

    //Note Post Type
    register_post_type('note',array(
    	'capability_type' => 'note',
    	'map_meta_cap' => true,
        'supports' => array('title','editor'),
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-welcome-write-blog',
        'show_ui' => true,
        'show_in_rest' => true,        
        'labels' => array(
            'name' => 'Notes',
            'add_new_item' => 'Add New Note',
            'edit_item' => 'Edit Note',
            'all_items' => 'All Notes',
            'singular_name' => 'Note',
        ),
        'public' => false
    ));

    //Note Post Type
    register_post_type('like',array(
        'supports' => array('title'),
        'menu_icon' => 'dashicons-heart',
        'show_ui' => true,
        'show_in_rest' => true,        
        'labels' => array(
            'name' => 'Likes',
            'add_new_item' => 'Add New Like',
            'edit_item' => 'Edit Like',
            'all_items' => 'All Likes',
            'singular_name' => 'Like',
        ),
        'public' => false
    ));

    //Slideshare Post Type
    register_post_type('slide',array(
        'supports' => array('title'),
        'menu_icon' => 'dashicons-slides',
        'show_ui' => true,
        //'show_in_rest' => true,        
        'labels' => array(
            'name' => 'Slides',
            'add_new_item' => 'Add New Slide',
            'edit_item' => 'Edit Slide',
            'all_items' => 'All Slides',
            'singular_name' => 'Slide',
        ),
        'public' => false
    ));
}

add_action('init','university_post_types');

?>