<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    protected $supportedLocales = ['en', 'ar', 'fr', 'de', 'it', 'ru', 'es'];

    public function setLanguage($locale)
    {
        if (in_array($locale, $this->supportedLocales)) {
            if (auth()->check()) {
                auth()->user()->update(['language' => $locale]);
            } else {
                session(['locale' => $locale]);
            }
            app()->setLocale($locale);
        }
        
        return redirect()->back();
    }

    public function setLanguageApi(Request $request)
    {
        $locale = $request->input('locale');

        if (!in_array($locale, $this->supportedLocales)) {
            return response()->json(['error' => 'Invalid locale'], 400);
        }

        if (auth()->check()) {
            auth()->user()->update(['language' => $locale]);
        } else {
            session(['locale' => $locale]);
        }

        app()->setLocale($locale);

        return response()->json([
            'success' => true,
            'locale' => $locale,
            'direction' => \App\Helpers\LanguageHelper::getDirection($locale),
            'message' => 'Language updated successfully'
        ]);
    }

    public function getCurrentLanguage()
    {
        $locale = auth()->check() 
            ? auth()->user()->language 
            : session('locale', config('app.locale'));

        return response()->json([
            'locale' => $locale,
            'direction' => \App\Helpers\LanguageHelper::getDirection($locale),
            'isRTL' => \App\Helpers\LanguageHelper::isRTL($locale),
        ]);
    }

    public function getAvailableLanguages()
    {
        $languages = [
            ['code' => 'en', 'name' => 'English', 'flag' => '🇺🇸', 'direction' => 'ltr'],
            ['code' => 'ar', 'name' => 'العربية', 'flag' => '🇸🇦', 'direction' => 'rtl'],
            ['code' => 'fr', 'name' => 'Français', 'flag' => '🇫🇷', 'direction' => 'ltr'],
            ['code' => 'de', 'name' => 'Deutsch', 'flag' => '🇩🇪', 'direction' => 'ltr'],
            ['code' => 'it', 'name' => 'Italiano', 'flag' => '🇮🇹', 'direction' => 'ltr'],
            ['code' => 'ru', 'name' => 'Русский', 'flag' => '🇷🇺', 'direction' => 'ltr'],
            ['code' => 'es', 'name' => 'Español', 'flag' => '🇪🇸', 'direction' => 'ltr'],
        ];

        return response()->json($languages);
    }

    public function getTranslations($locale)
    {
        $path = resource_path("lang/{$locale}/messages.php");
        if (file_exists($path)) {
            $translations = require $path;
            return response()->json(['messages' => $translations]);
        }
        return response()->json(['messages' => []]);
    }
}
