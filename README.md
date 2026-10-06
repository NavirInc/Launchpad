# Launchpad

Launchpad is a lightweight WordPress theme starter designed to provide a clean and flexible foundation for building custom themes efficiently.

It keeps the structure simple and easy to extend, with a minimal theme setup, reusable PHP includes, and a modern frontend build workflow powered by Vite and Sass.

## Features

- Lightweight and minimal WordPress theme foundation
- Vite-based asset pipeline
- Sass support for styling
- Organized theme structure with reusable include files
- Basic templates for common WordPress pages
- Easy to customize for custom theme development

## Requirements

- WordPress 6.8 or newer
- PHP 8.0+
- Node.js 18+
- npm

## Installation

1. Clone or download the project.
2. Rename the theme folder to match your project name.
3. Open the theme directory in your terminal.
4. Install project dependencies:

```bash
npm install
```

5. Copy the theme folder into `wp-content/themes/` in your WordPress installation.
6. Activate the theme from the WordPress admin area.

## Quick Start

After installing the theme, update the following to match your project:

- theme name and metadata in the PHP files
- template and include logic in `functions.php`
- asset references and design tokens
- theme folders or custom template structure
- license details in `LICENSE.txt` if necessary

## Project Structure

```text
Launchpad/
├── inc/
│   ├── admin-menu.php
│   ├── enqueue.php
│   ├── setup.php
│   ├── meta-box/
│   │   ├── fields.php
│   │   └── post-types.php
│   └── utils/
│       ├── disable-comments.php
│       ├── disable-emojis.php
│       ├── disable-gutenberg.php
│       ├── smtp-phpmailer.php
│       └── svg-support.php
├── languages/
├── src/
│   ├── js/
│   │   └── main.js
│   └── scss/
│       ├── base/
│       ├── components/
│       ├── plugins/
│       ├── utils/
│       ├── variables/
│       └── main.scss
├── template-parts/
│   └── component.php
├── 404.php
├── footer.php
├── functions.php
├── header.php
├── index.php
├── LICENSE.txt
├── package.json
├── page.php
├── README.md
├── style.css
├── vite.config.js
└── vendor/
    └── vendor.txt
```

## Development Workflow

The project uses Vite to handle JS and asset bundling.

### Start development mode

```bash
npm run dev
```

This runs Vite in watch mode so changes in the source assets are rebuilt automatically during development.

### Build for production

```bash
npm run build
```

This creates the production bundle according to the configuration in `vite.config.js`.

## WordPress Notes

The theme includes a lightweight setup system in `functions.php` that loads reusable PHP includes from the `inc/` directory. This makes it easy to enable or disable functionality such as admin menu setup, asset enqueueing, SVG support, SMTP configuration, or WordPress cleanup features.

You can adapt this structure depending on your theme needs by adding or removing files from the include list.

## Security Recommendation

For improved security, you may want to disable the WordPress theme/plugin editor in `wp-config.php`:

```php
/** Disable WordPress file editor for security */
define('DISALLOW_FILE_EDIT', true);
```

## License

This project is licensed under the MIT License. See the `LICENSE.txt` file for details.

## Contributing

Contributions are welcome. If you improve the architecture, add reusable utilities, or refine the theme starter, feel free to open a pull request.

## Summary

Launchpad is a clean starting point for WordPress theme development, designed to be simple, flexible, and easy to customize for your own projects.