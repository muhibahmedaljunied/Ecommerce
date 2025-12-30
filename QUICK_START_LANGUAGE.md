# Language System Quick Start Guide

## For Users

### Change Language
1. **Admin Panel**: Click language dropdown in header → Select language → Automatic redirect
2. **Customer Site**: Select language from dropdown → Automatic switch (no reload)
3. **Preferences Auto-Save**: Language saved to database (users) or session (guests)

## For Developers

### Use Translations in Code

#### Blade Templates
```blade
<!-- Messages -->
<h1>{{ __('messages.welcome') }}</h1>
<button>{{ __('messages.add_to_cart') }}</button>

<!-- Auth messages -->
@if($errors->has('email'))
    <p>{{ __('auth.failed') }}</p>
@endif

<!-- Pagination -->
{{ $items->links() }}
```

#### Vue Components
```vue
<template>
    <h1>{{ $t('messages.welcome') }}</h1>
</template>
```

#### JavaScript
```javascript
import { languageUtils } from '@/utils/language';

// Switch language
await languageUtils.setLanguage('ar');

// Get current
const current = await languageUtils.getCurrentLanguage();

// Get available languages
const langs = await languageUtils.getAvailableLanguages();

// Detect browser language
const browserLang = languageUtils.detectBrowserLocale();
```

### API Endpoints

```bash
# Get current language
curl http://localhost/api/language/current

# Set language
curl -X POST http://localhost/api/language/set \
  -H "Content-Type: application/json" \
  -d '{"locale":"ar"}'

# Get all available languages
curl http://localhost/api/language/available
```

### Add New Translation Strings

1. **Add to all language files** in `resources/lang/{locale}/messages.php`:

```php
'your_key' => 'English translation',
```

2. **Use in code**:
```blade
{{ __('messages.your_key') }}
```

### Create New Language

1. **Create directory**: `resources/lang/de_new/`
2. **Copy template files**: `auth.php`, `messages.php`, `pagination.php`
3. **Add to controller** `app/Http/Controllers/LanguageController.php`:
```php
protected $supportedLocales = ['en', 'ar', ..., 'de_new'];
```
4. **Update middleware** `app/Http/Middleware/SetLocale.php`:
```php
protected $supportedLocales = ['en', 'ar', ..., 'de_new'];
```

## 🎯 Common Tasks

### Task: Add "Hello World" Translation

**Step 1**: Add to each language file:
```php
// resources/lang/en/messages.php
'hello_world' => 'Hello World',

// resources/lang/ar/messages.php
'hello_world' => 'مرحبا بالعالم',

// resources/lang/fr/messages.php
'hello_world' => 'Bonjour le monde',
```

**Step 2**: Use in template:
```blade
<h1>{{ __('messages.hello_world') }}</h1>
```

### Task: Check Current Language in Vue

```vue
<script>
import { languageMixin } from '@/utils/language';

export default {
    mixins: [languageMixin],
    mounted() {
        console.log('Current:', this.currentLocale);
        console.log('Direction:', this.currentDirection);
        console.log('Browser:', this.browserDetectedLocale);
    }
}
</script>
```

### Task: Force Language for Specific User

```php
// In controller
auth()->user()->update(['language' => 'ar']);
```

### Task: Get Language in Middleware

```php
// SetLocale middleware automatically applies language
// Access with: app()->getLocale()

public function handle($request, Closure $next)
{
    $locale = app()->getLocale(); // 'en', 'ar', etc.
    return $next($request);
}
```

## 📚 File Locations

| Purpose | Location |
|---------|----------|
| Translations | `resources/lang/{locale}/` |
| Middleware | `app/Http/Middleware/SetLocale.php` |
| Controller | `app/Http/Controllers/LanguageController.php` |
| Helper | `app/Helpers/LanguageHelper.php` |
| JS Utils | `resources/js/utils/language.js` |
| Database | `users.language` column |

## 🔍 Debugging

### Check Current Locale
```php
echo app()->getLocale(); // 'en', 'ar', etc.
```

### Check User Language
```php
echo auth()->user()->language; // 'en', 'ar', etc.
```

### Check Session Language
```php
echo session('locale'); // 'en', 'ar', etc.
```

### Browser Console
```javascript
// Detect browser language
console.log(navigator.languages);
console.log(navigator.language);

// Check current direction
console.log(document.documentElement.dir);
```

## ⚡ Performance Tips

1. **Avoid repeated API calls** - Cache language in localStorage
2. **Lazy load translations** - Only load needed language files
3. **Use CDN for static pages** - Cache language-specific versions
4. **Set correct headers** - Server sends Content-Language header

## 🚀 Deployment

### Before Going Live

1. ✅ Verify migration ran: `php artisan migrate:status`
2. ✅ Test all 7 languages work
3. ✅ Check RTL display for Arabic
4. ✅ Verify browser detection works
5. ✅ Test user preference persistence
6. ✅ Check API endpoints respond
7. ✅ Clear cache: `php artisan cache:clear`

### Environment Setup

No special environment variables needed - everything is built-in!

## 🐛 Troubleshooting

### Language Not Switching?
```php
// Check middleware is registered
// app/Http/Kernel.php web middleware group
\App\Http\Middleware\SetLocale::class,
```

### Translations Not Showing?
```blade
<!-- Check file exists -->
resources/lang/{locale}/messages.php

<!-- Check syntax correct -->
{{ __('messages.key_name') }}
```

### RTL Not Working?
```blade
<!-- Check dir attribute -->
<html dir="{{ \App\Helpers\LanguageHelper::getDirection() }}">

<!-- Check CSS files exist -->
assets/css-rtl/style.css
```

### API Returning 400?
```javascript
// Check locale is valid
const valid = ['en', 'ar', 'fr', 'de', 'it', 'ru', 'es'];
```

## 📞 Support

Refer to complete documentation files:
- `LANGUAGE_SETUP.md` - Complete setup guide
- `LANGUAGE_API_GUIDE.md` - API documentation
- `BROWSER_LOCALE_DETECTION.md` - Browser detection feature
- `LANGUAGE_IMPLEMENTATION_SUMMARY.md` - Full implementation details

## 📝 Notes

- All locales are whitelisted for security
- Browser detection happens automatically
- Preferences persist across sessions
- No dependencies required
- Works in all modern browsers

**Happy coding! 🌍**
