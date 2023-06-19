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
$thumb = get_field('thumbnail');
$sinopse = get_field('sinopse');
$title = get_the_title();
$year = get_field('ano');
$link = get_field('link_vimeo');
$length = get_field('duracao');
?>

<div class="d-flex flex-column doc_content">
    <div class="doc_thumb">
        <?php echo wp_get_attachment_image($thumb, 'poster_paginaprincipal', "", array("class" => "img-fluid")); ?>
    </div>
    <div class="h-100 small position-absolute d-flex flex-column doc_info visually-hidden ">
        <div class="d-flex flex-column px-4 pt-4 gap-2 justify-content-center h-100">
            <span class="fw-bold text-uppercase doc_title"><?php echo $title; ?> (<?php echo $year; ?>)</span>
            <span>Direção: <?php echo $direction; ?></span>
            <p> <?php echo $sinopse; ?></p>
        </div>

        <div class="bg-white w-100 small fw-bold text-center py-2 mt-auto">
            <?php if (is_user_logged_in()) { ?>
                <a href="<?php echo get_the_permalink() ?>" data-fancybox data-src="#dialog-content">ASSISTIR</a>
            <?php
            } else { ?>
                FAÇA <a href="<?php echo esc_url(wp_registration_url()); ?>">CADASTRO</a> OU <a href="<?php echo esc_url(wp_login_url()); ?>">LOGIN </a> PARA REPRODUZIR
            <?php } ?>
        </div>
    </div>
</div>

<div id="dialog-content" style="display:none;">

    <?php echo wp_oembed_get( $link, array( 'width' => 900 ) ); ?>
</div>