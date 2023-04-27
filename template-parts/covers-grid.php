<?php ?>
<div class="swiper">
    <div class="swiper-wrapper">
        <?php
        $query_args = array(
            'post_type'   => 'documentario',
            'posts_per_page' => -1,
            'meta_query'  => array(
                array(
                    'value'   => '1',
                    'compare' => 'LIKE',
                    'key'     => 'documentario_destaque',
                ),
            )
        );
        $query = new WP_Query($query_args);
        if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();  ?>
                <div class="swiper-slide">
                    <?php get_template_part( 'template-parts/documentary-slide' ) ?>
                </div>
            <?php endwhile; // end of the loop.
            wp_reset_query();
        else : ?>
            <span>Sem resultados.</span>
        <?php endif; ?>
    </div>
    <div class="swiper-pagination"></div>

    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

    <div class="swiper-scrollbar"></div>
</div>