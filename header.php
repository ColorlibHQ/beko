<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <!-- For Resposive Device -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php 
            echo beko_site_icon();
            wp_head();
            $pagename = get_query_var('pagename');
        ?>
    </head>
    <body <?php body_class( $pagename ); ?>>

    <div class="body_bg">
        <!--::header part start::-->
        <header class="main_menu single_page_menu">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <?php
                                echo beko_theme_logo( 'navbar-brand' );
                            ?>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <?php
                                if(has_nav_menu('primary-menu')) {
                                    wp_nav_menu(array(
                                        'menu'           => 'primary-menu',
                                        'theme_location' => 'primary-menu',
                                        'menu_id'        => 'menu-main-menu',
                                        'container_class'=> 'collapse navbar-collapse main-menu-item',
                                        'container_id'   => 'navbarSupportedContent',
                                        'menu_class'     => 'navbar-nav',
                                        'walker'         => new beko_bootstrap_navwalker,
                                        'depth'          => 3
                                    ));
                                }

                                // Header Button
                                if( beko_opt( 'beko_header_btn' ) == 1 ){
                                    $btn_lbl = !empty( beko_opt( 'header_btn_label' ) ) ? beko_opt( 'header_btn_label' ) : '';
                                    $btn_url = !empty( beko_opt( 'booking_btn_url' ) ) ? beko_opt( 'booking_btn_url' ) : '';
                                    ?>
                                    <a href="<?php echo esc_url($btn_url)?>" class="btn_1 d-none d-sm-block"><?php echo esc_html($btn_lbl)?></a>
                                    <?php 
                                } ?>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header part end-->

        <?php
        //Page Title Bar
        if( function_exists( 'beko_page_titlebar' ) ){
            beko_page_titlebar();
        }

