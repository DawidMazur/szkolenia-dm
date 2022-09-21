<?php
/**
 * Template Name: Przykład php
 * @package ws
 */

get_header();

// zbieracie wszystkie potrzebne wam dane
// acf
$acf = get_fields();
$acf_globals = get_fields('options');

$posts = new WP_Query([
    'post_type' => 'posts',
    'posts_per_page' => -1,
]);
foreach($posts ?: [] as $post) {
    $post->acf = get_fields($post->ID);
}

?>

<div id="s1">
    <h1>
        <?php echo $acf['s1_title'];?>
        <?php echo $acf['hero']['title'];?>
    </h1>
</div>
<!-- jakis kod -->

<div id="blog">
    <?php foreach($posts as $post):?>
        
        <?php get_template_part('post-prev', null, [
            'title' => $post->post_title,
            'post' => $post,
        ]) ?>

    <?php endforeach;?>
</div>

<?php
get_footer();