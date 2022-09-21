<?php
/**
 * Template Name: zadanie2
 * @package ws
 */

$context = Timber::context();

$context['posts'] = get_posts([
  'post_type' => 'example_posts',
  'posts_per_page' => 3,
]);

foreach ($context['posts'] ?: [] as $post) {
  $post->acf = get_fields($post->ID);
  $post->url = get_the_permalink($post->ID);
}

Timber::render('views/templates/zadanie2/zadanie2.twig', $context);