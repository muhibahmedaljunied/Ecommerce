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
                    <li v-for="(category, index) in showAllCategory">
                      <input v-model="check_category[index]" type="checkbox" :id="category.id" :value="category.id"
                        @change="onchange_category(category.id, index)">
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
                    <li v-for="(size, index) in showAllSize">
                      <input @change="onchange_size(size.id, index)" v-model="check_size[index]" type="checkbox"
                        :id="size.id" :value="size.id">
                      <label :for="size.id">{{ size.name }}</label>
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
                    <li v-for="(country, index) in showAllCountry">
                      <input @change="onchange_country(country.id, index)" v-model="check_country[index]" type="checkbox"
                        :id="country.id" :value="country.id">
                      <label :for="country.id">{{ country.name }}</label>
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
                      <img class="card-img" :src="`/assets/upload/${catProduct.image}`" alt="Product Image"
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
                      <router-link :to="`/customer/single-product/${catProduct.id}`">
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
      showCatProduct: '',
      myInput: '',
      check_category: [],
      check_country: [],
      check_size: [],
      array_id: {

        'category_id':0,
        'country_id':0,
        'size_id':0,
      },

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
      // console.log(this.$route.params.id);
      axios.post(`/category_c/${this.$route.params.id}`)
        .then((response) => {
          console.log('sdddd',response.data);
          this.showCatProduct = response.data;
        })
    },
    onchange_category(id, index) {
      

      if (this.check_category[index] == true) {

        this.array_id.category_id =id;
        for (let i = 0; i < this.check_category.length; i++) {

          if (index != i) {

            this.check_category[i] = false;

          }

        }
        axios.post(`/category_filter`, { 'array_id':this.array_id})
          .then((response) => {
            console.log(response.data);
            this.showCatProduct = response.data;
          })
      }

    },
    onchange_country(id, index) {
      console.log(index);

      if (this.check_country[index] == true) {

        this.array_id.country_id =id;
        for (let i = 0; i < this.check_country.length; i++) {

          if (index != i) {

            this.check_country[i] = false;

          }

        }
        axios.post(`/country_filter`,{ 'array_id':this.array_id})
          .then((response) => {
            console.log(response.data);

            this.showCatProduct = response.data;
          })
      }

    },
    onchange_size(id, index) {
      console.log(index);

      if (this.check_size[index] == true) {
        this.array_id.size_id =id;

        for (let i = 0; i < this.check_size.length; i++) {

          if (index != i) {

            this.check_size[i] = false;

          }

        }
        axios.post(`/size_filter`,{ 'array_id':this.array_id})
          .then((response) => {
            console.log(response.data);

            this.showCatProduct = response.data;
          })
      }

    },
    get_by_price(e) {


      // alert(this.myInput);
      axios.post(`/product_by_price/${this.myInput}`)
        .then((response) => {
          // console.log(response.data)
          this.showCatProduct = response.data;
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
