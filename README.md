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
 <x-smartuiqisti::forms.upload-form 
    label="Supporting Document"
    max-file="5"
    max-size="50000"
    accept=".csv,.xls,.xlsx,.zip,.pdf,.png,.jpg,.jpeg"
    required
    preview-outside
    bulk-delete
    wire:model="xxx"
/>
```

### 🎨 Theme & Color Controls

| Attribute | Description |
|---------|-------------|
| `main-color` | Primary UI accent color |
| `dropzone-color` | Dropzone background color |
| `dropzone-border-color` | Dropzone border color |
| `dropzone-active-color` | Dropzone active state background |

```blade
<x-smartuiqisti::forms.upload-form
    main-color="#000000"
    dropzone-color="#f5f3ff"
    dropzone-border-color="#c4b5fd"
    dropzone-active-color="#ede9fe"
/>
```

---

### 🎯 Styling Hooks

| Attribute | Description |
|---------|-------------|
| `label-class` | Label styling |
| `inner-icon-class` | Upload icon styling |
| `inner-title-class` | Title styling |
| `inner-title-sub-class` | Subtitle styling |
| `inner-accepted-class` | Accepted file text styling |

```blade
<x-smartuiqisti::forms.upload-form
    label-class="text-sm font-semibold text-gray-700"
    inner-icon-class="text-indigo-600"
    inner-title-class="text-base font-bold"
    inner-title-sub-class="text-xs text-gray-500"
    inner-accepted-class="text-xs italic text-gray-400"
/>
```

---

### 🤖 AI & File Optimization

| Attribute | Description |
|---------|-------------|
| `ai-enable` | Enable AI-powered extraction & scanning |
| `auto-compress` | Automatically compress large files before upload |

```blade
<x-smartuiqisti::forms.upload-form
    ai-enable
    auto-compress
/>
```

---