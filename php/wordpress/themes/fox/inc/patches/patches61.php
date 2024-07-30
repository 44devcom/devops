<?php
class FOX_Patches61 {

    function __construct() {
        $thefox_version = get_option( 'fox_patch_version' );
        if ( ! $thefox_version ) {
            $thefox_version = '6.0';
        }
        if ( version_compare( $thefox_version, '6.1', '>=' ) || version_compare( $thefox_version, '6.0', '<' ) ) {
            return;
        }
        $this->run();
    }

    // $cat is string, has form cat--ID
    function convert_cat_id_to_slug( $cat ) {
        if ( substr( $cat, 0, 5 ) == 'cat--' ) {
            $ID = substr( $cat, 5 );
            if ( is_numeric( $ID ) ) {
                $c = get_term_by( 'id', intval( $ID ), 'category' );
                if ( $c ) {
                    $slug = $c->slug;
                    return $slug;
                }
            }
        }
    }

    function run() {

        /* move all category IDs -> cateogry slugs for all builder sections
        --------------------------------------------- */
        $builder = get_theme_mod( 'h', [] );
        $secitonlist = isset( $builder['sectionlist'] ) ? $builder['sectionlist'] : [];
        foreach ( $secitonlist as $section_id ) {
            $section = get_theme_mod( $section_id, [] );
            
            // categories
            $categories = isset( $section[ 'categories' ] ) ? $section[ 'categories' ] : [];
            if ( ! empty( $categories ) ) {
                $new_categories = [];
                foreach ( $categories as $cat ) {
                    $slug = $this->convert_cat_id_to_slug( $cat );
                    if ( $slug ) {
                        $new_categories[] = 'cat--' . $slug;
                    }
                }
                $section[ 'categories' ] = $new_categories;
            }

            // exclude categories
            $exclude_categories = isset( $section[ 'exclude_categories' ] ) ? $section[ 'exclude_categories' ] : [];
            if ( ! empty( $exclude_categories ) ) {
                $new_categories = [];
                foreach ( $exclude_categories as $cat ) {
                    $slug = $this->convert_cat_id_to_slug( $cat );
                    if ( $slug ) {
                        $new_categories[] = 'cat--' . $slug;
                    }
                }
                $section[ 'exclude_categories' ] = $new_categories;
            }

            set_theme_mod( $section_id, $section );

        }

        /* set new version
        --------------------------------------------- */
        update_option( 'fox_patch_version', '6.1' );

    }

}
new FOX_Patches61();