<?php
/**
 * Template Name: Homepage
 * @package ws
 */

d(get_fields());
get_header(); ?>


<div class="swiper">
 <div class="swiper-wrapper">
  <?php 
    if(have_rows('test_slider')):
        while( have_rows('test_slider') ): the_row(); 
        $image = get_sub_field('image_slide');?>
            <div class="swiper-slide">
                <div class="slide__container">
                    <?php echo wp_get_attachment_image( $image['id'], 'full' );?>
                </div>
            </div>
    <?php endwhile; endif;?>
</div>
<div class="swiper-pagination"></div>
<div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</div>

<?php
get_footer();