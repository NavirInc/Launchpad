# Launchpad
A clean, lightweight foundation for building custom WordPress themes.

## Requirements
- WordPress 6.8
- PHP 8+
- Sass compiler
- Terser (for JS minification)

## Features
- Lightweight and minimal
- Sass-ready

## Quick Start
- Rename the theme folder name "theme-name"
- In each file, search and replace these strings with the proper variation of the theme name.
    - Theme Name
    - Theme_Name
    - theme-name
    - THEMENAME
    - themename
- Modify the license information to reflect your project's licensing terms:
    - At the end of this file
    - In the LICENSE.txt file
    - At the beginning of the style.scss file
- Generate a screenshot.png at the end of development.
- Your canvas is ready - time to create!

## File Structure
├── assets/
│   ├── fonts/
│   ├── images/
│   └── js/
│       └── main.min.js
├── languages/
├── src/
│   ├── js/
│       └── main.js
│   └── scss/
│       └── style.scss
├── template-parts/
├── vendor/
│
├── index.php
├── page.php
├── 404.php
├── header.php
├── footer.php
├── functions.php
├── style.min.css
├── screenshot.png
└── README.md


## Workflow
To compile and minify the style.scss file, use this command in the theme folder.
```sass src/scss/style.scss style.min.css --style compressed --no-source-map```

To minify the main.js file, use this command in the theme folder.
```terser src/js/main.js --output assets/js/main.min.js --compress --mangle```

## License
This project is licensed under the MIT License - see LICENSE.txt for details.