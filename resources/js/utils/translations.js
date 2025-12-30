let translations = {};

export const translationUtils = {
    supportedLocales: ['en', 'ar', 'fr', 'de', 'it', 'ru', 'es'],

    async loadTranslations(locale) {
        try {
            const response = await window.axios.get(`/api/translations/${locale}`);
            translations[locale] = response.data;
            return response.data;
        } catch (error) {
            console.error('Error loading translations:', error);
            return {};
        }
    },

    async loadAllTranslations() {
        const allTranslations = {};
        for (const locale of this.supportedLocales) {
            allTranslations[locale] = await this.loadTranslations(locale);
        }
        return allTranslations;
    },

    t(key, locale = null) {
        const currentLocale = locale || window.currentLanguage || 'en';
        const keys = key.split('.');
        let value = translations[currentLocale] || {};

        for (const k of keys) {
            if (value && typeof value === 'object' && value[k] !== undefined) {
                value = value[k];
            } else {
                return keys[keys.length - 1];
            }
        }

        return value;
    },

    setCurrentLocale(locale) {
        window.currentLanguage = locale;
    }
};

export const globalLanguageMixin = {
    methods: {
        $t(key) {
            const keys = key.split('.');
            const translations = (this.$store && this.$store.getters) ? this.$store.getters.getTranslations : {};
            let value = translations || {};
            
            for (const k of keys) {
                if (value && typeof value === 'object' && value[k] !== undefined) {
                    value = value[k];
                } else {
                    return keys[keys.length - 1];
                }
            }
            return value;
        }
    },

    computed: {
        currentLocale() {
            return (this.$store && this.$store.getters) ? this.$store.getters.getCurrentLocale : 'en';
        },

        currentDirection() {
            const locale = this.currentLocale;
            const isRTL = locale === 'en';
            return isRTL ? 'rtl' : 'ltr';
        },

        storeTranslations() {
            return (this.$store && this.$store.getters) ? this.$store.getters.getTranslations : {};
        }
    }
};

export const translationMixin = {
    data() {
        return {
            translations: {},
            currentLocale: 'en'
        };
    },

    methods: {
        $t(key) {
            return translationUtils.t(key, this.currentLocale);
        },

        async loadTranslations() {
            this.translations = await translationUtils.loadAllTranslations();
        }
    },

    async mounted() {
        await this.loadTranslations();
    }
};
