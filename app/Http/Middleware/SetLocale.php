<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    protected $supportedLocales = ['en', 'ar', 'fr', 'de', 'it', 'ru', 'es'];

    public function handle(Request $request, Closure $next)
    {
        $locale = config('app.locale');
        
        if (auth()->check()) {
            $locale = auth()->user()->language ?? $locale;
        } elseif (session('locale')) {
            $locale = session('locale');
        } else {
            $locale = $this->detectBrowserLocale($request) ?? $locale;
        }
        
        app()->setLocale($locale);
        
        return $next($request);
    }

    private function detectBrowserLocale(Request $request)
    {
        $acceptLanguage = $request->header('Accept-Language');
        
        if (!$acceptLanguage) {
            return null;
        }

        $languages = $this->parseAcceptLanguage($acceptLanguage);
        
        foreach ($languages as $lang) {
            if (in_array($lang, $this->supportedLocales)) {
                return $lang;
            }
        }
        
        return null;
    }

    private function parseAcceptLanguage($acceptLanguage)
    {
        $languages = [];
        $parts = explode(',', $acceptLanguage);
        
        foreach ($parts as $part) {
            $piece = explode(';', trim($part));
            $lang = trim($piece[0]);
            
            $langCode = explode('-', $lang)[0];
            
            if (!in_array($langCode, $languages)) {
                $languages[] = $langCode;
            }
        }
        
        return $languages;
    }
}
