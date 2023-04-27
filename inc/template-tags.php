<?php

if (!function_exists('florgenerosa_post_meta')):
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function florgenerosa_post_meta()
    {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date('c')),
            esc_html(get_the_date())
        );

        $posted_on = sprintf(
            esc_html_x('Postado em %s', 'data do post'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );

        $byline = sprintf(
            esc_html_x('por %s', 'post author'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        $categories = get_the_category();
        if (!empty($categories)) {
            echo ' <div class="col-6"> <a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a></div> ';
        }

        echo '
    <div class="col-6">
        <span class="posted-on">' . $posted_on . '</span>
    </div>
    '; // WPCS: XSS OK.


    }
endif;


if (!function_exists('florgenerosa_post_footer')):
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function florgenerosa_post_footer()
    {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(', '));
            if ($categories_list) {
                printf('<span class="cat-links">' . esc_html__('Posted in %1$s') . '</span>', $categories_list); // WPCS: XSS OK.
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html__(', ', 'wp-bootstrap-starter'));
            if ($tags_list) {
                printf(' | <span class="tags-links">' . esc_html__('Tagged %1$s') . '</span>', $tags_list); // WPCS: XSS OK.
            }
        }

        edit_post_link(
            sprintf(
                /* translators: %s: Name of current post */
                esc_html__('Edit %s', 'wp-bootstrap-starter'),
                the_title('<span class="screen-reader-text">"', '"</span>', false)
            ),
            ' | <span class="edit-link">',
            '</span>'
        );
    }
endif;