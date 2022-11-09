<template>
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">SIMPLE TABLE</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2">Example of Valex Simple Table. <a href="">Learn more</a></p>
                </div>
                <div class="card-body">
                    <div class="form">
                        <h3 class="text-center">Add country</h3>
                        <form method="post" @submit.prevent="addcountry">

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input v-model="name" type="text" class="form-control" name="name" id="name">

                            </div>

                            <div class="form-group">
                                <label for="status">status</label>
                                <input v-model='status' type="text" class="form-control" name="status" id="status">

                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Add</button>
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
            name: '',
            status: ''

        }
    },
    methods: {

        addcountry(event) {

            this.axios.post(`store_country`, { name: this.name, status: this.status }).then((response) => {
                event.preventDefault();
                toast.fire({
                    title: "Added!",
                    text: "Your category has been added.",
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