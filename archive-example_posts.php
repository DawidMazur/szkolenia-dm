<?php
/**
 * @package ws
 */

$context = Timber::context();

foreach ($context['posts'] ?: [] as $post) {
  $post->acf = get_fields($post->ID);
  $post->url = get_the_permalink($post->ID);
}

Timber::render('views/templates/archive/archive.twig', $context);