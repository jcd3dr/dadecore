# DadeCore Theme

This theme provides a block-first approach for WordPress and includes several convenient features enabled in `functions.php`.

## Theme Setup

The `dadecore_setup()` function loads text domains and enables core WordPress features:

- Block styles and editor styles
- Block templates and template parts
- **Title tag support** so WordPress manages the document title
- **Post thumbnails** for featured images
- **HTML5 markup** for search forms, comment forms, comment lists, galleries and captions
- Registers the **Primary Menu** location

## Widgets

`dadecore_widgets_init()` registers two widget areas using `register_sidebar()`:

1. **Blog Sidebar** – displayed on blog templates
2. **Footer Widgets** – used for footer content

Add widgets to these areas through the WordPress Admin under *Appearance → Widgets*.
