<?php

/**
 * Template Name: Single Prática Pedagógica
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>

    <section class="m-4" id="pp-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-column align-items-center" id="title-wrapper">
                        <h2 class="text-uppercase text-center"><?php echo get_the_title() ?></h2>
                        <hr class="border border-3 w-50 title-separator">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="pp-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex flex-row gap-4 bg-white p-4 justify-content-between mb-4 pp_meta">
                                <div class="d-flex flex-row gap-2">
                                    <span class="fw-bold pp_author">Autor: </span>
                                    <span><?php
                                        $user = get_userdata(get_post_field('post_author', get_the_ID()));
                                        echo $user->display_name ?></span>
                                </div>
                                <div class="d-flex flex-row gap-2">
                                    <span class="fw-bold pp_date">Data de Publicação: </span>
                                    <span><?php echo get_the_date() ?></span>
                                </div>
                                <div class="d-flex flex-row gap-2">
                                    <span class="fw-bold pp_date">Compartilhar: </span>
                                    <i class="bi bi-facebook"></i>
                                    <i class="bi bi-whatsapp"></i>
                                    <i class="bi bi-telegram"></i>
                                    <i class="bi bi-envelope-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row gx-0">
                        <div class="col-lg-3">
                            <div id="table-contents">
                                <div class="d-flex flex-row gap-4 bg-white justify-content-between pp_table-contents">
                                    <div class="d-flex align-items-start">
                                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                             aria-orientation="vertical">
                                            <button class="nav-link position-relative active" id="problematica_tab"
                                                    data-bs-toggle="pill" data-bs-target="#problematica_content"
                                                    type="button" role="tab" aria-controls="problematica_content"
                                                    aria-selected="false">Descrição da problemática
                                            </button>
                                            <button class="nav-link position-relative " id="metodologia_tab"
                                                    data-bs-toggle="pill" data-bs-target="#metodologia_content"
                                                    type="button" role="tab" aria-controls="metodologia_content"
                                                    aria-selected="false">Metodologia Proposta
                                            </button>
                                            <button class="nav-link position-relative " id="atividades_tab"
                                                    data-bs-toggle="pill" data-bs-target="#atividades_content"
                                                    type="button" role="tab" aria-controls="atividades_content"
                                                    aria-selected="false">Atividades Propostas
                                            </button>
                                            <button class="nav-link position-relative " id="atividades_tab"
                                                    data-bs-toggle="pill" data-bs-target="#materiais_content"
                                                    type="button" role="tab" aria-controls="mtividades_content"
                                                    aria-selected="false">Materiais Associados
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="bg-white p-4 tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="problematica_content" role="tabpanel"
                                     aria-labelledby="problematica_tab" tabindex="0">
                                    <span> <?php echo get_field('problematica');?> </span>
                                </div>
                                <div class="tab-pane fade" id="metodologia_content" role="tabpanel"
                                     aria-labelledby="metodologia_tab" tabindex="0">
                                    <span class="fw-bold text-uppercase"> <?php echo get_field('metodologia_titulo');?> </span>
                                    <p><?php echo get_field('metodologia_descricao');?></p>
                                </div>
                                <div class="tab-pane fade" id="atividades_content" role="tabpanel"
                                     aria-labelledby="atividades_tab" tabindex="0">
                                    <div class="accordion accordion-flush" id="accordionAtividades">
                                        <?php
                                        //$atividades = pods_field('atividades_propostas');
                                        $gfid = get_post_custom_values('_gravityformsadvancedpostcreation_entry_id', get_the_ID())[0];

                                        if (GFAPI::entry_exists($gfid)) {
                                            $atividades = GFAPI::get_entry($gfid)[1000];
                                            $count = 0;
                                            foreach ($atividades as $atividade) {
                                                $count++; ?>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header"
                                                        id="atividade-head-<?php echo $count; ?>">
                                                        <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#atividade-content-<?php echo $count; ?>"
                                                                aria-expanded="true" aria-controls="">
                                                            <?php echo $atividade[1002]; ?>
                                                        </button>
                                                    </h2>
                                                    <div id="atividade-content-<?php echo $count; ?>"
                                                         class="accordion-collapse collapse"
                                                         aria-labelledby="atividade-head-<?php echo $count ?>"
                                                         data-bs-parent="#accordionAtividades">
                                                        <div class="accordion-body">
                                                            <?php echo $atividade[1003]; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        } ?>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="materiais_content" role="tabpanel"
                                     aria-labelledby="materiais_tab" tabindex="0">
                                        <?php
                                        $gfid = get_post_custom_values('_gravityformsadvancedpostcreation_entry_id', get_the_ID())[0];
                                        if (GFAPI::entry_exists($gfid)) {
                                            $materiais = GFAPI::get_entry($gfid)[1004];
                                            $count = 0; ?>
                                            <ol class="list-group list-group-numbered">
                                                <?php foreach ($materiais as $material) {?>
                                                    <li class="list-group-item d-flex align-items-start">
                                                        <?php echo '&nbsp;' . $material[1006]; ?>
                                                        <a href="<?php echo esc_url($material[1005]); ?>" class="ms-auto material-associado" aria-current="true">
                                                            <i class="bi bi-globe"></i>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ol>
                                        <?php } ?>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="bg-white p-4 d-flex flex-column gap-4 align-items-center pp_documentario">
                        <span class="fw-bold pp_doc_heading text-center">DOCUMENTARIO RELACIONADO</span>
                        <?php

                        $origemID = get_field('documentario_relacionado');
                        $length = get_field('informacoes_principais_duracao');

                        setup_postdata($origemID);

                        $direcao = strip_tags(get_the_term_list($origemID, 'direcao', '', ', '));
                        //$imagem = $pod->display('documentario_poster_poster._img.large');
                        ?>
                        <?php echo $imagem; ?>
                        <div class="d-flex flex-column align-items-center gap-2 pp_doc_titulo">
                            <span class="fw-bold">TITULO</span>
                            <span><?php echo get_the_title($origemID) ?></span>
                        </div>
                        <div class="d-flex flex-column align-items-center gap-2 pp_doc_duracao">
                            <span class="fw-bold">DURAÇÃO</span>
                            <span><?php echo $length ?> min</span>
                        </div>
                        <div class="d-flex flex-column align-items-center gap-2 pp_doc_direcao">
                            <span class="fw-bold">DIREÇÃO</span>
                            <span><?php echo $direcao; ?></span>
                        </div>
                        <div class="d-flex flex-column align-items-center gap-2 pp_doc_indicacao">
                            <span class="fw-bold">INDICAÇÃO</span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer(); ?>