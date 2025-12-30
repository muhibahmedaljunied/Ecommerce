# Browser Locale Detection Feature

This document explains the automatic browser locale detection feature that was added to the language system.

## Overview

The system now automatically detects the user's preferred language based on their browser settings (Accept-Language header) if:
1. User is not authenticated
2. User hasn't previously set a language preference
3. Browser language matches one of our supported locales

This provides a seamless experience for first-time visitors.

## How It Works

### Server-Side Detection (SetLocale Middleware)

The `SetLocale` middleware now includes browser locale detection:

1. **Check authenticated user** - If logged in, use their stored language preference
2. **Check session** - If session has locale, use it
3. **Detect browser** - If neither above, detect from Accept-Language header
4. **Fallback** - Use default locale (en) if nothing matches

**Location:** `app/Http/Middleware/SetLocale.php`

```php
private function detectBrowserLocale(Request $request)
{
    // Parses Accept-Language header
    // Returns first matching supported locale
    // Returns null if no match
}
```

### Client-Side Detection (JavaScript)

JavaScript utility provides browser locale detection:

```javascript
import { languageUtils } from '@/utils/language';

// Detect user's browser language
const browserLocale = languageUtils.detectBrowserLocale();
// Returns: 'en', 'ar', 'fr', etc.
```

**How it works:**
1. Checks `navigator.languages` array (primary locales by preference)
2. Falls back to `navigator.language` if array not available
3. Extracts language code (e.g., 'en' from 'en-US')
4. Returns first matching supported locale
5. Defaults to 'en' if no match

## API Endpoints

### Get Available Languages
**GET** `/api/language/available`

Returns list of all supported languages with metadata:

```json
[
    {
        "code": "en",
        "name": "English",
        "flag": "🇺🇸",
        "direction": "ltr"
    },
    {
        "code": "ar",
        "name": "العربية",
        "flag": "🇸🇦",
        "direction": "rtl"
    },
    ...
]
```

## Vue Component Integration

### Using Language Mixin

Components can use the language mixin to access full locale detection:

```vue
<template>
    <div>
        <!-- Current language -->
        <p>Current: {{ currentLanguageName }}</p>
        
        <!-- Language options -->
        <select v-model="currentLocale" @change="switchLanguage(currentLocale)">
            <option v-for="lang in availableLanguages" :key="lang.code" :value="lang.code">
                {{ lang.flag }} {{ lang.name }}
            </option>
        </select>
        
        <!-- Browser detected language -->
        <p v-if="browserDetectedLocale">
            Browser detected: {{ browserDetectedLocale }}
        </p>
    </div>
</template>

<script>
import { languageMixin } from '@/utils/language';

export default {
    mixins: [languageMixin],
    // Component code
}
</script>
```

## Localization Detection Hierarchy

The system determines user's language in this order:

### For Authenticated Users:
1. **Database stored language** (`users.language` column)
2. → Falls back to default locale if null

### For Guest Users:
1. **Session language** (if previously set)
2. **Browser language** (Accept-Language header)
3. **Default locale** (en)

### For New Visitors (First Time):
→ Browser language automatically applied if supported

## Supported Languages and Locales

| Code | Language | Browser Code | Direction |
|------|----------|--------------|-----------|
| en | English | en, en-US, en-GB, etc. | LTR |
| ar | العربية | ar, ar-SA, ar-AE, etc. | RTL |
| fr | Français | fr, fr-FR, fr-CA, etc. | LTR |
| de | Deutsch | de, de-DE, de-AT, etc. | LTR |
| it | Italiano | it, it-IT, etc. | LTR |
| ru | Русский | ru, ru-RU, etc. | LTR |
| es | Español | es, es-ES, es-MX, etc. | LTR |

## New Files Added

```
resources/lang/
├── ar/
│   └── pagination.php (new)
├── fr/
│   └── pagination.php (new)
├── de/
│   └── pagination.php (new)
├── it/
│   └── pagination.php (new)
├── ru/
│   └── pagination.php (new)
└── es/
    └── pagination.php (new)
```

## Updated Files

### Middleware
- `app/Http/Middleware/SetLocale.php` - Added browser detection

### Controllers
- `app/Http/Controllers/LanguageController.php` - Added `getAvailableLanguages()`

### Routes
- `routes/web.php` - Added `/api/language/available`

### JavaScript
- `resources/js/utils/language.js` - Added browser detection, enhanced mixin

## Usage Examples

### Example 1: Auto-detect on First Visit

```javascript
// No code needed - happens automatically!
// New visitor with browser language 'fr' → Site loads in French
// If they set a preference → Overrides browser language
```

### Example 2: Language Switcher with Browser Detection

```vue
<template>
    <div>
        <p class="text-muted">
            Browser Language: {{ browserDetectedLocale }}
        </p>
        <select v-model="currentLocale" @change="switchLanguage">
            <option v-for="lang in availableLanguages" :key="lang.code" :value="lang.code">
                {{ lang.flag }} {{ lang.name }}
            </option>
        </select>
    </div>
</template>

<script>
import { languageMixin } from '@/utils/language';

export default {
    mixins: [languageMixin],
}
</script>
```

### Example 3: Programmatic Detection

```javascript
import { languageUtils } from '@/utils/language';

// Detect browser language
const browserLang = languageUtils.detectBrowserLocale();
console.log('Browser language:', browserLang); // 'en', 'fr', 'ar', etc.

// Get all available languages
const languages = await languageUtils.getAvailableLanguages();
console.log('Available:', languages);
```

## Pagination Translations

Pagination messages are now translated in all 7 languages:

**Using in Blade:**
```blade
{{ $items->links() }}
<!-- Automatically uses current locale's pagination strings -->
```

**Manual translation:**
```blade
<a href="{{ $items->previousPageUrl() }}">
    {{ __('pagination.previous') }}
</a>
```

## Browser Compatibility

Browser locale detection works in all modern browsers:
- ✅ Chrome/Edge (navigator.languages)
- ✅ Firefox (navigator.languages)
- ✅ Safari (navigator.languages or navigator.language)
- ✅ Mobile browsers

## Performance Considerations

- **No additional requests** - Detection happens in middleware, no extra API calls
- **Cached response** - Once detected, stored in session
- **Minimal overhead** - Simple string parsing of Accept-Language header

## Fallback Behavior

If detection fails or browser language not supported:
→ Defaults to `en` (English)

## Testing Browser Locale Detection

### Change Browser Language (Chrome):
1. Settings → Languages
2. Add language and move to top
3. Refresh page → Should detect new language

### Via Developer Tools:
```javascript
// Check detected locale
navigator.languages
// Returns: ['fr', 'en', 'de']

// Check single language
navigator.language
// Returns: 'fr-FR'
```

## Summary

The browser locale detection feature:
- 🌍 **Detects user language automatically** from browser settings
- ✨ **Seamless first-time experience** - No setup required
- 🔄 **Respects user choices** - Manual selection overrides auto-detection
- 💾 **Persistent preferences** - Saves for future visits
- 🚀 **Zero overhead** - Uses standard HTTP headers

This creates a truly localized experience for international users!
