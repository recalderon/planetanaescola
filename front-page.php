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

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</section>

<section id="featured-card">
    <?php
        $settings = pods('configuracoes_de_tema');
        $related = $settings->field('documentario_destacado');
        $idpostdestaque = $related['pod_item_id'];

        $args = array(
            'p'         => $idpostdestaque,
            'post_type' => 'documentario'
        );
        $featured_post = new WP_Query($args);
        if ($featured_post->have_posts()) : while ($featured_post->have_posts()) : $featured_post->the_post();
        get_template_part( 'template-parts/documentary' );
        endwhile;
        wp_reset_query();
        else : ?>
            <span>Sem resultados.</span>
    <?php
        endif;
    ?>
</section>

<section class="my-4" id="poster-grid">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php
                    $terms = get_terms( array(
                        'taxonomy'   => 'temas',
                        'hide_empty' => false,
                    ) );
                    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                        foreach ( $terms as $term ) {
                            ?>
                            <div class="cover-carousel">
                                <h5 class="text-uppercase fw-bold temas_heading"><?php echo $term->name ?></h5>
                                <div class="swiper my-4">
                                    <div class="swiper-wrapper">
                                        <?php
                                            $params = array(
                                                'limit' => -1,
                                                'where'=>"temas.Slug = '". $term->slug ."'" ,
                                            );

                                            $pods = pods( 'documentario' )->find( $params );
                                                if ( $pods->total() > 0 ) {
                                                    while( $pods->fetch() )  {
                                                        $direction = strip_tags(get_the_term_list($pods->id(), 'direcao', '', ', '));
                                                        $imagem = $pods->display( 'documentario_thumb._img.poster_paginaprincipal' );
                                                        $sinopse = $pods->field('documentario_sinopse');
                                                        $title = get_the_title($pods->id());
                                                        $year = $pods->field('documentario_ano');
                                                        $link = get_the_permalink($pods->id());
                                                        ?>
                                                        <div class="swiper-slide h-100 position-relative">
                                                            <div class="d-flex flex-column doc_content">
                                                                <div class="doc_thumb">
                                                                    <?php echo $imagem; ?>
                                                                </div>
                                                                <div class="h-100 small position-absolute d-flex flex-column doc_info visually-hidden ">
                                                                    <div class="d-flex flex-column px-4 pt-4 gap-2 justify-content-center h-100">
                                                                        <span class="fw-bold text-uppercase doc_title"><?php echo $title;?> (<?php echo $year ;?>)</span>
                                                                        <span>Direção: <?php echo $direction;?></span>
                                                                        <p> <?php echo $sinopse ; ?></p>
                                                                    </div>

                                                                    <div class="bg-white w-100 small fw-bold text-center py-2 mt-auto">
                                                                    <?php if(is_user_logged_in()){?>
                                                                        <a href="<?php echo $link;?>">ASSISTIR</a>
                                                                    <?php
                                                                    } else{?>
                                                                        FAÇA <a href="<?php echo esc_url( wp_registration_url() ); ?>">CADASTRO</a> OU <a href="<?php echo esc_url( wp_login_url() ); ?>">LOGIN </a> PARA REPRODUZIR
                                                                    <?php } ?>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <?php
                                                    }
                                                    echo $pods->pagination();
                                                }

                                                else {  echo '<span>Sem conteúdo para mostrar.</span>'; }
                                        ?>
                                    </div>

                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</section>

<?php
get_footer(); ?>