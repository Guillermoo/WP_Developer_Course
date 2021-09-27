<div class="hero-slider__slide" style="background-image: url(<?php the_post_thumbnail_url('backgroundSlider'); ?>)">
    <div class="hero-slider__interior container">
        <div class="hero-slider__overlay">
            <h2 class="headline headline--medium t-center"><?php the_title(); ?></h2>
            <p class="t-center"><?php echo get_field('page_banner_subtitle'); ?></p>
            <p class="t-center no-margin"><a href="#" class="btn btn--blue"><?php echo get_field('button_name') ?></a></p>
        </div>
    </div>
</div>