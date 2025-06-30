<?php
/**
 * The main template file
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

get_header(); // Incluye el encabezado de tu tema
?>

<main id="primary" class="site-main">
    <section class="section-default section-padding">
        <div class="container">
            <h2>Contenido Predeterminado</h2>
            <p>Este es el contenido de `index.php`. Si estás viendo esto, significa que WordPress no encontró una plantilla más específica para la página que intentas visitar.</p>
            <p>En un tema bien estructurado, `index.php` actúa como un "fallback" genérico.</p>
        </div>
    </section>
</main>

<?php
get_footer(); // Incluye el pie de página de tu tema
?>
