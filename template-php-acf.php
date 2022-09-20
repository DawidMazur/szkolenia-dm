<?php
/**
 * Template Name: PHP acf kod
 * @package ws
 */

wp_head();
wp_footer();

$field_text = get_field('text');
d($field_text);

// pobiera wszystkie acfy do jednej tablicy
$get_fields = get_fields();
d($get_fields);

// repeater field: have_rows vs acf in array

if( have_rows('items') ):
    while( have_rows('items') ) : the_row();
        $text = get_sub_field('text');
        echo $text . '<br>';
    endwhile;
endif;

// array version

if( isset($get_fields['items']) ) {
    foreach( $get_fields['items'] as $id => $item ) {
        $text = $item['text'];
        echo $id . ':' . $text . '<br>';
    }
}

// szybszy sposób zapisu
foreach( $get_fields['cos_co_nie_istnieje'] ?: [] as $id => $item ) {
    $text = $item['text'];
    echo $id . ':' . $text . '<br>';
}