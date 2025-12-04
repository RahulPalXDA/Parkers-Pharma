<?php
/**
 * Basic theme functions.
 */

function basic_theme_setup() {
    // Add support for document title tag
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'basic_theme_setup' );