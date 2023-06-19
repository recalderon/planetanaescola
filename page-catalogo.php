<?php

/**
 * Template Name: Single Prática Pedagógica
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>
<div class="container-xxl">
    <div class="row">
        <div class="col-lg-2">
            <div class="py-4 d-flex flex-column gap-2 term-group">
                <h4 class="fw-bold heading-temas">Temas</h4>

                <?php
                    $categories = get_categories();
                    $terms = get_terms(array(
                        'taxonomy'   => 'tema',
                        'hide_empty' => false,
                    ));
                ?>
                <?php foreach ($terms as $term) : ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="<?= $term->slug; ?>" data-cat-id="<?= $term->term_id; ?>" data-search-arg="temas">
                        <label class="form-check-label" for="<?= $term->slug; ?>">
                            <?= $term->name; ?>
                        </label>
                    </div>
                <?php
                    endforeach;
                    unset($terms);
                    unset($term)
                ?>
            </div>

            <div class="py-4 d-flex flex-column gap-2  term-group">
                <h4 class="fw-bold heading-temas">Segmentos Escolares</h4>

                <?php
                    $terms = get_terms(array(
                        'taxonomy'   => 'segmento_escolar',
                        'hide_empty' => false,
                        'orderby' => 'term_id'
                    ));

                    foreach ($terms as $term) {
                        if ($term->parent == 0) {
                            $parent_terms[] = $term;
                        }
                    }

                    foreach ($parent_terms as $parent) {
                        if($parent->slug == 'ensino-infantil'){
                            echo '<div class="py-2 d-flex flex-column gap-2  segmento-group">';
                            echo '<div class="form-check">';
                            echo '<input class="form-check-input" type="checkbox" id="' . $parent->slug . 'data-cat-id="' . $parent->term_id . '">';
                            echo '<label class="form-check-label" for="' . $parent->slug . '">';
                            echo $parent->name;
                            echo '</label>';
                            echo '</div>';
                            echo '</div>';
                        }else{
                            echo '<div class="py-2  d-flex flex-column gap-2  segmento-group">';
                            $child_terms = get_terms(array(
                                'taxonomy'   => 'segmento_escolar',
                                'child_of' => $parent->term_id,
                                'hide_empty' => false,
                                'orderby' => 'term_id'
                            ));

                            echo '<span class="fw-bold heading-temas" >' . $parent->name . ' </span>';

                            foreach ($child_terms as $child) {
                                echo '<div class="form-check">';
                                echo '<input class="form-check-input" type="checkbox" id="' . $child->slug . 'data-cat-id="' . $child->term_id . '">';
                                echo '<label class="form-check-label" for="' . $child->slug . '">';
                                echo $child->name;
                                echo '</label>';
                                echo '</div>';
                            };
                            echo '</div>';
                        }
                    }
                ?>
            </div>

            <div class="d-flex flex-row justify-content-between">
                <button class="btn btn-primary " id="realizar-pesquisa">Pesquisar</button>
                <button class="btn btn-primary " id="limpar-pesquisa">Limpar</button>
            </div>


        </div>
        <div class="col-lg-10" >
            <div class="row" id="grid-wrapper"></div>

            <div class="pagination-section">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link prev" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link next" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<?php
get_footer(); ?>