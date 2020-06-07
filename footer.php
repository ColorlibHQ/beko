<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package
 */

    $url = 'https://colorlib.com/';
    $copyText = sprintf( __( 'Theme by %s colorlib %s Copyright &copy; %s  |  All rights reserved.', 'beko' ), '<a target="_blank" href="' . esc_url( $url ) . '">', '</a>', date( 'Y' ) );
    $copyRight = !empty( beko_opt( 'beko_footer_copyright_text' ) ) ? beko_opt( 'beko_footer_copyright_text' ) : $copyText;
    $footer_logo = get_theme_mod( 'footer_logo' );
    $footer_logo_src = wp_get_attachment_image_src( $footer_logo, 'beko_logo_145x32' );
    $footer_class = beko_opt( 'beko_footer_widget_toggle' ) == 1 ? ' footer-area' : ' no_widget';
    $black_class = !is_page( array( 'Homepage', 'Fighter', 'Team Matches' ) ) ? ' black' : '';
    ?>

        <!-- footer part start-->
        
        <footer class="footer_part<?php echo esc_attr($footer_class) . $black_class;?>">
            <div class="footer_top">
                <div class="container">
                    <?php
                        if( beko_opt( 'beko_footer_widget_toggle' ) == 1 ) {
                    ?>
                    <div class="row">
                        <?php
                            // Footer Widget 1
                            if ( is_active_sidebar( 'footer-1' ) ) {
                                echo '<div class="col-sm-6 col-lg-3">';
                                    if( !empty( $footer_logo ) ) {
                                        echo '<a href="'. esc_url( home_url('/') ) .'" class="footer_logo_iner"> <img src="'. $footer_logo_src[0] .'" alt="footer logo"> </a>';    
                                    }
                                    dynamic_sidebar( 'footer-1' );
                                echo '</div>';
                            }

                            // Footer Widget 2
                            if ( is_active_sidebar( 'footer-2' ) ) {
                                dynamic_sidebar( 'footer-2' );
                            }

                            // Footer Widget 3
                            if ( is_active_sidebar( 'footer-3' ) ) {
                                dynamic_sidebar( 'footer-3' );
                            }

                            // Footer Widget 4
                            if ( is_active_sidebar( 'footer-4' ) ) {
                                dynamic_sidebar( 'footer-4' );
                            }
                        ?>
                    </div>
                        <?php
                        }
                    ?>
                </div>
            </div>
            
            <div class="copygight_text">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="copyright_text">
                                <p class="footer-text m-0"><?php echo wp_kses_post( $copyRight ); ?></p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="footer_icon social_icon">
                                <ul class="list-unstyled">
                                    <?php
                                    $social_opt = beko_opt('beko_social_profile_toggle');
                                    if ( $social_opt == true ) {
                                        $social_items = beko_opt('beko_header_social');
                                        if( is_array( $social_items ) && count( $social_items ) > 0 ){
                                            foreach ($social_items as $value) {
                                                echo '<li><a href="'. $value['social_url'] .'" class="single_social_icon"><i class="'. $value['social_icon'] .'"></i></a></li>';
                                            }
                                        }          
                                    }   
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <?php wp_footer(); ?>
    </body>
</html>