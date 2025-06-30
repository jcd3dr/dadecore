<?php
/**
 * The blog archive template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DadeCore_Theme
 */

get_header();
?>

    <div id="primary" class="site-main">
        <div class="container blog-archive-container section-padding">
            <header class="page-header">
                <h1 class="page-title section-title"><?php single_post_title(); ?></h1>
                <p class="section-subtitle">Explora nuestras últimas publicaciones y recursos.</p>
            </header><div class="blog-posts-grid">
                <?php
                if ( have_posts() ) :
                    /* Start the Loop */
                    while ( have_posts() ) :
                        the_post(); // Configura los datos del post actual
                ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post-item card card-glow' ); ?>>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'medium' ); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <header class="entry-header">
                                <?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
                            </header>
                            <div class="entry-summary">
                                <?php the_excerpt(); ?>
                            </div>
                            <footer class="entry-footer">
                                <a href="<?php the_permalink(); ?>" class="read-more-btn">Leer Más →</a>
                            </footer>
                        </article>
                <?php
                    endwhile;

                    // Paginación
                    the_posts_pagination( array(
                        'prev_text'          => esc_html__( '« Anterior', 'dadecore-theme' ),
                        'next_text'          => esc_html__( 'Siguiente »', 'dadecore-theme' ),
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Página', 'dadecore-theme' ) . ' </span>',
                    ) );

                else :
                    echo '<p>' . esc_html__( 'Lo sentimos, no se encontraron entradas de blog.', 'dadecore-theme' ) . '</p>';
                endif;
                ?>
            </div></div></div><?php
get_footer();
