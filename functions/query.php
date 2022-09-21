<?php
add_action('pre_get_posts','pc_pre_query', 11);

function pc_pre_query( $query ) {
    if ( !is_admin() && $query->is_main_query() ) {
        if(isset($_GET['posts_per_page'])) {
            $query->set( 'posts_per_page', intval($_GET['posts_per_page']) );
        } else {
            $query->set( 'posts_per_page', intval(6) );

            if( is_post_type_archive('blog') ) {
                $query->set( 'posts_per_page', intval(9) );
            }
        }

        PC_Query::search( $query );
        PC_Query::sort( $query );
        PC_Query::price( $query );
        PC_Query::custom_taxonomies( $query );
    }
}


class PC_Query {
    public static function search($query) {
        if(isset($_GET['looking_for'])) {
            $query->set('s', $_GET['looking_for']);
        }
    }

    public static function sort($query) {
        if(isset($_GET['sort'])) {
            if($_GET['sort'] == "") {
                return;
            }

            if($_GET['sort'] == "data_old") {
                $query->set('orderby', 'date');
                $query->set('order', 'ASC');
            }

            if($_GET['sort'] == "data_new") {
                $query->set('orderby', 'date');
                $query->set('order', 'DESC');
            }

            if($_GET['sort'] == "price-asc") {
                $query->set('meta_key', 'price');
                $query->set('orderby', 'meta_value');
                $query->set('order', 'ASC');
            }

            if($_GET['sort'] == "price-desc") {
                $query->set('meta_key', 'price');
                $query->set('orderby', 'meta_value');
                $query->set('order', 'DESC');
            }

            if($_GET['sort'] == "name-asc") {
                $query->set('orderby', 'title');
                $query->set('order', 'ASC');
            }

            if($_GET['sort'] == "name-desc") {
                $query->set('orderby', 'title');
                $query->set('order', 'DESC');
            }
        }
    }

    public static function add_meta_query($query, $arr) {
        if(! $arr) {
            return;
        }

        $meta_query = $query->get('meta_query');
        if(!is_array($meta_query)) {
            $meta_query = [
                'relation' => 'AND',
            ];
        }
        $meta_query[] = $arr;

        $query->set('meta_query', $meta_query);
    }

    public static function add_tax_query($query, $arr) {
        if(! $arr) {
            return;
        }

        $tax_query = $query->get('tax_query');
        if(!is_array($tax_query)) {
            $tax_query = [
                'relation' => 'AND',
            ];
        }
        $tax_query[] = $arr;

        $query->set('tax_query', $tax_query);
    }

    public static function price($query) {
        if(! isset($_GET['price_min'])) {
            return;
        }

        // d($_GET);

        if($_GET['price_min'] != "" && $_GET['price_max'] == "") {
            PC_Query::add_meta_query($query, [
                'key' => 'price',
                'value' => $_GET['price_min'],
                'compare' => '>=',
                'type' => 'NUMERIC'
            ]);
        }

        if($_GET['price_min'] == "" && $_GET['price_max'] != "") {
            PC_Query::add_meta_query($query, [
                'key' => 'price',
                'value' => $_GET['price_max'],
                'compare' => '<=',
                'type' => 'NUMERIC'
            ]);
        }

        if($_GET['price_min'] != "" && $_GET['price_max'] != "") {
            $price_min = $_GET['price_min'];
            $price_max = $_GET['price_max'];

            PC_Query::add_meta_query($query, [
                'key' => 'price',
                'value' =>[
                    $price_min, 
                    $price_max
                ],
                'compare' => 'BETWEEN',
                'type' => 'NUMERIC'
            ]);
        }

    }

    public static function custom_taxonomies($query) {
        if( isset($_GET['tax']) && $_GET['tax'] != "" )  {
            foreach($_GET['tax'] as $tax => $terms) {
                PC_Query::add_tax_query($query, [
                    'taxonomy' => $tax,
                    'field' => 'term_id',
                    'terms' => $terms,
                    'operator' => 'IN'
                ]);
            }
        }
    }
}