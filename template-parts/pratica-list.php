<?php

$query = new WP_Query(array(
    'post_type' => 'pratica_pedagogica',
    'meta_query' => array(
        array(
            'key' => 'pratica_origem',
            'value' => get_the_ID(),
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
                <a href="/adicionar-pratica-pedagogica?docID=<?php echo get_the_ID() ?>" class="btn btn-primary ms-auto">
                    Adicionar Nova
                </a>
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
            } else {
                echo '<h5>Ainda não temos práticas cadastradas para este documentário.</h5>';
            }
            ?>
        </div>
    </div>
</div>