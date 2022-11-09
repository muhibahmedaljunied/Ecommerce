import { forEach, forEachRight } from "lodash"
export default {
  state: {
		categories: [],
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
    // productComment:[]
  },

  getters: {
    getCategory(state){
  		return state.categories
  	},
    getfeaturedProduct(state){
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
    featuredProduct(context){
      axios.post('/customer/featured-product')
          .then((response) =>{
            //console.log(response.data)
            context.commit("featureProducts", response.data)
          })
    },
    newProduct(context){
      axios.post('/customer/new-product')
          .then((response) =>{
            //console.log(response.data)
            context.commit("getNewProduct", response.data)
          })
    },
    categoryByID(context, payload){
      axios.post('/customer/category/'+ payload)
          .then((response) =>{
            // console.log(response.data)
            context.commit("getProductbyId", response.data)
          })
    },
    getProducstbyId(context, payload){
      axios.post('/customer/product-details/'+ payload)
          .then((response) =>{
            //console.log(response.data)
            context.commit("getSingleProduct", response.data)
          })
    },
    getCartItem(context){
      axios.post('/customer/all-cart')
          .then((response) =>{
            console.log(response.data.cart)
            
            context.commit("allCartItem", response.data.cart)
          })
    },
    countCart(context){
      axios.post('/customer/all-cart')
          .then((response) =>{
            console.log(response.data)
            context.commit("countCartItem", response.data.count_cart)
          })
    },
    getAllCarttotal(context){
      axios.post('/customer/all-cart')
          .then((response) =>{
            console.log(response)
            context.commit("allCarttotal", response.data.subtotal)
          })
    },
    getOrderdetails(context,payload){
      axios.post('/order-details/'+ payload)
          .then((response) =>{
            // alert(response.data.order_total);
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
            console.log(response.data)
            context.commit("customerByorder", response.data)
          })
    },
    customerSession(context){
      axios.post('/customer/customer-session')
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
    featureProducts(state, data){
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