## Installation

1. Include the package in composer

```bash
composer require qisti/smart-ui-qisti
```

2. Run package installation

```bash
composer install
```

3. Publish the CSS/Tailwind

```bash
php artisan vendor:publish --tag=smartuiqisti-assets
```

4. Importing smart ui css into your main css

```css
@import './smartuiqisti/app.css';
```

5. Publish blade view

```bash
php artisan vendor:publish --tag=smartuiqisti-views
```

6. Publish smartui configuration

```bash
php artisan vendor:publish --tag=smartuiqisti-config
```

7. Use of the component

```php
 <x-smartuiqisti::forms.upload-form />
```



