# Language System - Code Examples

Complete working examples for common language implementation scenarios.

## 1. Language Switcher Component (Vue)

```vue
<template>
    <div class="language-switcher">
        <select v-model="selectedLanguage" @change="switchLanguage" class="form-control">
            <option v-for="lang in availableLanguages" :key="lang.code" :value="lang.code">
                {{ lang.flag }} {{ lang.name }}
            </option>
        </select>
        <small v-if="browserDetectedLocale" class="text-muted">
            Browser: {{ browserDetectedLocale }}
        </small>
    </div>
</template>

<script>
import { languageMixin } from '@/utils/language';

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
        this.selectedLanguage = this.currentLocale;
    }
}
</script>

<style scoped>
.language-switcher {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
</style>
```

## 2. Login Page with Translated Messages (Blade)

```blade
<div class="login-container">
    <h1>{{ __('messages.welcome') }}</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            @if ($errors->has('email'))
                <p>{{ __('auth.failed') }}</p>
            @endif
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label>{{ __('messages.email', [], app()->getLocale()) }}</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label>{{ __('messages.password', [], app()->getLocale()) }}</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">
            {{ __('messages.login') }}
        </button>
    </form>

    <p>
        {{ __('messages.no_account') }}
        <a href="{{ route('register') }}">{{ __('messages.register') }}</a>
    </p>
</div>
```

## 3. Product List with Language Persistence (Vue)

```vue
<template>
    <div :dir="currentDirection" class="products">
        <div class="controls">
            <select v-model="currentLocale" @change="switchLanguage" class="form-control">
                <option v-for="lang in availableLanguages" :key="lang.code" :value="lang.code">
                    {{ lang.name }}
                </option>
            </select>
        </div>

        <h1>{{ $t('messages.products') }}</h1>

        <div v-if="products.length" class="product-grid">
            <div v-for="product in products" :key="product.id" class="product-card">
                <img :src="product.image" :alt="product.name">
                <h3>{{ product.name }}</h3>
                <p>{{ __('messages.price') }}: ${{ product.price }}</p>
                <button @click="addToCart(product.id)" class="btn btn-primary">
                    {{ $t('messages.add_to_cart') }}
                </button>
            </div>
        </div>
        <p v-else>{{ __('messages.no_products') }}</p>

        <!-- Pagination -->
        <nav v-if="products.length" aria-label="Pagination">
            <ul class="pagination">
                <li>
                    <a href="#" class="page-link">
                        {{ __('pagination.previous') }}
                    </a>
                </li>
                <li><a href="#" class="page-link">1</a></li>
                <li><a href="#" class="page-link">2</a></li>
                <li>
                    <a href="#" class="page-link">
                        {{ __('pagination.next') }}
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
import { languageMixin } from '@/utils/language';

export default {
    mixins: [languageMixin],
    data() {
        return {
            products: []
        }
    },
    methods: {
        async loadProducts() {
            const response = await this.axios.get('/api/products');
            this.products = response.data;
        },
        addToCart(productId) {
            this.axios.post('/api/cart/add', { product_id: productId });
        }
    },
    mounted() {
        this.loadProducts();
    }
}
</script>
```

## 4. RTL-Safe Layout (Blade)

```blade
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" 
      dir="{{ \App\Helpers\LanguageHelper::getDirection() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    
    <!-- Dynamic CSS based on language direction -->
    <link rel="stylesheet" href="{{ asset('assets/' . \App\Helpers\LanguageHelper::getCSSPath() . '/style.css') }}">
</head>
<body>
    <header>
        <div class="header-content" dir="{{ \App\Helpers\LanguageHelper::getDirection() }}">
            <h1>{{ __('messages.welcome') }}</h1>
            
            <!-- Language selector -->
            <language-selector></language-selector>
        </div>
    </header>

    <main class="container">
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} {{ __('messages.company_name') }}</p>
        <ul class="footer-links">
            <li><a href="#">{{ __('messages.about_us') }}</a></li>
            <li><a href="#">{{ __('messages.contact_us') }}</a></li>
            <li><a href="#">{{ __('messages.privacy_policy') }}</a></li>
        </ul>
    </footer>
</body>
</html>
```

## 5. Controller with Language Handling

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $locale = app()->getLocale();
        
        // Get products (could filter by language in DB)
        $products = Product::all();
        
        // Pass language info to view
        return view('products.index', [
            'products' => $products,
            'locale' => $locale,
            'direction' => \App\Helpers\LanguageHelper::getDirection($locale),
        ]);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $locale = app()->getLocale();
        
        return view('products.show', [
            'product' => $product,
            'isRTL' => \App\Helpers\LanguageHelper::isRTL($locale),
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $locale = app()->getLocale();
        
        $products = Product::where('name', 'like', "%{$query}%")
                           ->get();
        
        return response()->json([
            'query' => $query,
            'locale' => $locale,
            'results' => $products,
        ]);
    }
}
```

## 6. Middleware Integration

```php
<?php

namespace App\Http\Middleware;

use Closure;

class CustomLanguageDetection
{
    public function handle($request, Closure $next)
    {
        // Custom logic can be added here
        $locale = app()->getLocale();
        
        // Add locale to request
        $request->attributes->set('locale', $locale);
        
        // Add to response headers
        $response = $next($request);
        $response->header('Content-Language', $locale);
        
        return $response;
    }
}
```

## 7. API Response with Language Info

```php
<?php

namespace App\Http\Controllers\Api;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        return response()->json([
            'success' => true,
            'locale' => app()->getLocale(),
            'direction' => \App\Helpers\LanguageHelper::getDirection(),
            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'description' => $product->description,
            ]
        ]);
    }
}
```

## 8. Conditional Rendering Based on Language

```vue
<template>
    <div class="content">
        <!-- Show Arabic-specific content -->
        <div v-if="currentLocale === 'ar'" class="rtl-content">
            <p>محتوى خاص باللغة العربية</p>
        </div>

        <!-- Show English-specific content -->
        <div v-else-if="currentLocale === 'en'" class="ltr-content">
            <p>English specific content</p>
        </div>

        <!-- Generic content for all languages -->
        <div class="generic-content">
            <p>{{ $t('messages.universal_message') }}</p>
        </div>

        <!-- RTL-safe styling -->
        <style :scoped="{ direction: currentDirection }">
            .content {
                direction: v-bind(currentDirection);
            }
        </style>
    </div>
</template>

<script>
import { languageMixin } from '@/utils/language';

export default {
    mixins: [languageMixin]
}
</script>
```

## 9. Dynamic Language Switching in Store (Vuex)

```javascript
// store/index.js
const state = {
    currentLocale: 'en',
    currentDirection: 'ltr',
};

const mutations = {
    SET_LOCALE(state, locale) {
        state.currentLocale = locale;
    },
    SET_DIRECTION(state, direction) {
        state.currentDirection = direction;
    },
};

const actions = {
    async changeLanguage({ commit }, locale) {
        const result = await axios.post('/api/language/set', { locale });
        if (!result.error) {
            commit('SET_LOCALE', locale);
            commit('SET_DIRECTION', result.direction);
            document.documentElement.dir = result.direction;
        }
        return result;
    },
};

const getters = {
    getCurrentLocale: state => state.currentLocale,
    getCurrentDirection: state => state.currentDirection,
};

export default {
    state,
    mutations,
    actions,
    getters,
};
```

## 10. Testing Language Features

```php
<?php

namespace Tests\Feature;

use Tests\TestCase;

class LanguageTest extends TestCase
{
    public function test_user_can_change_language()
    {
        $response = $this->post('/api/language/set', ['locale' => 'ar']);
        
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'locale' => 'ar',
            'direction' => 'rtl',
        ]);
    }

    public function test_invalid_locale_rejected()
    {
        $response = $this->post('/api/language/set', ['locale' => 'invalid']);
        
        $response->assertStatus(400);
    }

    public function test_authenticated_user_language_persists()
    {
        $user = User::factory()->create(['language' => 'fr']);
        
        $this->actingAs($user)
             ->get('/')
             ->assertSee('Français');
    }

    public function test_guest_language_in_session()
    {
        $response = $this->get('/');
        $this->assertEquals('en', session('locale') ?? 'en');
    }
}
```

## Usage Notes

- **Import statements**: Make sure to import the mixin or utilities as shown
- **Blade functions**: `__()` function is built into Laravel
- **Vue translation**: Use `$t()` if you have Vue i18n installed, or use the server-rendered approach
- **CSS paths**: Adjust paths based on your directory structure
- **API calls**: Ensure CSRF token is included in POST requests

## Common Patterns

### Pattern 1: Detect and Apply
```javascript
// Detect user's browser language and apply
const browserLang = languageUtils.detectBrowserLocale();
await languageUtils.setLanguage(browserLang);
```

### Pattern 2: User Preference Override
```javascript
// Check database > session > browser > default
const locale = localStorage.getItem('lang') || 'en';
```

### Pattern 3: RTL Safe Styling
```css
.content {
    margin-right: 10px;  /* Will flip to left for RTL */
}

/* Better approach - use logical properties */
.content {
    margin-inline-start: 10px;  /* Works in RTL and LTR */
}
```

These examples cover the most common implementation patterns! 🚀
