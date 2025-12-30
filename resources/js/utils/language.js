export const languageUtils = {
    supportedLocales: ['en', 'ar', 'fr', 'de', 'it', 'ru', 'es'],

    detectBrowserLocale() {
        const browserLangs = navigator.languages || [navigator.language];
        
        for (let lang of browserLangs) {
            const langCode = lang.split('-')[0].toLowerCase();
            if (this.supportedLocales.includes(langCode)) {
                return langCode;
            }
        }
        
        return 'en';
    },

    async getCurrentLanguage() {
        try {
            const response = await window.axios.get('/api/language/current');
            return response.data;
        } catch (error) {
            console.error('Error fetching current language:', error);
            return { locale: 'en', direction: 'ltr', isRTL: false };
        }
    },

    async setLanguage(locale) {
        if (!this.supportedLocales.includes(locale)) {
            return { error: 'Invalid locale' };
        }

        try {
            const response = await window.axios.post('/api/language/set', { locale });
            this.updatePageDirection(response.data.direction);
            return response.data;
        } catch (error) {
            console.error('Error setting language:', error);
            return { error: 'Failed to set language' };
        }
    },

    updatePageDirection(direction) {
        document.documentElement.dir = direction;
        document.documentElement.lang = direction === 'rtl' ? 'ar' : 'en';
    },

    getLanguageFlag(locale) {
        const flagMap = {
            'en': '🇺🇸',
            'ar': '🇸🇦',
            'fr': '🇫🇷',
            'de': '🇩🇪',
            'it': '🇮🇹',
            'ru': '🇷🇺',
            'es': '🇪🇸',
        };
        return flagMap[locale] || '🌐';
    },

    getLanguageName(locale) {
        const nameMap = {
            'en': 'English',
            'ar': 'العربية',
            'fr': 'Français',
            'de': 'Deutsch',
            'it': 'Italiano',
            'ru': 'Русский',
            'es': 'Español',
        };
        return nameMap[locale] || locale;
    },

    async getAvailableLanguages() {
        try {
            const response = await window.axios.get('/api/language/available');
            return response.data;
        } catch (error) {
            console.error('Error fetching available languages:', error);
            return [
                { code: 'en', name: 'English', flag: '🇺🇸', direction: 'ltr' },
                { code: 'ar', name: 'العربية', flag: '🇸🇦', direction: 'rtl' },
                { code: 'fr', name: 'Français', flag: '🇫🇷', direction: 'ltr' },
                { code: 'de', name: 'Deutsch', flag: '🇩🇪', direction: 'ltr' },
                { code: 'it', name: 'Italiano', flag: '🇮🇹', direction: 'ltr' },
                { code: 'ru', name: 'Русский', flag: '🇷🇺', direction: 'ltr' },
                { code: 'es', name: 'Español', flag: '🇪🇸', direction: 'ltr' },
            ];
        }
    }
};

export const languageMixin = {
    data() {
        return {
            currentLocale: 'en',
            currentDirection: 'ltr',
            isRTL: false,
            availableLanguages: [],
            browserDetectedLocale: null,
        };
    },

    computed: {
        currentLanguageName() {
            return languageUtils.getLanguageName(this.currentLocale);
        },

        currentLanguageFlag() {
            return languageUtils.getLanguageFlag(this.currentLocale);
        }
    },

    methods: {
        async loadCurrentLanguage() {
            const data = await languageUtils.getCurrentLanguage();
            this.currentLocale = data.locale;
            this.currentDirection = data.direction;
            this.isRTL = data.isRTL;
        },

        async loadAvailableLanguages() {
            this.availableLanguages = await languageUtils.getAvailableLanguages();
        },

        detectBrowserLocale() {
            this.browserDetectedLocale = languageUtils.detectBrowserLocale();
            return this.browserDetectedLocale;
        },

        async switchLanguage(locale) {
            const result = await languageUtils.setLanguage(locale);
            if (!result.error) {
                this.currentLocale = result.locale;
                this.currentDirection = result.direction;
                this.isRTL = locale === 'ar';
            }
            return result;
        }
    },

    async mounted() {
        await this.loadCurrentLanguage();
        await this.loadAvailableLanguages();
        this.detectBrowserLocale();
    }
};
