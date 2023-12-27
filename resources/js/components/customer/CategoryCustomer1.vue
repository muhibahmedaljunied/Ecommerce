<template>
  <div>
    <!--================Category Product Area =================-->
    <section class="cat_product_area section_gap">
      
      <category-list :product="showCatProduct"></category-list>
      <!-- <router-view></router-view> -->

    </section>
  </div>
</template>

<script>
import CategoryList from './CategoryList.vue';

export default {
  
  components: {
    CategoryList,
  },
  // mixins: [CategoryListVue],

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
    // this.$Progress.start();
    // this.$store.dispatch("categoryByID", this.$route.params.id)
    // this.$store.dispatch("category")
    // this.$store.dispatch("size")
    // this.$store.dispatch("country")
    // this.$Progress.finish();
    // this.showtree();
    this.showProduct();
  },
  methods: {

    showtree() {
      var uri = `/tree_product/${this.$route.params.id}`;
      var gf = this;
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

    showProduct() {
      // console.log(this.$route.params.id);
      axios.post(`/category_c/${this.$route.params.id}`)
        .then((response) => {
          console.log('sdddd', response.data);
          this.showCatProduct = response.data;

        })
    },
    // onchange_category(id, index) {


    //   if (this.check_category[index] == true) {

    //     this.array_id.product_id = id;
    //     for (let i = 0; i < this.check_category.length; i++) {

    //       if (index != i) {

    //         this.check_category[i] = false;

    //       }

    //     }
    //     axios.post(`/category_filter`, { 'array_id': this.array_id })
    //       .then((response) => {
    //         console.log(response.data);
    //         this.showCatProduct = response.data;
    //       })
    //   }

    // },
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
            console.log(response.data);

            this.showCatProduct = response.data;
          })
      }

    },
    onchange_size(id, index) {
      console.log(index);

      if (this.check_size[index] == true) {
        this.array_id.size_id = id;

        for (let i = 0; i < this.check_size.length; i++) {

          if (index != i) {

            this.check_size[i] = false;

          }

        }
        axios.post(`/size_filter`, { 'array_id': this.array_id })
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
