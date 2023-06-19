<?php

/**
 * Template Name: Single Prática Pedagógica
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>

<section>
    <div class="w-50 m-auto p-5" id="cadastro">
        <ul class="nav nav-pills m-auto w-50 d-flex justify-content-center mb-4" id="cadastro-tabs" role="tablist">
            <li class="nav-item w-50" role="presentation">
                <button class="nav-link w-100 active" id="pills-aluno-tab" data-bs-toggle="pill" data-bs-target="#pills-aluno" type="button" role="tab" aria-controls="pills-aluno" aria-selected="true">aluno</button>
            </li>
            <li class="nav-item w-50" role="presentation">
                <button class="nav-link w-100" id="pills-professor-tab" data-bs-toggle="pill" data-bs-target="#pills-professor" type="button" role="tab" aria-controls="pills-professor" aria-selected="false">professor</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-aluno" role="tabpanel" aria-labelledby="pills-aluno-tab" tabindex="0">
                <?php echo do_shortcode('[forminator_form id="207"]') ?>
            </div>
            <div class="tab-pane fade" id="pills-professor" role="tabpanel" aria-labelledby="pills-professor-tab" tabindex="0">

            </div>
        </div>
    </div>
</section>



<?php
get_footer(); ?>