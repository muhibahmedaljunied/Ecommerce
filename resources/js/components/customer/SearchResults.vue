<template>
  <div class="container" style="padding:20px">
    <h3>نتائج البحث عن "{{ decodedQ }}"</h3>
    <div v-if="loading" style="margin:10px 0">جاري البحث...</div>
    <div v-if="!loading && products.length==0" style="margin:10px 0">لا توجد نتائج</div>
    <div class="row">
      <div v-for="p in products" :key="p.id" class="col-md-3" style="margin-bottom:20px">
        <div class="card">
          <img :src="p.image || '/assets/img/no-image.png'" class="card-img-top" style="height:160px;object-fit:cover" />
          <div class="card-body">
            <h5 class="card-title">{{ p.text }}</h5>
            <p class="card-text">{{ p.price ? (p.price + ' ر.س') : '' }}</p>
            <router-link :to="`/customer/single-product/${p.id}`" class="btn btn-primary">تفاصيل</router-link>
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
      products: [],
      loading: false,
    };
  },
  computed: {
    decodedQ() {
      return decodeURIComponent(this.$route.params.q || '');
    }
  },
  watch: {
    '$route.params.q'() {
      this.fetch();
    }
  },
  mounted() {
    this.fetch();
  },
  methods: {
    fetch() {
      const q = this.decodedQ;
      if (!q) {
        this.products = [];
        return;
      }
      this.loading = true;
      axios.post('/customer/search', { q: q })
        .then((resp) => {
          this.products = resp.data.products || [];
        })
        .catch((err) => {
          console.error(err);
          this.products = [];
        })
        .finally(() => { this.loading = false; });
    }
  }
}
</script>

<style scoped>
.card { border:1px solid #eee }
</style>
