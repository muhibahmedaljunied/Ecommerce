<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="left_sidebar_area">
                    <!-- ------------------------------------- -->
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        {{ $t('messages.filter_by_category') }}

                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordion">
                                <!-- <div class="card-body">
                      <ul class="list">
                        <li v-for="(category, index) in showAllCategory">
                          <input v-model="check_category[index]" type="checkbox" :id="category.id" :value="category.id"
                            @change="onchange_category(category.id, index)">
                          <label :for="category.id">{{ category.name }}</label>
                        </li>
                        <li>
                          <input v-model="check_category[index]" type="checkbox" id="product_id" :value="0"
                            @change="onchange_category(0, index)">
                          <label>Show all</label>
                        </li>

                      </ul>
                    </div> -->
                                <!-- ////////////////////////////////////////////////////////////// -->
                                <div class="card-body">
                                    <div class="container">
                                        <!-- <button @click="exporte">export</button>
                          <button @click="importe">import</button> -->


                                        <div class="well" id="treeview_json_product"></div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card">
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
                                            <input @change="onchange_size(size.id, index)" v-model="check_size[index]"
                                                type="checkbox" :id="size.id" :value="size.id">
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
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        {{ $t('messages.filter_by_country') }}
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <ul class="list">
                                        <li v-for="(country, index) in showAllCountry">
                                            <input @change="onchange_country(country.id, index)"
                                                v-model="check_country[index]" type="checkbox" :id="country.id"
                                                :value="country.id">
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

                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        {{ $t('messages.filter_by_price') }}
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                                <div class="card-body">
                                    <!-- <aside class="left_widgets p_filter_widgets"> -->
                                    <!-- <div class="l_w_title">
                          <h3>Price Filter</h3>
                        </div> -->
                                    <div class="widgets_inner">
                                        <div class="range_item">
                                            <div id="slider-range"></div>
                                            <div class="">
                                                <label for="amount">{{ $t('messages.price') }} : </label>
                                                <input v-model="myInput" type="text" id="amount" @input="get_by_price()" />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- </aside> -->
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingfive">
                                <h5 class="mb-0">

                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                                        {{ $t('messages.filter_by_color') }}
                                    </button>
                                </h5>
                            </div>
                            <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordion">
                                <div class="card-body">
                                    <ul class="list">
                                        <li v-for="(country, index) in showAllCountry">
                                            <input @change="onchange_country(country.id, index)"
                                                v-model="check_country[index]" type="checkbox" :id="country.id"
                                                :value="country.id">
                                            <label :for="country.id">{{ country.name }}</label>
                                        </li>
                                        <!-- <li>
                          <input v-model="check_country[index]" type="checkbox" id="country_id" :value="0"
                            @change="onchange_country(0, index)">
                          <label>Show all</label>
                        </li> -->
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
                                            <input @change="onchange_country(country.id, index)"
                                                v-model="check_country[index]" type="checkbox" :id="country.id"
                                                :value="country.id">
                                            <label :for="country.id">{{ country.name }}</label>
                                        </li>
                                        <!-- <li>
                          <input v-model="check_country[index]" type="checkbox" id="country_id" :value="0"
                            @change="onchange_country(0, index)">
                          <label>Show all</label>
                        </li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header" id="headingSeven">
                                <h5 class="mb-0">

                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                        {{ $t('messages.filter_by_gender') }}
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <ul class="list">
                                        <li v-for="(country, index) in showAllCountry">
                                            <input @change="onchange_country(country.id, index)"
                                                v-model="check_country[index]" type="checkbox" :id="country.id"
                                                :value="country.id">
                                            <label :for="country.id">{{ country.name }}</label>
                                        </li>
                                        <!-- <li>
                          <input v-model="check_country[index]" type="checkbox" id="country_id" :value="0"
                            @change="onchange_country(0, index)">
                          <label>Show all</label>
                        </li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ------------------------------------- -->
                    <!-- <aside class="left_widgets p_filter_widgets">
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
              </aside> -->
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
                    <div class="row" v-if="product && product.length > 0">


                        <div class="col-lg-4 col-md-6" v-for="catProduct in product">

                            <div v-if="catProduct['product_attribute']" class="single-product">


                                <div v-for="dd in catProduct['product_attribute']">
                                    <div class="product-img">
                                        <img class="card-img" :src="`/Ecommerce/assets/upload/${dd.image}`" alt="Product Image"
                                            height='50px' />
                                        <div class="p_icon">
                                            <router-link :to="`/customer/single-product/${dd.product_id}`">
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
                                        <router-link :to="`/customer/single-product/${dd.product_id}`">
                                            <h4>{{ $t('messages.' + catProduct.text) }}</h4>
                                        </router-link>
                                        <div class="mt-3" v-if="dd.discount">
                                            <span class="mr-4">$ {{ dd.price }}</span>
                                        </div>
                                        <div class="mt-3" v-else>
                                            <span class="mr-4">${{ dd.price }}</span>
                                        </div>
                                        <h4>{{ $t('messages.sales') }}</h4>


                                    </div>
                                </div>


                            </div>
                            <div v-else class="single-product">
                                <div class="product-img">
                                    <img class="card-img" :src="`/Ecommerce/assets/upload/${catProduct.image}`" alt="Product Image"
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
                                    <router-link :to="`/customer/single-product/${catProduct.product_id}`">
                                        <h4>{{ $t('messages.' + catProduct.text) }}</h4>
                                    </router-link>
                                    <div class="mt-3" v-if="catProduct.discount">
                                        <span class="mr-4">$ {{ catProduct.price }}</span>
                                    </div>
                                    <div class="mt-3" v-else>
                                        <span class="mr-4">${{ catProduct.price }}</span>
                                    </div>
                                    <h4>{{ $t('messages.sales') }}</h4>


                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-else class="row">

                        <div class="col-md-12">
                            <h1> {{ $t('messages.no_products') }}

                            </h1>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>
</template>
<script>


export default {

    props: ['product'],

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

                'product_id': 0,
                'country_id': 0,
                'size_id': 0,
            },

            jsonTreeData: '',

        }
    },
    mounted() {

        console.log('sddddddddsdsd',this.$route.params.id);
        this.showtree();

    },
    watch: {
        currentLocale() {
            this.refreshTree();
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
            var uri = `/tree_product/${this.$route.params.id}`;
            var gf = this;
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
                    types: {
                        default: {
                            icon: "fa fa-folder text-primary",
                        },
                        file: {
                            icon: "fa fa-file  text-primary",
                        },
                    },
                    checkbox: {
                        three_state: false,

                    },
                    state: {
                        key: "demo2"
                    },
                    search: {
                        case_insensitive: true,
                        show_only_matches: true
                    },
                    plugins: ["checkbox",
                        "contextmenu",
                        "dnd",
                        "massload",
                        "search",
                        "sort",
                        "state",
                        "types",
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
                        // console.log(gf.showCatProduct);
                    });

                });

            });
        },



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
