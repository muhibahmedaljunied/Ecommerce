# Language & RTL/LTR Setup Guide

This document explains the language switching implementation for the e-commerce application.

## Features

✅ **RTL/LTR Direction** - Automatically switches between RTL (Arabic) and LTR languages
✅ **Database Persistence** - User language preference saved in database
✅ **Admin Panel Support** - Language switcher in admin header
✅ **Customer Site Support** - Language switcher in customer header
✅ **Multi-language Translations** - 7 languages supported: EN, AR, FR, DE, IT, RU, ES
✅ **Persistent Sessions** - Language preference persists across page reloads

## How It Works

### 1. Language Switching Flow
- User selects language from dropdown
- Request sent to `/language/{locale}` route
- If logged in: preference saved to users.language column
- If not logged in: preference saved to session
- SetLocale middleware applies language on every request
- HTML dir attribute automatically set (dir="ltr" or dir="rtl")
- Appropriate CSS files loaded (assets/css or assets/css-rtl)

### 2. Using Translations in Blade Templates

```blade
<!-- Blade: Use the __() helper or trans() function -->
<h1>{{ __('messages.welcome') }}</h1>
<button>{{ __('messages.add_to_cart') }}</button>
```

### 3. Using Translations in Vue Components

```vue
<template>
  <div>
    <h1>{{ $t('messages.welcome') }}</h1>
  </div>
</template>

<script>
// Or use directly:
const message = this.$t('messages.add_to_cart');
</script>
```

### 4. Using Translations in JavaScript (if needed)

Create a translation endpoint in your controller and fetch from JavaScript.

## Supported Languages

| Code | Language | Direction |
|------|----------|-----------|
| en | English | LTR |
| ar | العربية | RTL |
| fr | Français | LTR |
| de | Deutsch | LTR |
| it | Italiano | LTR |
| ru | Русский | LTR |
| es | Español | LTR |

## Files Structure

```
resources/lang/
├── en/
│   ├── auth.php
│   ├── messages.php
│   ├── pagination.php
│   ├── passwords.php
│   └── validation.php
├── ar/
│   └── messages.php
├── fr/
│   └── messages.php
├── de/
│   └── messages.php
├── it/
│   └── messages.php
├── ru/
│   └── messages.php
└── es/
    └── messages.php
```

## Key Components

### SetLocale Middleware
**Location:** `app/Http/Middleware/SetLocale.php`
- Automatically applies saved language preference on every request
- Checks authenticated user's language column first
- Falls back to session if not logged in

### LanguageController
**Location:** `app/Http/Controllers/LanguageController.php`
- Handles language switching requests
- Validates locale against supported languages
- Saves to database for authenticated users

### LanguageHelper
**Location:** `app/Helpers/LanguageHelper.php`
- `isRTL($locale)` - Check if language is RTL
- `getDirection($locale)` - Get 'rtl' or 'ltr'
- `getDirectionClass($locale)` - Get CSS class for direction
- `getCSSPath($locale)` - Get appropriate CSS folder path
- `getSCSSPath($locale)` - Get appropriate SCSS folder path

## Database Change

A migration adds `language` column to users table:

```php
$table->string('language')->default('en')->after('email');
```

## Updating Translations

To add new strings to translations:

1. Add to all language files in `resources/lang/{locale}/messages.php`
2. Use in templates with `__('messages.key_name')`

## Admin Header Language Switcher

**File:** `resources/views/admin/layouts/main-header.blade.php`
- Located in top navigation
- Shows current language with flag
- Dropdown menu with all available languages
- Clicking changes language and redirects to same page

## Customer Header Language Switcher

**File:** `resources/js/components/customer/layouts/Header.vue`
- Vue dropdown component
- Shows current language
- Clicking redirects to `/language/{locale}`
- Works for both authenticated and guest users

## Layout Direction Attributes

All main layouts now include dynamic dir attribute:

```blade
<html lang="{{ app()->getLocale() }}" dir="{{ \App\Helpers\LanguageHelper::getDirection() }}">
```

- Admin Master Layout: `resources/views/admin/layouts/master.blade.php`
- Customer Master Layout: `resources/views/customer/layouts/master.blade.php`
- App Layout: `resources/views/layouts/app.blade.php`

## CSS Paths

All stylesheets now use dynamic paths:

```blade
<link href="{{ asset('assets/' . \App\Helpers\LanguageHelper::getCSSPath() . '/style.css') }}" rel="stylesheet">
```

This automatically loads:
- `assets/css/` for LTR languages
- `assets/css-rtl/` for RTL languages

## Next Steps

1. **Create CSS RTL versions** - If you need RTL-specific styles, create them in `assets/css-rtl/`
2. **Expand translations** - Add more language keys as needed for full site localization
3. **Test RTL display** - Test Arabic language to ensure RTL display works correctly
4. **Update Vue components** - Add translation strings to Vue components as needed

## Usage Example

### Blade Template
```blade
<div dir="{{ \App\Helpers\LanguageHelper::getDirection() }}">
    <h1>{{ __('messages.welcome') }}</h1>
    <p>{{ __('messages.description') }}</p>
    <button>{{ __('messages.add_to_cart') }}</button>
</div>
```

### Vue Component
```vue
<template>
    <div :dir="direction">
        <h1>{{ $t('messages.welcome') }}</h1>
        <button @click="addToCart">{{ $t('messages.add_to_cart') }}</button>
    </div>
</template>

<script>
export default {
    computed: {
        direction() {
            return this.$store.state.direction;
        }
    }
}
</script>
```

## Troubleshooting

**Language not switching?**
- Check if SetLocale middleware is registered in `app/Http/Kernel.php`
- Verify session is working correctly
- Check browser cookies are enabled

**RTL not applying?**
- Verify `dir` attribute is set in HTML tag
- Check CSS files exist in `assets/css-rtl/`
- Clear browser cache

**Translations not showing?**
- Verify files exist in `resources/lang/{locale}/`
- Check spelling of translation key
- Ensure you're using correct syntax: `__('filename.key')`
