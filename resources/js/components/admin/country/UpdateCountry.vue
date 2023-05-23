<template>
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0"> بلد الصنع</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form">
                        <form method="post" @submit.prevent="updatecountry">

                            <input v-model='country.id' type="hidden" name="id_name" id="id_name">
                            <div class="form-group">
                                <label for="name">الاسم</label>
                                <input v-model='country.name' type="text" class="form-control" name="name" id="name">

                            </div>

                            <div class="form-group">
                                <label for="status">الحاله</label>
                                <input v-model='country.status' type="text" class="form-control" name="status"
                                    id="status">

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
            country: {
                id: '',
                name: '',
                status: ''
            }
        }
    },
    created() {
        let uri = `/country/${this.$route.params.id}`;
        this.axios.post(uri).then(response => {

            this.country.id = response.data.id;
            this.country.name = response.data.name;
            this.country.status = response.data.status;

        });
    },
    methods: {
        updatecountry(event) {
            let uri = `/update_country/${this.$route.params.id}`;
            axios.post(uri, { name: this.country.name, status: this.country.status }).then(response => {
                event.preventDefault();
                toast.fire({
                    title: "Updated!",
                    text: "Your category has been updated.",
                    button: "Close", // Text on button
                    icon: "success", //built in icons: success, warning, error, info
                    timer: 3000, //timeOut for auto-close
                    buttons: {
                        confirm: {
                            text: "OK",
                            value: true,
                            visible: true,
                            className: "",
                            closeModal: true
                        },
                        cancel: {
                            text: "Cancel",
                            value: false,
                            visible: true,
                            className: "",
                            closeModal: true,
                        }
                    }
                })
            })
            this.$router.go(-1);
        }
    }
}
</script>