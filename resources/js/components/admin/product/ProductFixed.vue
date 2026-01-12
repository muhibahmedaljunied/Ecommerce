<template>
  <div class="container-fluid">
    <fieldset class="border rounded-3 p-3">
      <legend class="float-none w-auto px-3">{{ $t('messages.Category Tree') }}</legend>
      <div class="input-group">
        <input type="text" id="ricerca-enti" class="form-control" :placeholder="$t('messages.Search') + '...'" aria-describedby="search-addon">
      </div>
      <div id="treeview_json_product"><div id="test"></div></div>
    </fieldset>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div style="display: flex;float: left; margin: 5px">
              <button @click="exports_excel()"><i class="fa-solid fa-file-export" style="font-size: 24px; color: #63E6BE;"></i></button>
              <button @click="imports_excel()"><i class="fa-solid fa-file-import" style="font-size: 24px; color: #B197FC;"></i></button>
              <input type="search" autocomplete="on" name="search" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true" :placeholder="$t('messages.Search')" v-model="word_search" @input="get_search()" />
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="table-responsive">
                <table class="table text-md-nowrap" id="example1">
                  <thead>
                    <tr></tr>
                  </thead>

                  <tbody v-if="showCatProduct && showCatProduct.length > 0">
                    <tr v-for="(productss, index) in showCatProduct" :key="index">
                      <td colspan="7">
                        <div class="row">
                          <div class="col-md-2">{{ index + 1 }}</div>
                          <div class="col-md-2">
                            {{ $t('messages.' + productss.text) }}
                            <div class="col-md-12" v-for="produc_option in productss['product_family_attribute']" :key="produc_option.id">
                              <template v-if="produc_option.family_attribute_option && produc_option.family_attribute_option.length">
                                <span v-for="option in produc_option.family_attribute_option" :key="option.id">{{ $t('messages.' + option.value) }}</span>
                              </template>
                            </div>
                          </div>

                          <div class="col-md-8">
                            <div v-for="product_family in productss['product_family_attribute']" :key="product_family.id" class="row">
                              <div class="col-md-4">
                                <div class="col-md-12">{{ $t('messages.Quantity') }}: {{ product_family.qty }}</div>
                                <div class="col-md-12">{{ $t('messages.Price') }}:{{ product_family.price }}</div>
                              </div>
                              <div class="col-md-2">
                                <img class="card-img" :src="`/Ecommerce/assets/upload/${product_family.image}`" alt="Product Image" height='200px' />
                              </div>
                              <div class="col-md-6">
                                <button type='button' class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                <router-link :to="{ name: 'edit_product', params: { data: productss } }" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></router-link>
                              </div>
                            </div>
                          </div>
                        </div>
                        <hr>
                      </td>
                    </tr>
                  </tbody>

                  <tbody v-else>
                    <tr>
                      <td style="text-align: center;" colspan="7">{{ $t('messages.No data available') }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      showCatProduct: '',
      word_search: '',
      counts: [],
      count: 1,
      count_attributes: 1,
      att_family: [],
      attribute_families: ''
    }
  },
  mounted() {
    this.counts[0] = 1;
    this.showtree();
    this.att_family = Array.from(Array(this.count), () => new Array(this.count_attributes))
    this.fetchProducts();
  },
  methods: {
    fetchProducts() {
      this.axios.post('/product').then(response => {
        this.showCatProduct = response.data.product;
      })
    },
    showtree() {
      var gf = this;
      this.axios.post(`/tree_product`).then((response) => {
        this.attribute_families = response.data.attribute_families;
        this.jsonTreeData = response.data.trees;
        // minimal tree init
      });
    },
    exports_excel() {
      var gf = this;
      axios.post(`/export_opening_inventuries`).then(function (response) {
        toastMessage(gf.$t('messages.export_success'));
        gf.$router.go(0);
      }).catch(() => {});
    },
    imports_excel() {
      var gf = this;
      axios.post(`/import_opening_inventuries`).then(function (response) {
        toastMessage(gf.$t('messages.import_success'));
        gf.$router.go(0);
      }).catch(() => {});
    }
  }
}
</script>

<style>
legend {
  font-weight: lighter;
  color: cadetblue;
}
</style>
