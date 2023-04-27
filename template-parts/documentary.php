<?php

$pod = pods('documentario', get_the_ID());
$sinopse   = $pod->field('documentario_sinopse');
$duracao  = $pod->display('documentario_duracao');
$anoEscolar = $pod->field('documentario_niveis');
$ano = $pod->display('documentario_ano');
$paises = pods_field_raw('documentario_pais');
$direcao = strip_tags(get_the_term_list(get_the_ID(), 'direcao', '', ', '));
$temas = strip_tags(get_the_term_list(get_the_ID(), 'temas', '', ', '));
$disciplinas = strip_tags(get_the_term_list(get_the_ID(), 'disciplinas', '', ', '));
$link = wp_oembed_get($pod->field('documentario_link'));
$imagem = $pod->display('documentario_imagem_destaque');
$origem = pods('praticas-pedagogicas');

if ( $pod->exists()) {
    ?>
    <div class="destaque_container">
        <div class="destaque_helper" style="background-image: url(<?php echo $imagem ?>);">
            <div class="d-flex flex-row justify-content-center py-5">
                <div class="p-5 text-white w-25 informacoes">
                    <h1 class="titulo"><?php echo get_the_title(get_the_ID()) ?></h1>
                    <p class="duracao"><?php echo $duracao . ' minutos'; ?></p>
                    <p class="direcao"><span class="fw-bold label">Direção: </span><?php echo $direcao; ?></p>
                    <!-- <p class="anoEscolar"><span class="fw-bold label">Ano Escolar Indicado: </span><?php //echo implode(", ", $anoEscolar);?></p> -->
                    <p class="ano <?php echo $ano !== '' ? 'd-block' : 'd-none' ?>">
                        <span class="fw-bold label">Ano: </span><?php echo $ano !== '' ? str_replace(".", "", $ano) : ''; ?>
                    </p>
                    <p class="paises <?php echo $paises !== '' ? 'd-block' : 'd-none' ?>">
                        <span class="fw-bold label">Paises: </span><?php echo is_array($paises) ? implode("/", $paises) : $paises; ?>
                    </p>
                    <p class="sinopse"><span class="fw-bold label">Sinopse: </span><?php echo $sinopse; ?></p>
                    <?php
                    $pp_query = new WP_Query(array(
                        'post_type' => 'pratica_pedagogica',
                        'meta_query' => array(
                        array(
                            'key' => 'pratica_origem',
                            'value' => get_the_ID(), // The current object ID: <code>people</code> post
                        ),
                        ),
                    ));
                    ?>

                    <div class="d-flex flex-row align-items-center justify-content-center">
                        <a href="<?php echo get_the_permalink() ?>" class="text-decoration-none text-white fw-bold"><p class="praticas_count m-0"><i class="bi bi-mortarboard-fill"></i> <?php echo $pp_query->found_posts ?> PRÁTICAS PEDAGÓGICAS</p></a>
                    </div>
                </div>
                <div class="p-5 w-35 d-flex flex-column justify-content-center">
                    <?php echo $link ?>
                </div>
            </div>
        </div>

        <?php
        if( !is_front_page() ){
            $query = new WP_Query(array(
                'post_type' => 'pratica_pedagogica',
                'meta_query' => array(
                    array(
                        'key' => 'pratica_origem',
                        'value' => get_the_ID(), // The current object ID: <code>people</code> post
                    ),
                ),
            ));
        ?>
            <div class="container">
                <div class="row py-5 justify-content-center">
                    <hr>
                    <div class="col-12 my-5">
                        <div class="d-flex flex-row ">
                            <h4>VEJA COMO OUTROS PROFESSORES UTILIZARAM ESTE FILME EM SALA DE AULA</h4>
                            <button class="btn btn-primary ms-auto">Adicionar Nova</button>
                        </div>
                    </div>
                    <hr>
                    <div class="col-8 mt-5">
                        <?php
                            if ($query->have_posts()) {
                                while ($query->have_posts()) {
                                    $query->the_post();
                                    echo '<div><p class="fw-bold pratica_titulo">' . get_the_title() . '</p>';
                                    echo '<p> Por ' . get_the_author() . '</p>';
                                    echo '<a class="small fw-bold pratica_leiamais" href="' . get_the_permalink() . ' "> LEIA MAIS ></a>';
                                    echo '</div>';
                                }
                            }else{
                                echo '<h5>Ainda não temos práticas cadastradas para este documentário.</h5>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        <?php
            }
        ?>

    </div>
    <?php

} else{
    echo 'Algo deu errado. Entre em contato.';
}

?>