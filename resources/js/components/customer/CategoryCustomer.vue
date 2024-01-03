<template>
  <div>


    <!--================Category Product Area =================-->
    <section class="cat_product_area section_gap">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <div class="left_sidebar_area">
              <!-- ------------------------------------- -->
              <div id="accordion">
                <div class="card">
                  <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                      <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                        aria-controls="collapseOne">
                        Filter By Category


                      </button>
                    </h5>
                  </div>

                  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">

                    <!-- ////////////////////////////////////////////////////////////// -->
                    <div class="card-body">
                      <!-- <div class="container">
                        <div class="well" id="treeview_json_product"></div>

                      </div> -->

                      <!-- ----------------- -->

                      <div class="container">
                        <div class="row">
                          <div class="col-xs-12">
                            <div class="input-group">

                              <input type="text" id="ricerca-enti" class="form-control" placeholder="بحث..."
                                aria-describedby="search-addon">

                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-xs-12" id="treeview_json_product">
                            <div id="test">

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

                <div class="card" v-for="attribute_filter in all_attribute_filter">
                
                                           

                  <div class="card-header" :id="'headingThree'+attribute_filter.id" >
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" :data-target="'#collapseThree'+attribute_filter.id" 
                        aria-expanded="false" :aria-controls="'collapseThree'+attribute_filter.id">
                        بحسب   {{attribute_filter.attribute.name}}
                      </button>
                     
                    </h5>
                  </div>
                  <div :id="'collapseThree'+attribute_filter.id"   class="collapse" :aria-labelledby="'headingThree'+attribute_filter.id" data-parent="#accordion">
                    <div class="card-body">
                 
                      <ul class="list">
                      
                     <li v-for="(attribute_filter2, index) in attribute_filter.attribute.attribute_option">
                          <input @change="onchange_country(attribute_filter2.id, index)" v-model="check_country[index]"
                            type="checkbox" :id="attribute_filter2.id" :value="attribute_filter2.id">
                          <label :for="attribute_filter2.id">     {{attribute_filter2.value}}</label>
                        </li>
                        <!-- <li>
                          <input v-model="check_country[index]" type="checkbox" id="country_id" :value="0"
                            @change="onchange_country(0, index)">
                          <label>Show all</label>
                        </li>  -->
                      </ul>
                    </div>
                  </div>
                </div>

                <!-- <div class="card">
                  <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="false" aria-controls="collapseTwo">
                        Filter By Size
                      </button>
                    </h5>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                      <ul class="list">
                        <li v-for="(size, index) in showAllSize">
                          <input @change="onchange_size(size.id, index)" v-model="check_size[index]" type="checkbox"
                            :id="size.id" :value="size.id">
                          <label :for="size.id">{{ size.name }}</label>
                        </li>
                        <li>
                          <input v-model="check_size[index]" type="checkbox" id="size_id" :value="0"
                            @change="onchange_size(0, index)">
                          <label>Show all</label>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"
                        aria-expanded="false" aria-controls="collapseThree">
                        Filter By Country
                      </button>
                    </h5>
                  </div>
                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                      <ul class="list">
                        <li v-for="(country, index) in showAllCountry">
                          <input @change="onchange_country(country.id, index)" v-model="check_country[index]"
                            type="checkbox" :id="country.id" :value="country.id">
                          <label :for="country.id">{{ country.name }}</label>
                        </li>
                        <li>
                          <input v-model="check_country[index]" type="checkbox" id="country_id" :value="0"
                            @change="onchange_country(0, index)">
                          <label>Show all</label>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="headingFour">
                    <h5 class="mb-0">

                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour"
                        aria-expanded="false" aria-controls="collapseFour">
                        Filter By Price
                      </button>
                    </h5>
                  </div>
                  <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                    <div class="card-body">
                  
                      <div class="widgets_inner">
                        <div class="range_item">
                          <div id="slider-range"></div>
                          <div class="">
                            <label for="amount">Price : </label>
                            <input v-model="myInput" type="text" id="amount" @input="get_by_price()" />
                          </div>
                        </div>
                      </div>
              
                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="card-header" id="headingfive">
                    <h5 class="mb-0">

                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsefive"
                        aria-expanded="false" aria-controls="collapsefive">
                        Filter By Color
                      </button>
                    </h5>
                  </div>
                  <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordion">
                    <div class="card-body">
                      <ul class="list">
                        <li v-for="(country, index) in showAllCountry">
                          <input @change="onchange_country(country.id, index)" v-model="check_country[index]"
                            type="checkbox" :id="country.id" :value="country.id">
                          <label :for="country.id">{{ country.name }}</label>
                        </li>

                      </ul>
                    </div>
                  </div>
                </div>


                <div class="card">
                  <div class="card-header" id="headingSix">
                    <h5 class="mb-0">

                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix"
                        aria-expanded="false" aria-controls="collapseSix">
                        Filter By Material
                      </button>
                    </h5>
                  </div>
                  <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                    <div class="card-body">
                      <ul class="list">
                        <li v-for="(country, index) in showAllCountry">
                          <input @change="onchange_country(country.id, index)" v-model="check_country[index]"
                            type="checkbox" :id="country.id" :value="country.id">
                          <label :for="country.id">{{ country.name }}</label>
                        </li>

                      </ul>
                    </div>
                  </div>
                </div>


                <div class="card">
                  <div class="card-header" id="headingSeven">
                    <h5 class="mb-0">

                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSeven"
                        aria-expanded="false" aria-controls="collapseSeven">
                        Filter By Gender
                      </button>
                    </h5>
                  </div>
                  <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                    <div class="card-body">
                      <ul class="list">
                        <li v-for="(country, index) in showAllCountry">
                          <input @change="onchange_country(country.id, index)" v-model="check_country[index]"
                            type="checkbox" :id="country.id" :value="country.id">
                          <label :for="country.id">{{ country.name }}</label>
                        </li>

                      </ul>
                    </div>
                  </div>
                </div>

                
                <div class="card">
                  <div class="card-header" id="headingEight">
                    <h5 class="mb-0">

                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseEight"
                        aria-expanded="false" aria-controls="collapseEight">
                        Filter By Brand
                      </button>
                    </h5>
                  </div>
                  <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion">
                    <div class="card-body">
                      <ul class="list">
                        <li v-for="(brand, index) in showAllBrand">
                          <input @change="onchange_brand(brand.id, index)" v-model="check_brand[index]"
                            type="checkbox" :id="brand.id" :value="brand.id">
                          <label :for="brand.id">{{ brand.name }}</label>
                        </li>

                      </ul>
                    </div>
                  </div>
                </div> -->
              </div>

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
              <div class="row" v-if="showCatProduct && showCatProduct.length > 0">


                <div class="col-lg-4 col-md-6" v-for="catProduct in showCatProduct">

                  <!-- <div v-if="catProduct['product_attribute']" class="single-product">

                    <div v-for="dd in catProduct['product_attribute']">
                      {{ dd }}
                    </div>
                    <hr>

                    <div>
                      {{catProduct}}
                    </div>
                  </div> -->
                  <div v-if="catProduct['product_family_attribute']" class="single-product">


                    <div v-for="dd in catProduct['product_family_attribute']">
                      <div class="product-img">
                        <img class="card-img" :src="`/assets/upload/${dd.image}`" alt="Product Image" height='50px' />
                        <div class="p_icon">
                          <router-link :to="`/customer/single-product/${dd.id}`">
                            <i class="ti-eye"></i>
                          </router-link>
                          <a href="#">
                            <i class="ti-heart"></i>
                          </a>
                          <button @click="addToCart(dd.product_id)">
                            <i class="ti-shopping-cart"></i>
                          </button>


                        </div>
                      </div>
                      <div class="product-btm">
                        <div class="mt-3">

                          <router-link :to="`/customer/single-product/${dd.product_id}`">
                            <h1>{{ catProduct.text }}</h1>
                          </router-link>

                        </div>
                        <hr>
                        <!-- <div v-for="dd2 in dd.product_family_attribute "> -->

                          <div class="mt-3" v-if="dd.discount">
                            <span class="mr-4">$ {{ dd.price }}</span>
                          </div>
                          <div class="mt-3" v-else>
                            <span class="mr-4">${{ dd.price }}</span>
                          </div>
                          <hr>
                          <div class="mt-3">
                            <span class="mr-4">{{ dd.description }}</span>
                          </div>

                          <hr>
                          <div class="mt-3">
                            <h5>Sales </h5>
                          </div>

                        <!-- </div> -->




                      </div>
                    </div>


                  </div>
                  <div v-else class="single-product">
                    <div class="product-img">
                      <img class="card-img" :src="`/assets/upload/${catProduct.image}`" alt="Product Image"
                        height='50px' />
                      <div class="p_icon">
                        <router-link :to="`/customer/single-product/${catProduct.product_id}`">
                          <i class="ti-eye"></i>
                        </router-link>
                        <a href="#">
                          <i class="ti-heart"></i>
                        </a>
                        <button @click="addToCart(catProduct.product_id)">
                          <i class="ti-shopping-cart"></i>
                        </button>


                      </div>
                    </div>
                    <div class="product-btm">
                      <div class="mt-3">

                        <router-link :to="`/customer/single-product/${catProduct.product_id}`">
                          <h1>{{ catProduct.text }}</h1>
                        </router-link>
                      </div>
                      <hr>
                   
                      <div class="mt-3" v-if="catProduct.discount">
                        <span class="mr-4">$ {{ catProduct.price }}</span>
                      </div>
                      <div class="mt-3" v-else>
                        <span class="mr-4">${{ catProduct.price }}</span>
                      </div>
                      <div class="mt-3">
                        <span class="mr-4">{{ catProduct.description }}</span>
                      </div>
                      <div class="mt-3">
                        <h5>Sales </h5>
                      </div>




                    </div>
                  </div>
                </div>
              </div>

              <div v-else class="row">

                <div class="col-md-12">
                  <h1> لايوجد اي منتجات

                  </h1>
                </div>
              </div>
            </div>
          </div>




        </div>
      </div>
    </section>
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
      check_brand: [],
      all_attribute_filter:'',
      array_id: {

        'product_id': 0,
        'country_id': 0,
        'size_id': 0,
        // 'brand_id': 0,

      },
      jsonTreeData: '',

    }
  },
  mounted() {

    this.$Progress.start();
    this.$store.dispatch("categoryByID", this.$route.params.id)
    // this.$store.dispatch("category")
    // this.$store.dispatch("size")
    // this.$store.dispatch("country")

    // this.$store.dispatch("brand")
    // this.$store.dispatch("color")
    // this.$store.dispatch("material")
    // this.$store.dispatch("gender")

    this.$Progress.finish();
    this.showProduct();
    this.showtree();
  },
  watch: {
    $route(to, from) {

      this.$Progress.start();
      this.$store.dispatch("categoryByID", this.$route.params.id)
      // this.$store.dispatch("category")
      // this.$store.dispatch("size")
      // this.$store.dispatch("country")

      // this.$store.dispatch("brand")
      // this.$store.dispatch("color")
      // this.$store.dispatch("material")
      // this.$store.dispatch("gender")

      this.$Progress.finish();
      this.showProduct();
      this.showtree();



    }
  },

  methods: {

    showtree() {

      console.log('in show tree', this.$route.params.id);
      var uri = `/tree_product/${this.$route.params.id}`;
      var gf = this;


      // ------------هذا لاجل البحث في الشجره-----------------------------
      var to = false;
      $('#ricerca-enti').keyup(function () {
        if (to) {
          clearTimeout(to);
        }
        to = setTimeout(function () {
          var v = $('#ricerca-enti').val();
          $('#treeview_json_product').jstree(true).search(v);
        }, 250);
      });

      // -------------------------------------------------

      this.axios.post(uri).then((response) => {
        //   this.trees = response.data.trees;

        this.jsonTreeData = response.data.trees;

        $(`#treeview_json_product`).jstree({
          core: {
            themes: {
              responsive: false,
            },
            // so that create works
            check_callback: true,
            data: this.jsonTreeData,
          },
          // types: {
          // default: {
          //   icon: "fa fa-plus text-primary",
          // },
          // file: {
          //   icon: "fa fa-file  text-primary",
          // },
          // },
          // checkbox: {
          //   three_state: false,

          // },
          state: {
            key: "demo2"
          },
          search: {
            case_insensitive: true,
            show_only_matches: true
          },
          plugins: [
            // "checkbox",
            "contextmenu",
            "dnd",
            "massload",
            "search",
            // "sort",
            "state",
            // "types",
            "unique",
            "wholerow",
            "changed",
            "conditionalselect"],
          contextmenu: {
            items: {

              renameItem: {
                // The "rename" menu item
                label: "تحرير",
                action: function (data) {

                  console.log('تحرير');
                },
              },
              deleteItem: {
                // The "delete" menu item
                label: "حذف",
                action: function (data) {

                  console.log('حذف');

                },
              },
              addItem: {
                // The "delete" menu item
                label: "اضافه",
                action: function (data) {


                  console.log('اضافه');


                },
              },

            }
          },

        }).on('rename_node.jstree', function (e, data) {

        }).on("changed.jstree", function (e, data) {

          gf.array_id.product_id = data.node.id;

          // alert(data.node.id);
          axios.post(`/category_filter/${data.node.id}`).then((response) => {

            gf.showCatProduct = response.data;
            gf.array_id.product_id = data.node.id;

          });

        });

      });

      $('#treeview_json_product').jstree(true).destroy();


    },


    showProduct() {
      // console.log(this.$route.params.id);
      this.array_id.product_id = this.$route.params.id;
      axios.post(`/category_c/${this.$route.params.id}`)
        .then((response) => {
          console.log('sdddd', response.data);
          this.all_attribute_filter = response.data.product_filterable_attributes;
          this.showCatProduct = response.data.products;
        })
    },

    onchange_country(id, index) {
      console.log(index);

      if (this.check_country[index] == true) {

        this.array_id.country_id = id;
        for (let i = 0; i < this.check_country.length; i++) {

          if (index != i) {

            this.check_country[i] = false;

          }

        }
        axios.post(`/country_filter`, { 'array_id': this.array_id })
          .then((response) => {
            console.log('country', response.data);

            this.showCatProduct = response.data;
          })
      }

      if (this.check_country[index] == false) {

        this.array_id.country_id = 0;

      }

    },
    
    // onchange_country(id, index) {
    //   console.log(index);

    //   if (this.check_country[index] == true) {

    //     this.array_id.country_id = id;
    //     for (let i = 0; i < this.check_country.length; i++) {

    //       if (index != i) {

    //         this.check_country[i] = false;

    //       }

    //     }
    //     axios.post(`/country_filter`, { 'array_id': this.array_id })
    //       .then((response) => {
    //         console.log('country', response.data);

    //         this.showCatProduct = response.data;
    //       })
    //   }

    //   if (this.check_country[index] == false) {

    //     this.array_id.country_id = 0;

    //   }

    // },
    // onchange_brand(id, index) {
    //   console.log(index);

    //   if (this.check_brand[index] == true) {

    //     this.array_id.brand_id = id;
    //     for (let i = 0; i < this.check_brand.length; i++) {

    //       if (index != i) {

    //         this.check_brand[i] = false;

    //       }

    //     }
    //     axios.post(`/brand_filter`, { 'array_id': this.array_id })
    //       .then((response) => {
    //         console.log('brand', response.data);

    //         this.showCatProduct = response.data;
    //       })
    //   }

    //   if (this.check_brand[index] == false) {

    //     this.array_id.brand_id = 0;

    //   }

    // },
    // onchange_size(id, index) {
    //   console.log('array', this.array_id);

    //   if (this.check_size[index] == true) {
    //     this.array_id.size_id = id;

    //     for (let i = 0; i < this.check_size.length; i++) {

    //       if (index != i) {

    //         this.check_size[i] = false;

    //       }

    //     }
    //     axios.post(`/size_filter`, { 'array_id': this.array_id })
    //       .then((response) => {
    //         console.log('size', response.data);

    //         this.showCatProduct = response.data;
    //       })
    //   }

    //   if (this.check_size[index] == false) {

    //     this.array_id.size_id = 0;

    //   }

    // },
    // get_by_price(e) {


    //   // alert(this.myInput);
    //   axios.post(`/product_by_price/${this.myInput}`)
    //     .then((response) => {
    //       // console.log(response.data)
    //       this.showCatProduct = response.data;
    //     })


    // },
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
    // showAllCategory() {
    //   return this.$store.getters.getCategory
    // },
    // showAllSize() {
    //   return this.$store.getters.getSize
    // },
    // showAllCountry() {
    //   return this.$store.getters.getCountry
  }


  // },

}

</script>
