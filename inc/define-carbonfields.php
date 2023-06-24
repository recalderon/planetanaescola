<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'fieldsForDocumentarios' );


function fieldsForDocumentarios() {
    $request = wp_remote_get(get_theme_file_uri() . '/assets/dist/data/paises.json');
    $body = wp_remote_retrieve_body( $request );
    $data = json_decode( $body );

    $terms = get_terms(array(
        'taxonomy'   => 'tema',
        'hide_empty' => false,
    ));

    $arrayDisciplinas = array();
    foreach ($terms as $term) :
        $arrayDisciplinas[$term->term_id] = $term->name;
    endforeach;

    $arrayPaisesClean = array();
    foreach ($data as $pais) :
        $arrayPaisesClean[$pais->nome] = $pais->nome;
    endforeach;

    array_unshift($arrayPaisesClean , 'Selecione uma ');

    Container::make( 'post_meta', 'Informações' ) // Adds metabox on post edition screen
        ->where( 'post_type', '=', 'documentario' ) // Only shows on front-page
        ->add_fields( array(
            Field::make( 'select', 'disciplinas', 'Disciplinas' )
                ->add_options($arrayDisciplinas),
            Field::make( 'select', 'paises', 'Paises' )
                ->set_classes( 'slPaises' )
                ->add_options($arrayPaisesClean),
            Field::make( 'textarea', 'slide_text1', 'Linha 1' ),
            Field::make( 'textarea', 'slide_text2', 'Linha 2' ),
            Field::make( 'image', 'slide_image', 'Fundo' ),
            Field::make( 'complex', 'fg_slides', 'Slides' ) // Sets name and slug of field
            	->set_layout( 'tabbed-horizontal' ) // Sets visual layout of field
            	->add_fields( array(
                    Field::make( 'text', 'slide_nomedoslide', 'Nome' ),
            		Field::make( 'textarea', 'slide_text1', 'Linha 1' ),
            		Field::make( 'textarea', 'slide_text2', 'Linha 2' ),
            		Field::make( 'image', 'slide_image', 'Fundo' )
                        ->set_value_type( 'url' ),
            	) )
                ->set_header_template( '
                    <% if (slide_nomedoslide) { %>
                        <%- slide_nomedoslide %>
                    <% } else { %>
                        empty
                    <% } %>
                ' )
        ) );

}