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
                    <h2 class="text-uppercase text-center"><?php echo get_the_title()?></h2>
                    <hr class="border border-3 w-50 title-separator">
                </div>
            </div>
        </div>
    </div>
</section>

<section id="pp-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div id="table-contents">
                    <div class="d-flex flex-row gap-4 bg-white p-4 justify-content-between pp_table-contents">
                        <div class="d-flex align-items-start">
                            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <button class="nav-link active" id="questao_tab" data-bs-toggle="pill" data-bs-target="#questao_content" type="button" role="tab" aria-controls="questao_content" aria-selected="true">Questão abordada pelo filme</button>
                                <button class="nav-link" id="problematica_tab" data-bs-toggle="pill" data-bs-target="#problematica_content" type="button" role="tab" aria-controls="problematica_content" aria-selected="false">Descrição da problemática</button>
                                <button class="nav-link" id="metodologia_tab" data-bs-toggle="pill" data-bs-target="#metodologia_content" type="button" role="tab" aria-controls="metodologia_content" aria-selected="false">Metodologia Proposta</button>
                                <button class="nav-link" id="atividades_tab" data-bs-toggle="pill" data-bs-target="#atividades_content" type="button" role="tab" aria-controls="atividades_content" aria-selected="false">Atividades Propostas</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="d-flex flex-row gap-4 bg-white p-4 justify-content-between mb-4 pp_meta">
                    <div class="d-flex flex-row gap-2">
                        <span class="fw-bold pp_author">Autor: </span>
                        <span><?php
                        $user = get_userdata(get_post_field ('post_author', get_the_ID()));
                        echo $user->display_name?></span>
                    </div>
                    <div class="d-flex flex-row gap-2">
                        <span class="fw-bold pp_date">Data de Publicação: </span>
                        <span><?php echo get_the_date()?></span>
                    </div>
                </div>
                <div class="bg-white p-4 tab-content" id="v-pills-tabContent">
                    <?php $objPP = pods('pratica_pedagogica', get_the_ID()); ?>
                    <div class="tab-pane fade show active" id="questao_content" role="tabpanel" aria-labelledby="questao_tab" tabindex="0">
                        <!-- <span class="fw-bold text-uppercase"> <?php echo $objPP->field('_field.pratica_questao_abordada.label') . ':'; ?></span> -->
                        <span> <?php echo $objPP->field('pratica_questao_abordada') ?> </span>
                    </div>
                    <div class="tab-pane fade" id="problematica_content" role="tabpanel" aria-labelledby="problematica_tab" tabindex="0">
                        <!-- <span class="fw-bold text-uppercase"> <?php echo $objPP->field('_field.pratica_problematica.label') . ':'; ?></span> -->
                        <span> <?php echo $objPP->field('pratica_problematica') ?> </span>
                    </div>
                    <div class="tab-pane fade" id="metodologia_content" role="tabpanel" aria-labelledby="metodologia_tab" tabindex="0">
                        <span class="fw-bold text-uppercase"> <?php echo $objPP->field('pratica_metodologia_titulo'); ?></span>
                            <?php
                                echo $objPP->display('pratica_metodologia_texto');
                                $objetivos = $objPP->field('pratica_metodologia_objetivos')
                            ?>

                            <span class="fw-bold text-uppercase">Objetivos</span>

                            <ol>

                            <?php
                                foreach($objetivos as $objetivo){
                                    echo '<li>' . $objetivo . '</li>';
                                }
                            ?>
                            </ol>
                    </div>
                    <div class="tab-pane fade" id="atividades_content" role="tabpanel" aria-labelledby="atividades_tab" tabindex="0">
                        <div class="accordion" id="accordionAtividades">
                            <?php
                            $atividades = pods_field('atividades_propostas');
                            foreach($atividades as $atividade){?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="atividade-head-<?php echo $atividade['id'];?>">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#atividade-content-<?php echo $atividade['id'];?>" aria-expanded="true" aria-controls="">
                                            <?php echo $atividade['atividade_nome']; ?>
                                        </button>
                                    </h2>
                                    <div id="atividade-content-<?php echo $atividade['id'];?>" class="accordion-collapse collapse" aria-labelledby="atividade-head-<?php echo $atividade['id']?>" data-bs-parent="#accordionAtividades">
                                        <div class="accordion-body">
                                            <?php echo $atividade['atividade_descricao']; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="bg-white p-4 d-flex flex-column gap-4 align-items-center pp_documentario">
                    <span class="fw-bold pp_doc_heading">DOCUMENTARIO RELACIONADO</span>
                    <?php

                        $origem = pods_field('pratica_origem');
                        $origemID = $origem['ID'];

                        $pod = pods('documentario', $origemID);
                        $direcao = strip_tags(get_the_term_list($origemID, 'direcao', '', ', '));
                        $imagem = $pod->display( 'documentario_poster_poster._img.large' );
                    ?>
                    <?php echo $imagem; ?>
                    <div class="d-flex flex-column align-items-center gap-2 pp_doc_titulo">
                        <span class="fw-bold">TITULO</span>
                        <span><?php echo get_the_title($origemID)?></span>
                    </div>
                    <div class="d-flex flex-column align-items-center gap-2 pp_doc_duracao">
                        <span class="fw-bold">DURAÇÃO</span>
                        <span><?php echo $pod->display('documentario_duracao')?> min</span>
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