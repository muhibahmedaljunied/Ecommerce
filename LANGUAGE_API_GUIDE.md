# Language Switching API Guide

This guide explains how to use the new language switching API endpoints without page reload.

## New API Endpoints

### 1. Set Language (No Page Reload)
**POST** `/api/language/set`

**Request:**
```javascript
axios.post('/api/language/set', {
    locale: 'ar'  // en, ar, fr, de, it, ru, es
});
```

**Response:**
```json
{
    "success": true,
    "locale": "ar",
    "direction": "rtl",
    "message": "Language updated successfully"
}
```

### 2. Get Current Language
**GET** `/api/language/current`

**Response:**
```json
{
    "locale": "en",
    "direction": "ltr",
    "isRTL": false
}
```

### 3. Traditional Language Switch (Redirects)
**GET** `/language/{locale}`

This is the original redirect-based method. Still works but causes page reload.

## JavaScript Utility Functions

Located in `resources/js/utils/language.js`

### Methods Available

```javascript
import { languageUtils } from '@/utils/language';

// Get current language
const lang = await languageUtils.getCurrentLanguage();
// Returns: { locale: 'en', direction: 'ltr', isRTL: false }

// Set language (no page reload)
const result = await languageUtils.setLanguage('ar');
// Returns: { success: true, locale: 'ar', direction: 'rtl', ... }

// Get language flag emoji
const flag = languageUtils.getLanguageFlag('en');
// Returns: '🇺🇸'

// Get language name
const name = languageUtils.getLanguageName('fr');
// Returns: 'Français'
```

## Vue Component Example

### Using Language Utility in Vue Component

```vue
<template>
    <div :dir="currentDirection">
        <select v-model="selectedLanguage" @change="switchLanguage">
            <option value="en">English</option>
            <option value="ar">العربية</option>
            <option value="fr">Français</option>
        </select>
        
        <p>Current: {{ currentLanguageName }}</p>
    </div>
</template>

<script>
import { languageUtils, languageMixin } from '@/utils/language';

export default {
    mixins: [languageMixin],
    data() {
        return {
            selectedLanguage: 'en'
        }
    },
    methods: {
        async switchLanguage() {
            const result = await this.switchLanguage(this.selectedLanguage);
            if (result.error) {
                console.error('Error switching language:', result.error);
            }
        }
    },
    mounted() {
        this.loadCurrentLanguage();
    }
}
</script>
```

## Header Component Integration

The `Header.vue` component has been updated to use the new API:

```javascript
async changeLang() {
    const result = await languageUtils.setLanguage(this.selectedLanguage);
    if (!result.error) {
        localStorage.setItem('lang', this.selectedLanguage);
        this.currentDirection = result.direction;
        document.documentElement.dir = result.direction;
    }
}
```

**Benefits:**
- ✅ No page reload (smoother UX)
- ✅ Instant direction change
- ✅ Works with localStorage
- ✅ Saves to database for authenticated users
- ✅ Saves to session for guests

## Authentication Translation Files

All auth messages are now translated:

**File:** `resources/lang/{locale}/auth.php`

**Available for all 7 languages:**
- `en` - English
- `ar` - العربية
- `fr` - Français
- `de` - Deutsch
- `it` - Italiano
- `ru` - Русский
- `es` - Español

**Usage in Blade:**
```blade
@if($errors->has('login'))
    <p>{{ __('auth.failed') }}</p>
@endif
```

## Complete Language Workflow

### For Authenticated Users:
1. User selects language from dropdown
2. API call sent to `/api/language/set`
3. Language saved to `users.language` column
4. Session updated
5. DOM direction updated (no reload)
6. localStorage updated for fallback
7. User can refresh page and language persists

### For Guest Users:
1. User selects language from dropdown
2. API call sent to `/api/language/set`
3. Language saved to session
4. DOM direction updated (no reload)
5. localStorage updated for fallback
6. Language persists until session expires

## Supported Locales

| Code | Language | Direction | Flag |
|------|----------|-----------|------|
| en | English | LTR | 🇺🇸 |
| ar | العربية | RTL | 🇸🇦 |
| fr | Français | LTR | 🇫🇷 |
| de | Deutsch | LTR | 🇩🇪 |
| it | Italiano | LTR | 🇮🇹 |
| ru | Русский | LTR | 🇷🇺 |
| es | Español | LTR | 🇪🇸 |

## Route Definitions

In `routes/web.php`:

```php
// Traditional redirect method
Route::get('/language/{locale}', [LanguageController::class, 'setLanguage'])
    ->name('language.switch');

// API method (no page reload)
Route::post('/api/language/set', [LanguageController::class, 'setLanguageApi'])
    ->name('language.set.api');

// Get current language info
Route::get('/api/language/current', [LanguageController::class, 'getCurrentLanguage'])
    ->name('language.current.api');
```

## Controller Methods

**Location:** `app/Http/Controllers/LanguageController.php`

```php
public function setLanguage($locale)
    // Redirect-based language switch

public function setLanguageApi(Request $request)
    // API-based language switch (returns JSON)

public function getCurrentLanguage()
    // Returns current language info as JSON
```

## Middleware

**Location:** `app/Http/Middleware/SetLocale.php`

Automatically applies the correct locale:
1. Checks if user is authenticated
2. Uses `users.language` if authenticated
3. Falls back to session for guests
4. Applies locale to app

## CSS Direction Handling

All layouts include dynamic direction:

```blade
<html lang="{{ app()->getLocale() }}" 
      dir="{{ \App\Helpers\LanguageHelper::getDirection() }}">
```

Stylesheets are loaded dynamically:

```blade
<link href="{{ asset('assets/' . \App\Helpers\LanguageHelper::getCSSPath() . '/style.css') }}" 
      rel="stylesheet">
```

## Next Steps for Implementation

1. **Update remaining Vue components** - Add language switcher to all components
2. **Add translation strings** - Expand `messages.php` files with more content keys
3. **Create RTL CSS** - Ensure `assets/css-rtl/` has proper RTL styles
4. **Test all languages** - Verify RTL display for Arabic
5. **Add pagination translations** - Translate pagination messages in all languages

## Troubleshooting

**Language not switching?**
- Check browser console for errors
- Verify CSRF token is present
- Check that SetLocale middleware is in web middleware group

**API returning 400 error?**
- Check that locale is valid (en, ar, fr, de, it, ru, es)
- Verify CSRF token in request
- Check POST data format

**Direction not changing?**
- Clear browser cache
- Check that document.documentElement.dir is being set
- Verify CSS files exist in appropriate paths
