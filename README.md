# Era AI - WordPress Theme

Era AI is a modern, responsive, and performance-optimized WordPress theme designed for AI-focused projects, digital agencies, and professional services. Built on top of the underscores starter theme, it features customized templates, modern styling tokens, custom post types, and built-in auto-update support from GitHub.

## Features

- **Modern Responsive Design**: Custom HSL-tailored color palettes, sleek layout tokens, and typography (using Google Fonts: Inter & JetBrains Mono).
- **Custom Post Type: Pesan Masuk**: Built-in lead/inquiry management system with AJAX contact form processing and email notifications.
- **Halaman Artikel**: Blog filter using AJAX for category sorting and lazy loading.
- **Dedicated Templates**: 
  - `Terms & Conditions` page template
  - `Privacy Policy` page template
  - Custom page templates for Services, Automation, and Contact pages.
- **GitHub Auto-Update**: Integrated with `yahnis-elsts/plugin-update-checker` to automatically receive theme updates directly from your GitHub Releases.

## Requirements

- **PHP**: `>=7.4`
- **WordPress**: `>=6.0`
- **Composer**: For managing dependencies (like the update checker).

## Installation & Setup

1. Clone or extract this repository into your WordPress themes folder (`/wp-content/themes/eraai`).
2. Run Composer to install required dependencies:
   ```sh
   composer install --no-plugins
   ```
3. Run NPM to install assets packages (if doing styling development):
   ```sh
   npm install
   ```
4. Activate the theme from **Appearance > Themes** in your WordPress Admin Dashboard.

## Available CLI Commands

- `composer lint:php` : Lint PHP files for syntax errors.
- `npm run watch` : Watch SASS/CSS files and recompile.
- `npm run compile:css` : Compile assets.
- `npm run bundle` : Generate a `.zip` archive for production, excluding dev files.

## How Auto-Updates Work

Whenever you want to roll out an update to your servers:
1. Update the version number in `style.css` (e.g. `Version: 1.0.1`).
2. Push your changes to this repository.
3. Create a new **GitHub Release** with the matching version tag (e.g., `1.0.1`).
4. Go to **Dashboard > Updates** in your WordPress Admin and click **Check Again**. The update will appear automatically!
