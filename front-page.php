<?php

/**
 * Template Name: Página Principal
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>

<section id="featured-carousel">
    <div class="swiper">
        <div class="swiper-wrapper">
            <?php
            $query_args = array(
                'post_type'   => 'documentario',
                'posts_per_page' => -1,
                // 'meta_query'  => array(
                //     array(
                //         'value'   => '1',
                //         'compare' => 'LIKE',
                //         'key'     => 'documentario_destaque',
                //     ),
                // )
            );
            $query = new WP_Query($query_args);
            if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();  ?>
                    <div class="swiper-slide">
                        <?php
                        setup_postdata( $post );
                        get_template_part('template-parts/documentary', 'slide-header');
                        ?>

                    </div>
                <?php endwhile; // end of the loop.
                wp_reset_query();
            else : ?>
                <span>Sem resultados.</span>
            <?php endif; ?>
        </div>

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</section>

<section class="bg-white py-4" id="filter-selects">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-row justify-content-center gap-5">
                    <div style="flex: 1">
                        <label for="floatingSelect" class="fw-bold  mb-2">Tipo de conteúdo</label>
                        <select id="select-tipo" aria-label="Floating label select example">
                            <option data-placeholder="true"></option>
                            <option value="documentario">Documentario</option>
                            <option value="pratica-pedagogica">Prática Pedagogica</option>
                        </select>
                    </div>
                    <div style="flex: 1">
                        <label for="floatingSelect" class="fw-bold mb-2">Temas</label>
                        <select class="form-select" id="select-temas" multiple></select>
                    </div>
                    <div style="flex: 1">
                        <label for="floatingSelect" class="fw-bold mb-2">Segmentos Escolares</label>
                        <select class="form-select" id="select-segmentos" multiple></select>
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <button class="btn btn-primary " id="pesquisa-filtros">Pesquisar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    if(get_theme_mod( 'pne_frontpage--featured-doc', '' )){
        echo '<section id="featured-card">';
            $post = get_post(get_theme_mod( 'pne_frontpage--featured-doc', '' ));
            setup_postdata($post);
            get_template_part('template-parts/documentary');
        echo '</section>';
    }
    if (!is_user_logged_in() && get_theme_mod( 'pne_footer--cta-message', '' ) && get_theme_mod( 'pne_footer--cta-botao', '' )){
        ?>
        <section class="bg-white py-4" id="cta-home">
            <div class="d-flex flex-row align-items-center mx-5">
                <div class="flex-grow-1 text-uppercase fw-bold">
                    <?php
                    echo get_theme_mod( 'pne_footer--cta-message', '' );
                    ?>
                </div>
                <a class="btn btn-primary" href="<?php echo esc_url(wp_login_url()); ?>"><?php echo get_theme_mod( 'pne_footer--cta-botao', '' );?></a>
            </div>
        </section>
        <?php
    };
?>

<section class="py-5" id="poster-grid">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-column gap-5">
                    <?php
                    $terms = get_terms(array(
                        'taxonomy'   => 'tema',
                        'hide_empty' => true,
                    ));
                    if (!empty($terms) && !is_wp_error($terms)) {
                        foreach ($terms as $term) :
                        ?>
                            <div class="cover-carousel">
                                <h5 class="text-uppercase fw-bold temas_heading"><?php echo $term->name ?></h5>
                                <div class="swiper temas my-4">
                                    <div class="swiper-wrapper">
                                        <?php
                                        $args = array(
                                            'post_type' => array( 'documentario' ),
                                            'post_status' => array( 'publish' ),
                                            'post_per_page' => -1,
                                            'orderby'        => 'title',
                                            'order'          => 'ASC',
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'tema',
                                                    'field' => 'slug',
                                                    'terms' => $term->slug,
                                                )
                                            )
                                        );

                                        // The Query
                                        $posts = new WP_Query( $args );
                                        $posts = $posts->get_posts();

                                        foreach( $posts as $post ) {
                                            ?>
                                            <div class="swiper-slide position-relative">
                                                <?php
                                                setup_postdata( $post );
                                                get_template_part('template-parts/documentary', 'slide');
                                                ?>
                                            </div>
                                            <?php
                                        }
                                        wp_reset_postdata();
                                        ?>
                                    </div>

                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>
                            </div>
                    <?php
                        endforeach;
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>
</section>

<?php
get_footer(); ?>