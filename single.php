<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package DadeCore_Theme
 */

get_header();
?>

    <main id="primary" class="site-main">

        <?php
        while ( have_posts() ) :
            the_post();

            // Aquí puedes incluir el contenido de tu post.
            // Por simplicidad, mostraremos título, contenido y quizás la imagen destacada.
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-post-item section-padding'); ?>>
                <div class="container">
                    <header class="entry-header">
                        <?php the_title( '<h1 class="entry-title section-title">', '</h1>' ); ?>
                        <div class="entry-meta section-subtitle">
                            <?php
                            // Información del post: autor, fecha, categorías
                            printf(
                                esc_html__( 'Publicado el %1$s por %2$s en %3$s', 'dadecore-theme' ),
                                '<time datetime="' . esc_attr( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date() ) . '</time>',
                                '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>',
                                get_the_category_list( ', ' )
                            );
                            ?>
                        </div>
                    </header><?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail-single">
                            <?php the_post_thumbnail( 'large' ); // Puedes usar 'full', 'large', 'medium', etc. ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php
                        the_content(
                            sprintf(
                                wp_kses(
                                    /* translators: %s: Name of current post. Only visible to screen readers */
                                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'dadecore-theme' ),
                                    array(
                                        'span' => array(
                                            'class' => array(),
                                        ),
                                    )
                                ),
                                wp_kses_post( get_the_title() )
                            )
                        );

                        wp_link_pages(
                            array(
                                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dadecore-theme' ),
                                'after'  => '</div>',
                            )
                        );
                        ?>
                    </div><footer class="entry-footer">
                        <?php
                        // Etiquetas del post
                        the_tags( '<span class="tag-links">' . esc_html__( 'Etiquetas: ', 'dadecore-theme' ), ', ', '</span>' );
                        ?>
                    </footer></div>
            </article><?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>

    </main><?php
get_footer();
