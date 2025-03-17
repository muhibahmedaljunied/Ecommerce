<template>
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                            تعديل المستخدمين
                        </div>
                <div class="card-body">
                    <div class="form">
                        <form method="post" @submit.prevent="adduser">

                            <div class="form-group">
                                <label for="name">الاسم</label>
                                <input v-model="data.name" type="text" name="name" id="name">

                            </div>

                            <div class="form-group">
                                <label for="status">الحاله</label>
                                <input v-model='data.status' type="text" name="status" id="status">

                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">حفظ</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- /row -->

</template>
<script>
export default {
    data() {
        return {

        }
    },
    props: ['data'],
    methods: {

        adduser(event) {

            this.axios.post(`/store_user`).then((response) => {
                event.preventDefault();
                this.$router.push('user')
            })

        }
    }
}
</script>