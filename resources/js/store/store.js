import { forEach, forEachRight } from "lodash"
export default {
  state: {
		categories: [],
    sizes: [],
    countries:[],
    featuredProducts: [],
    newProducts: [],
    catProducts: [],
    singleProducts: [],
    cartProduct: [],
    countCart: [],
    subtotalCart: [],
    customerSession:[],
    productOrder:[],
    orderDetails:[],
    customerOrder:[],
    currentLocale: localStorage.getItem('lang') || 'en',
    translations: {},
    availableLanguages: [],
  },

  getters: {
    getCurrentLocale(state) {
        return state.currentLocale;
    },
    getTranslations(state) {
        return state.translations;
    },
    getAvailableLanguages(state) {
        return state.availableLanguages;
    },
    getCategory(state){
  		return state.categories
  	},
    getSize(state){
  		return state.sizes
  	},
    getCountry(state){
  		return state.countries
  	},
    getFeaturedProduct(state){
      return state.featuredProducts
    },
    getNewProduct(state){
      return state.newProducts
    },
    getCatProduct(state){
      return state.catProducts
    },
    getSingleProduct(state){
      return state.singleProducts
    },
    getCartItem(state){
      return state.cartProduct
    },
    getCountCart(state){
      return state.countCart
    },
    getCartSubtotal(state){
      return state.subtotalCart
    },
    getOrderInformation(state){
      return state.orderDetails
    },
    getProductInformation(state){
      return state.productOrder
    },
    getCustomerInformation(state){
      return state.customerOrder
    },
    getSessionData(state){
      return state.customerSession
    },
    // getCommentData(state){
    //   return state.productComment
    // }
  },

  actions: {
    category(context){
      axios.post('/category')
          .then((response) =>{
            //console.log(response.data)
            context.commit("allCategory", response.data)
          })
    },
    size(context){
      axios.post('/size')
          .then((response) =>{
            // console.log('muhib',response.data)
            // alert('df');
            context.commit("allSize", response.data)
          })
    },
    country(context){
      axios.post('/country')
          .then((response) =>{
            // console.log('muhib',response.data)
            // alert('df');
            context.commit("allCountry", response.data)
          })
    },

    featuredProduct(context){
      axios.post('/featured-product')
          .then((response) =>{
            //console.log(response.data)
            context.commit("getFeaturedProduct", response.data)
          })
    },
    newProduct(context){
      axios.post('/new-product')
          .then((response) =>{
            //console.log(response.data)
            context.commit("getNewProduct", response.data)
          })
    },
    categoryByID(context, payload){
      axios.post('/category_group_filter/'+ payload)
          .then((response) =>{
            // console.log(response.data)
            context.commit("getProductbyId", response.data)
          })
    },
    getProducstbyId(context, payload){
      axios.post('/product-details/'+ payload)
          .then((response) =>{
            //console.log(response.data)
            context.commit("getSingleProduct", response.data)
          })
    },
    getCartItem(context){
      axios.post('/all-cart')
          .then((response) =>{
            console.log(response.data.cart)
            
            context.commit("allCartItem", response.data.cart)
          })
    },
    countCart(context){
      axios.post('/all-cart')
          .then((response) =>{
            console.log(response.data)
            context.commit("countCartItem", response.data.count_cart)
          })
    },

    async setLanguage({ commit, dispatch }, locale) {
        try {
            const response = await axios.post('/api/language/set', { locale });
            commit('setCurrentLocale', locale);
            localStorage.setItem('lang', locale);
            document.documentElement.dir = response.data.direction;
            await dispatch('loadTranslations', locale);
        } catch (error) {
            console.error('Error setting language:', error);
        }
    },

    async loadTranslations({ commit }, locale) {
        try {
            const response = await axios.get(`/api/translations/${locale}`);
            commit('setTranslations', response.data || {});
        } catch (error) {
            console.error('Error loading translations:', error);
        }
    },

    async loadAvailableLanguages({ commit }) {
        try {
            const response = await axios.get('/api/language/available');
            commit('setAvailableLanguages', response.data);
        } catch (error) {
            console.error('Error loading available languages:', error);
        }
    },
    getAllCarttotal(context){
      axios.post('/all-cart')
          .then((response) =>{
            console.log(response)
            context.commit("allCarttotal", response.data.subtotal)
          })
    },
    getOrderdetails(context,payload){
      axios.post('/order-details/'+ payload)
          .then((response) =>{
            // console.log(response.data);
            context.commit("orderDetails", response.data)
          })
    },
    productByorder(context,payload){
      axios.post('/product-order/'+ payload)
          .then((response) =>{
            // console.log(response.data.cart)
            context.commit("productByorder", response.data)
          })
    },
    customerByorder(context,payload){
      axios.post('/customer-order/'+ payload)
          .then((response) =>{
            // console.log(response.data)
            context.commit("customerByorder", response.data)
          })
    },
    customerSession(context){
      axios.post('/customer-session')
          .then((response)=>{
            // console.log(response.data.s_customer)
            context.commit("sessionData", response.data.s_customer)
          })
    },
    // getProductComment(context, payload){
    //   axios.get('/product-comment/'+ payload)
    //       .then((response)=>{
    //         //console.log(response.data)
    //         context.commit("commentData", response.data)
    //       })
    // }
  },

	mutations: {
    allCategory(state, data){
      return state.categories = data
    },
    setCurrentLocale(state, locale) {
        state.currentLocale = locale;
    },
    setTranslations(state, translations) {
        state.translations = translations;
    },
    setAvailableLanguages(state, languages) {
        state.availableLanguages = languages;
    },
    allSize(state, data){
      return state.sizes = data
    },
    allCountry(state, data){
      return state.countries = data
    },
    getFeaturedProduct(state, data){
      return state.featuredProducts = data
    },
    getNewProduct(state, data){
      return state.newProducts = data
    },
    getProductbyId(state, data){
      return state.catProducts = data
    },
    getSingleProduct(state, data){
      return state.singleProducts = data
    },
    allCartItem(state, data){
      return state.cartProduct = data
    },
    countCartItem(state, data){
      return state.countCart = data
    },
    allCarttotal(state, data){
      return state.subtotalCart = data
    },
    productByorder(state, data){
      return state.productOrder = data
    },
    orderDetails(state, data){
      return state.orderDetails = data
    },
    customerByorder(state, data){
      return state.customerOrder = data
    },
    sessionData(state, data){
      return state.customerSession = data
    },
    // commentData(state, data){
    //   return state.productComment = data
    // }
  }
}