<?php
/**
 * The front page template file
 *
 * @package DadeCore_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

    <section class="hero-section">
        <div class="hero-background-objects">
            <div class="object object-1"></div>
            <div class="object object-2"></div>
            <div class="object object-3"></div>
        </div>
        <div class="container hero-content">
            <h1 class="hero-title">DadeCore Bizz LLC: <span class="highlight">Digital Operations Hub</span></h1>
            <p class="hero-subtitle">Ejecutando múltiples líneas de negocio digital con eficiencia y vanguardia.</p>
            <div class="hero-buttons">
                <a href="#services" class="btn btn-primary">Nuestros Servicios</a>
                <a href="#portfolio" class="btn btn-secondary">Ver Proyectos</a>
            </div>
        </div>
    </section><section id="services" class="services-section section-padding">
        <div class="container">
            <h2 class="section-title">Nuestros Servicios</h2>
            <p class="section-subtitle">Soluciones digitales que impulsan tu negocio.</p>
            <div class="services-grid">
                <div class="service-item card card-glow">
                    <h3>Desarrollo Web Personalizado</h3>
                    <p>Diseñamos y construimos sitios web a medida, optimizados para rendimiento y experiencia de usuario.</p>
                </div>
                <div class="service-item card card-glow">
                    <h3>E-commerce Solutions</h3>
                    <p>Crea tu tienda online potente y escalable para vender tus productos o servicios de forma eficaz.</p>
                </div>
                <div class="service-item card card-glow">
                    <h3>Blog & Contenido Monetizable</h3>
                    <p>Desarrollamos blogs listos para monetización con AdSense y Amazon, con estrategias de contenido.</p>
                </div>
            </div>
        </div>
    </section><section id="portfolio" class="portfolio-section section-padding bg-dark-gradient">
        <div class="container">
            <h2 class="section-title text-light">Proyectos Recientes</h2>
            <p class="section-subtitle text-light">Una mirada a nuestro trabajo.</p>
            <div class="portfolio-grid">
                <div class="portfolio-item card card-glow-border">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-project1.jpg" alt="Proyecto E-commerce X">
                    <h4>E-commerce de Ropa Deportiva</h4>
                    <p>Desarrollo de plataforma de venta online.</p>
                    <span class="rainbow-border-effect"></span>
                </div>
                <div class="portfolio-item card card-glow-border">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-project2.jpg" alt="Proyecto Blog Y">
                    <h4>Blog de Tecnología y Gadgets</h4>
                    <p>Optimización para monetización y SEO.</p>
                    <span class="rainbow-border-effect"></span>
                </div>
                <div class="portfolio-item card card-glow-border">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder-project3.jpg" alt="Proyecto Servicio Z">
                    <h4>Web de Servicios de Consultoría</h4>
                    <p>Diseño profesional y generación de leads.</p>
                    <span class="rainbow-border-effect"></span>
                </div>
            </div>
        </div>
    </section><section id="blog" class="blog-section section-padding">
        <div class="container">
            <h2 class="section-title">Últimas Publicaciones del Blog</h2>
            <p class="section-subtitle">Conocimiento fresco y tendencias digitales.</p>
            <div class="blog-posts-grid">
                <?php
                // Query para obtener los 3 últimos posts
                $args = array(
                    'post_type'      => 'post',
                    'posts_per_page' => 3,
                    'post_status'    => 'publish',
                    'order'          => 'DESC',
                    'orderby'        => 'date'
                );
                $latest_posts = new WP_Query( $args );

                if ( $latest_posts->have_posts() ) :
                    while ( $latest_posts->have_posts() ) : $latest_posts->the_post();
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
                        </header><div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div><footer class="entry-footer">
                            <a href="<?php the_permalink(); ?>" class="read-more-btn">Leer Más &rarr;</a>
                        </footer></article><?php
                    endwhile;
                    wp_reset_postdata(); // Restaura los datos del post global
                else :
                    echo '<p>No hay publicaciones de blog disponibles en este momento.</p>';
                endif;
                ?>
            </div>
        </div>
    </section></main><?php
get_footer();
