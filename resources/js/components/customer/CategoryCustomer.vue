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
                    <h1 class="mb-0">
                      <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        <!-- Filter By Category -->

                        {{ $t('messages.filter_by_category') }}
                      </button>
                    </h1>
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

                              <input type="text" id="ricerca-enti" class="form-control" :placeholder="$t('messages.search') + '...'"
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

                <div class="card" v-for="(attribute_filter, index) in data_fliter">

                  <div class="card-header" :id=index>
                    <h1 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" :data-target="'#' + index"
                        aria-expanded="false" :aria-controls=index>
                        {{ $t('messages.filter_by') }}   {{ $t('messages.' + index) }}
                      </button>

                    </h1>
                  </div>
                  <div :id=index class="collapse" :aria-labelledby=index data-parent="#accordion">
                    <div class="card-body">

                      <ul class="list">

                        <li v-for="(attribute_filter2, index1) in attribute_filter">


                          <input @change="onchange($event, index, index1)" type="checkbox" :id="index1">
                          <label :for="index"> {{ index1 }}</label>
                        </li>
                        <li>
                          <input type="checkbox">
                          <label>{{ $t('messages.all') }} </label>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <!-- <div class="card" v-for="attribute_filter in all_attribute_filter">



                  <div class="card-header" :id="'headingThree' + attribute_filter.id">
                    <h1 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse"
                        :data-target="'#collapseThree' + attribute_filter.id" aria-expanded="false"
                        :aria-controls="'collapseThree' + attribute_filter.id">
                        بحسب {{ attribute_filter.attribute.name }}
                      </button>

                    </h1>
                  </div>
                  <div :id="'collapseThree' + attribute_filter.id" class="collapse"
                    :aria-labelledby="'headingThree' + attribute_filter.id" data-parent="#accordion">
                    <div class="card-body">

                      <ul class="list">

                        <li v-for="(attribute_filter2, index) in data_fliter">
{{ attribute_filter2 }}
                          <input @change="onchange_country(attribute_filter2.id, index)" type="checkbox"
                            :id="attribute_filter2.id">
                          <label :for="attribute_filter2.id"> {{ attribute_filter2.value }}</label>
                        </li>
                        <li>
                          <input v-model="data_fliter" type="checkbox" id="country_id" :value="0"
                            @change="onchange_country(0, index)">
                          <label>الكل </label>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div> -->

                <!-- <div class="card">
                  <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="false" aria-controls="collapseTwo">
                        {{ $t('messages.filter_by_size') }}
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
                          <label>{{ $t('messages.all') }}</label>
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
                        {{ $t('messages.filter_by_country') }}
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
                          <label>{{ $t('messages.all') }}</label>
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
                        {{ $t('messages.filter_by_price') }}
                      </button>
                    </h5>
                  </div>
                  <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                    <div class="card-body">

                      <div class="widgets_inner">
                        <div class="range_item">
                          <div id="slider-range"></div>
                          <div class="">
                            <label for="amount">{{ $t('messages.price') }} : </label>
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
                        {{ $t('messages.filter_by_color') }}
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
                        {{ $t('messages.filter_by_material') }}
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
                        {{ $t('messages.filter_by_gender') }}
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
                        {{ $t('messages.filter_by_brand') }}
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
                  <option value="1">{{ $t('messages.default_sorting') }}</option>
                  <option value="2">{{ $t('messages.default_sorting') }} 01</option>
                  <option value="4">{{ $t('messages.default_sorting') }} 02</option>
                </select>
                <select class="show">
                  <option value="1">{{ $t('messages.show') }} 12</option>
                  <option value="2">{{ $t('messages.show') }} 14</option>
                  <option value="4">{{ $t('messages.show') }} 16</option>
                </select>
              </div>
            </div>

            <div class="latest_product_inner">
              <div class="row" v-if="showCatProduct && showCatProduct.length > 0">



                <div class="col-lg-4 col-md-4" v-for="catProduct in showCatProduct">

                  <div class="product-card">
                    <div v-if="catProduct['product_family_attribute']" class="single-product">


                      <div v-for="dd in catProduct['product_family_attribute']">
                        <div class="product-img">
                          <img class="card-img" :src="`/Ecommerce/assets/upload/${dd.image}`" alt="Product Image"
                            height='180px' />
                          <div class="p_icon">
                            <router-link :to="`/Ecommerce/customer/single-product/${dd.id}`">
                              <i class="ti-eye"></i>
                            </router-link>
                            <a href="#">
                              <i class="ti-heart"></i>
                            </a>
                            <a href="#" @click="addToCart(dd.id)">
                              <i class="ti-shopping-cart"></i>
                            </a>


                          </div>
                        </div>
                        <div class="product-btm">
                          <div class="mt-3">

                            <router-link :to="`/customer/single-product/${dd.product_id}`">
                              <h1 class="product-title">{{ $t('messages.' + catProduct.text) }}</h1>
                            </router-link>

                          </div>

                          <!-- <div v-for="dd2 in dd.product_family_attribute "> -->

                          <div class="mt-3" v-if="dd.discount">
                            <span class="mr-4">$ {{ dd.price }}</span>
                          </div>
                          <div class="mt-3" v-else>
                            <span class="mr-4">${{ dd.price }}</span>
                          </div>

                          <!-- <div class="mt-3">
                            <span class="mr-4">{{ dd.description }}</span>
                          </div> -->

                          <!-- <hr>
                          <div class="mt-3">
                            <h5>Sales </h5>
                          </div> -->

                          <!-- </div> -->




                        </div>
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
      all_attribute_filter: '',
      data_fliter: '',
      check_value: [],
      array_id: {

        'product_id': Array(this.count),
      },
      jsonTreeData: '',

    }
  },
  mounted() {

    this.$Progress.start();
    // this.$store.dispatch("categoryByID", this.$route.params.id)
    this.$Progress.finish();
    this.showProduct();
    this.showtree();
  },
  watch: {
    $route(to, from) {

      this.$Progress.start();
      this.$store.dispatch("categoryByID", this.$route.params.id)
      this.$Progress.finish();
      this.showProduct();
      this.refreshTree();



    },
    currentLocale() {
      this.refreshTree();
      this.showProduct();
    }

  },

  methods: {
    refreshTree() {
      if ($('#treeview_json_product').jstree(true)) {
        $('#treeview_json_product').jstree(true).destroy();
      }
      this.showtree();
    },
    translateTree(nodes) {
      if (!nodes) return [];
      return nodes.map(node => {
        const newNode = { ...node };
        if (newNode.text) {
          newNode.text = this.$t('messages.' + newNode.text);
        }
        if (newNode.children && newNode.children.length > 0) {
          newNode.children = this.translateTree(newNode.children);
        }
        return newNode;
      });
    },
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

        this.jsonTreeData = this.translateTree(response.data.trees);

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
          axios.post(`/category_filter/${data.node.id}`, { 'type': 'product' }).then((response) => {

            gf.showCatProduct = response.data.products;
            gf.array_id.product_id = data.node.id;

          });

        });

      });

      $('#treeview_json_product').jstree(true).destroy();


    },


    showProduct() {
      // console.log(this.$route.params.id);
      this.array_id.product_id = this.$route.params.id;
      axios.post(`/category_group_filter/${this.$route.params.id}`, { 'type': 'product' })
        .then((response) => {
          console.log('sdddd', response.data);
          this.all_attribute_filter = response.data.product_filterable_attributes;

          var studentsList = {};

          this.all_attribute_filter.forEach(function (student) {


            studentsList[student.attribute.name] = {};

            student.attribute.attribute_option.forEach(function (student2) {

              studentsList[student.attribute.name][student2.value] = 0;

            });

          });

          this.data_fliter = studentsList;
          // console.log('ddddd22222', this.data_fliter)
          this.showCatProduct = response.data.products;
        })
    },

    onchange(event, id, index) {
      // console.log('---------',event.target.checked);

      if (event.target.checked == true) {

        this.data_fliter[id][index] = true;

      } else {

        this.data_fliter[id][index] = false;

      }


      axios.post(`/filter`, {
        'data_fliter': this.data_fliter,
        'array_id': this.array_id,
        'type': 'attribute'
      })
        .then((response) => {
          // console.log('country', response.data);

          this.showCatProduct = response.data.products;
        })




    },


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
  }

}

</script>

<style>
img {

  border-radius: 7px;
}

.product-card {
  padding: 241px;
  padding-top: 21px;
  padding-right: 21px;
  padding-bottom: 21px;
  padding-left: 21px;
  border: 1px solid #e1e7ec;
  border-radius: 7px;
  background-color: #fff;
}

.product-card .product-title {

  margin-bottom: 10px;
  font-size: 16px;
  font-weight: normal;
  text-align: center;

}
</style>
