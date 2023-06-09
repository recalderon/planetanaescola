<?php

$directionBase = get_field('direcao');
$directionTemp = array();
foreach ($directionBase as $director) :
    $directionTemp[] = $director->name;
endforeach;

$countriesBase = get_field('paises');
$countriesTemp = array();
foreach ($countriesBase as $country) :
    $countriesTemp[] = $country['value'];
endforeach;

$countries = implode(', ', $countriesTemp);
$direction = implode(', ', $directionTemp);
$background = get_field('imagem_de_fundo');
$sinopse = get_field('sinopse');
$title = get_the_title();
$year = get_field('ano');
$link = get_field('link_vimeo');
$length = get_field('duracao');

?>

<div class="destaque_container">
    <div class="destaque_helper" style="background:linear-gradient(90deg, rgb(0, 0, 0) 0%, rgb(0, 0, 0) 35%, rgba(0, 0, 0, 0.27) 56%), url(<?php echo wp_get_attachment_url( $background) ?>); background-position-y: top">
        <div >
            <div class="p-5 text-white informacoes">
                <h1 class="titulo"><?php echo $title ?></h1>
                <p class="duracao"><?php echo $length . ' minutos'; ?></p>
                <p class="direcao"><span class="fw-bold label">Direção: </span><?php echo $direction ?></p>
                <p class="ano"><span class="fw-bold label">Ano: </span><?php echo $year; ?></p>
                <p class="paises"><span class="fw-bold label">Paises: </span><?php echo $countries; ?></p>
                <p class="sinopse"><span class="fw-bold label">Sinopse: </span><?php echo $sinopse; ?></p>

                <?php
                $pp_query = new WP_Query(array(
                    'post_type' => 'pratica_pedagogica',
                    'meta_query' => array(
                    array(
                        'key' => 'pratica_origem',
                        'value' => get_the_ID(),
                    ),
                    ),
                ));
                ?>

                <div class="d-flex flex-row align-items-center justify-content-between gap-5 pt-4">
                    <div class="d-flex flex-row justify-content-center align-items-center  gap-3 w-25">
                        <a class="btn btn-outline pne" href="<?php echo $link ; ?>" data-fancybox="video-gallery">
                            <i class="fa-solid fa-play icone-play-header"></i>
                            <span class="text-decoration-none fs-5">ASSISTIR AGORA</span>
                        </a>
                    </div>
                    <div class="d-flex flex-row align-items-center gap-4">
                        <a href="<?php echo get_the_permalink() ?>" class="text-decoration-none fw-bold link-pratica">
                            <p class="praticas_count m-0">
                                <i class="bi bi-mortarboard-fill"></i>
                                <?php echo $pp_query->found_posts ?> PRÁTICAS PEDAGÓGICAS
                            </p>
                        </a>
                        <a href="/adicionar-pratica-pedagogica?docID=<?php echo get_the_ID() ?>" class="text-decoration-none text-white fw-bold">
                            <i class="fa-solid fa-plus text-center add-pratica "></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if( !is_front_page() ){
        get_template_part('template-parts/pratica-list');
    }?>

</div>