<template>
    <div>
        <!--================Cart Area =================-->
    <section class="cat_product_area section_gap">
      <div class="container">
        <div class="cart_inner">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <!-- <th scope="col"></th> -->
                  <th scope="col">{{ $t('messages.products') }}</th>
                  <th scope="col">{{ $t('messages.price') }}</th>
                  <th scope="col">{{ $t('messages.quantity') }}</th>
                  <th scope="col">{{ $t('messages.total') }}</th>
                  <th scope="col">{{ $t('messages.action') }}</th>
                  <!-- <th scope="col">المنتج</th>
                  <th scope="col">السعر</th>
                  <th scope="col">الكميه</th>
                  <th scope="col">الاجمالي</th>
                  <th scope="col">العمليات</th> -->
                </tr>
              </thead>
              <tbody>
                <tr v-for='cart in showCartItem'>
                  <!-- <td><input type="checkbox" :value="cart.rowId"  v-model="checkItem" name=""></td> -->
                  <td>
                    <div class="media">
                      <div class="d-flex">
                        <img :src="`/Ecommerce/assets/upload/${cart.image}`" height="100px" alt="Product Image"/>
                      </div>
                      <div class="media-body">
                        <p>{{cart.text}}</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <h5>$ {{cart.price}}</h5>
                  </td>
                  <td>
                    <div class="product_count">
                      <input type="number" name="qty" v-model="cart.qty_cart" @change="updateCart(cart.id,cart.qty_cart)" title="Quantity" class="input-text qty"/>
                    </div>
                  </td>
                  <td>
                    <h5>${{cart.price*cart.qty_cart}} </h5>
                  </td>
                  <td>
                    <button @click.prevent="removeCart(cart.id)" class="btn btn-danger">X</button>
                  </td>
                </tr>
                
                <tr class="bottom_button">
                  <td>
                    
                  </td>
                  <td><!-- {{checkItem}} --></td>
                  <td><h5>{{ $t('messages.subtotal') }}</h5></td>
                  <td>
                    <h5>$ {{showSubtotal}}</h5>
                  </td>
                  <td></td>
                </tr>
                <tr class="out_button_area">
                  <td></td>
                  <td></td>
                  <td></td>
                  
                  <td>
                    <!-- <div class="checkout_btn_inner" v-if="showSession">
                      <router-link class="gray_btn" to="/customer/home">Continue Shopping</router-link>
                      <router-link class="main_btn" to="/customer/shipping">Proceed to checkout</router-link>
                    </div>
                    <div class="checkout_btn_inner" v-else>
                      <router-link class="gray_btn" to="/customer/home">Continue Shopping</router-link>
                      <router-link class="main_btn" to="/customer/login">Proceed to checkout</router-link>
                    </div> -->
                     <div class="checkout_btn_inner" >
                      <router-link class="gray_btn" to="/customer/home">{{ $t('messages.continue_shopping') }}</router-link>
                      <router-link class="main_btn" to="/customer/payment">{{ $t('messages.proceed_checkout') }}</router-link>
                    </div>
                  
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <!--================End Cart Area =================-->
    </div>
</template>

<script>
    export default {
        // name: "cart",
        data(){
          return{
            checkItem:[],
            
          }
        },
        mounted(){
          this.fetchCart();
        },
        watch: {
          currentLocale() {
            this.fetchCart();
          }
        },
        computed: {
          showCartItem(){
            return this.$store.getters.getCartItem
          },
          showSubtotal(){
            return this.$store.getters.getCartSubtotal
          },
          showSession(){
              return this.$store.getters.getSessionData
          }
        },
        methods:{
          fetchCart() {
            this.$Progress.start();
            this.$store.dispatch("getCartItem")
            this.$store.dispatch("getAllCarttotal")
            this.$Progress.finish();
          },
          removeCart(Id){
              // this.$Progress.start();
              axios.post('/delete-cart',{
                id: Id
              }).then((response)=>{
                
                // console.log(response.data);
               
                toast.fire({
                                title: this.$t('messages.remove'),
                                text: this.$t('messages.cart_deleted'),
                                button: "Close", // Text on button
                                icon: "success", //built in icons: success, warning, error, info
                                timer: 3000, //timeOut for auto-close
                                buttons: {
                                    confirm: {
                                    text: "OK",
                                    value: true,
                                    visible: true,
                                    className: "",
                                    closeModal: true
                                    },
                                    cancel: {
                                    text: "Cancel",
                                    value: false,
                                    visible: true,
                                    className: "",
                                    closeModal: true,
                                    }
                                }
                            })
                this.$store.dispatch("getCartItem");
                this.$store.dispatch("countCart");
                this.$store.dispatch("getAllCarttotal");
                this.$Progress.finish();
              })
          },
          updateCart(Id,Qty){
         
              this.$Progress.start();

              axios.post('/update-cart',{
                id: Id,
                qty: Qty
              }).then((response)=>{
                console.log('dfdf1');
                console.log(response.data);
                console.log('dfdf2');
                  // toast.fire({
                  //               title: "Updated!",
                  //               text: "Your product has been updated in cart.",
                  //               button: "Close", // Text on button
                  //               icon: "success", //built in icons: success, warning, error, info
                  //               timer: 3000, //timeOut for auto-close
                  //               buttons: {
                  //                   confirm: {
                  //                   text: "OK",
                  //                   value: true,
                  //                   visible: true,
                  //                   className: "",
                  //                   closeModal: true
                  //                   },
                  //                   cancel: {
                  //                   text: "Cancel",
                  //                   value: false,
                  //                   visible: true,
                  //                   className: "",
                  //                   closeModal: true,
                  //                   }
                  //               }
                  //           })
                this.$store.dispatch("getCartItem");
                this.$store.dispatch("countCart");
                this.$store.dispatch("getAllCarttotal");
                this.$Progress.finish()
              })
          },
          start () {
            this.$Progress.start()
          }
        }
    }
</script>
