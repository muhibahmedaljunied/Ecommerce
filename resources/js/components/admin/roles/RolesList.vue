<template>
  <div>
    <h3>Roles</h3>
    <table class="table">
      <thead>
        <tr><th>ID</th><th>Name</th><th>Label</th><th>Actions</th></tr>
      </thead>
      <tbody>
        <tr v-for="r in roles" :key="r.id">
          <td>{{ r.id }}</td>
          <td>{{ r.name }}</td>
          <td>{{ r.label }}</td>
          <td><button class="btn btn-sm btn-primary" @click="editRole(r)">Edit</button></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return { roles: [] };
  },
  mounted() {
    this.fetch();
  },
  methods: {
    fetch() {
      this.axios.get('/api/admin/roles').then(r => (this.roles = r.data)).catch(e => console.error(e));
    },
    editRole(r) {
      // TODO: open modal to edit permissions
      this.$toast.fire({ icon: 'info', title: 'Edit role not implemented yet' });
    }
  }
};
</script>
