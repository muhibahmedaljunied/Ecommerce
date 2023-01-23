<template>
  <div>
    <!--================Category Product Area =================-->
    <section class="cat_product_area section_gap">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <div class="left_sidebar_area">
              <aside class="left_widgets p_filter_widgets">
                <div class="l_w_title">
                  <h3>Browse Categories</h3>
                </div>
                <div class="widgets_inner">
                  <ul class="list">
                    <li v-for="category in showAllCategory">
                      <input type="checkbox" :id="category.id"  :value="category.id" @change="onchange(category.id)" >
                      <label :for="category.id">{{ category.name }}</label>
                    </li>

                  </ul>
                </div>
              </aside>

              <aside class="left_widgets p_filter_widgets">
                <div class="l_w_title">
                  <h3>Product Size</h3>
                </div>
                <div class="widgets_inner">
                  <ul class="list">
                    <li v-for="size in showAllSize">
                      <input type="checkbox" :id="size.id"  :value="size.id">
                      <label :for="size.id">{{size.name}}</label>
                    </li>

                  </ul>
                </div>
              </aside>
              <aside class="left_widgets p_filter_widgets">
                <div class="l_w_title">
                  <h3>Product Country</h3>
                </div>
                <div class="widgets_inner">
                  <ul class="list">
                    <li v-for="country in showAllCountry">
                      <input type="checkbox" :id="country.id"  :value="country.id">
                      <label :for="country.id">{{country.name}}</label>
                    </li>

                  </ul>
                </div>
              </aside>

              <aside class="left_widgets p_filter_widgets">
                <div class="l_w_title">
                  <h3>Price Filter</h3>
                </div>
                <div class="widgets_inner">
                  <div class="range_item">
                    <div id="slider-range"></div>
                    <div class="">
                      <label for="amount">Price : </label>
                      <input v-model="myInput" type="text" id="amount" @input="get_by_price()" />
                    </div>
                  </div>
                </div>
              </aside>
            </div>
          </div>

          <div class="col-lg-9">
            <div class="product_top_bar">
              <div class="left_dorp">
                <select class="sorting">
                  <option value="1">Default sorting</option>
                  <option value="2">Default sorting 01</option>
                  <option value="4">Default sorting 02</option>
                </select>
                <select class="show">
                  <option value="1">Show 12</option>
                  <option value="2">Show 14</option>
                  <option value="4">Show 16</option>
                </select>
              </div>
            </div>

            <div class="latest_product_inner">
              <div class="row">
                <div class="col-lg-4 col-md-6" v-for="catProduct in showCatProduct">
                  <div class="single-product">
                    <div class="product-img">
                      <img class="card-img" :src="`/assets/img/allimages/shirt/${catProduct.image}`" alt="Product Image"
                        height='50px' /> 
                      <div class="p_icon">
                        <router-link :to="`/customer/single-product/${catProduct.id}`">
                          <i class="ti-eye"></i>
                        </router-link>
                        <a href="#">
                          <i class="ti-heart"></i>
                        </a>
                        <button @click="addToCart(catProduct.id)">
                          <i class="ti-shopping-cart"></i>
                        </button>
                      </div>
                    </div>
                    <div class="product-btm">
                      <router-link :to="`/single-product/${catProduct.id}`">
                        <h4>{{ catProduct.name }}</h4>
                      </router-link>
                      <div class="mt-3" v-if="catProduct.discount">
                        <span class="mr-4">$ {{ catProduct.price }}</span>
                        <!-- <del>৳ {{ catProduct.price }}</del> -->
                      </div>
                      <div class="mt-3" v-else>
                        <span class="mr-4">${{ catProduct.price }}</span>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
    <!--================End Category Product Area =================-->
  </div>
</template>

<script>
export default {
  data() {
    return {
      cartQty: '1',
      id: '',
      showCatProduct:'',
      myInput:'',
    }
  },
  mounted() {
    this.$Progress.start();
    this.$store.dispatch("categoryByID", this.$route.params.id)
    this.$store.dispatch("category")
    this.$store.dispatch("size")
    this.$store.dispatch("country")
    this.$Progress.finish();
    this.showProduct();
  },
  methods: {
    showProduct() {
      axios.post(`/category_c/${this.$route.params.id}`)
          .then((response) =>{
            // console.log(response.data)
            this.showCatProduct= response.data;
          })
    },
    onchange(id) {
      axios.post(`/category_c/${id}`)
          .then((response) =>{
            // console.log(response.data)
            this.showCatProduct= response.data;
          })
    },
    get_by_price(e){
 
      
      // alert(this.myInput);
      axios.post(`/product_by_price/${this.myInput}`)
          .then((response) =>{
            // console.log(response.data)
            this.showCatProduct= response.data;
          })


    },
    addToCart(id) {
      this.$Progress.start();
      this.axios.get(`/add-cart/${id}/1`).then((response) => {
        console.log(response.data.result);
        this.$store.dispatch("countCart")
        this.$Progress.finish();
      })
    }
  },
  computed: {
    // showCatProduct() {
    //   return this.$store.getters.getCatProduct
    // },
    showAllCategory() {
      return this.$store.getters.getCategory
    },
    showAllSize() {
      return this.$store.getters.getSize
    },
    showAllCountry() {
      return this.$store.getters.getCountry
    }
  },

}

</script>
