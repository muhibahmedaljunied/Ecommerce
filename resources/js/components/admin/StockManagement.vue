<template>
  <div class="container">
    <h2>Stock Management</h2>
    <div class="mb-3">
      <input v-model="search" placeholder="Search product" class="form-control" @keyup.enter="fetch" />
    </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Variant ID</th>
          <th>Product</th>
          <th>Qty</th>
          <th>Alert Qty</th>
          <th>Low Stock</th>
          <th>Last Transaction</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in items" :key="item.id">
          <td>{{ item.id }}</td>
          <td>{{ item.product_name || '—' }}</td>
          <td>{{ item.qty }}</td>
          <td>{{ item.alert_qty }}</td>
          <td>
            <span v-if="item.low_stock" class="badge badge-danger">Low</span>
            <span v-else class="badge badge-success">OK</span>
          </td>
          <td>
            <div v-if="item.last_transaction">
              <div><strong>{{ item.last_transaction.type }}</strong> ({{ item.last_transaction.change }})</div>
              <small>{{ item.last_transaction.created_at }}</small>
            </div>
            <div v-else>—</div>
          </td>
        </tr>
      </tbody>
    </table>

    <nav v-if="meta.total > meta.per_page">
      <ul class="pagination">
        <li class="page-item" :class="{disabled: meta.current_page === 1}">
          <a class="page-link" href="#" @click.prevent="goTo(meta.current_page - 1)">Prev</a>
        </li>
        <li class="page-item" :class="{disabled: meta.current_page === meta.last_page}">
          <a class="page-link" href="#" @click.prevent="goTo(meta.current_page + 1)">Next</a>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  data() {
    return {
      items: [],
      meta: {
        total: 0,
        per_page: 50,
        current_page: 1,
        last_page: 1
      },
      search: ''
    };
  },
  mounted() {
    this.fetch();
  },
  methods: {
    fetch(page = 1) {
      const params = { per_page: this.meta.per_page, page };
      if (this.search) params.search = this.search;
      this.axios
        .get('/api/admin/stocks', { params })
        .then((r) => {
          this.items = r.data.data;
          this.meta = r.data;
        })
        .catch((e) => {
          console.error(e);
          this.$toast.fire({ icon: 'error', title: 'Failed to load stocks' });
        });
    },
    goTo(page) {
      if (page < 1 || page > this.meta.last_page) return;
      this.fetch(page);
    }
  }
};
</script>

<style scoped>
.badge-danger { background: #dc3545; }
.badge-success { background: #28a745; }
</style>
