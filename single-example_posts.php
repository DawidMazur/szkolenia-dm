<?php
/**
 * @package ws
 */

$acf = get_fields();
get_header(); ?>

<section class="post">
    <div class="post__container">
        <div class="post__content">
            <?php foreach($acf['flex_content'] as $block): ?>
                <?php if($block['acf_fc_layout'] == "block_text"): ?>
                    <div class="text">
                        <?php echo $block['text']; ?>
                    </div>
                <?php elseif($block['acf_fc_layout'] == "block_link"): ?>
                    <div class="link-container">
                    <?php foreach($block['links'] as $link): 
                        $link_url = $link['link']['url'];
                        $link_title = $link['link']['title'];
                        $link_target = $link['link']['target'] ? $link['target'] : '_self';
                        // d($link); 
                        ?>
                        <a class="link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                    <?php endforeach; ?>
                    </div>
                <?php elseif($block['acf_fc_layout'] == "block_gallery"): ?>
                    <div class="gallery-container">
                        <?php foreach( $block['gallery'] as $image_id ): ?>
                            <div class="photo">
                                <?php echo wp_get_attachment_image( $image_id['id'], $size ); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
get_footer();