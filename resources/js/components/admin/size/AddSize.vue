<template>
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">مقاسات المنتج</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form">
                        <form method="post" @submit.prevent="addsize">

                            <div class="form-group">
                                <label for="name">الاسم</label>
                                <input v-model="data.name" type="text" name="name" id="name" class="form-control">

                            </div>

                            <div class="form-group">
                                <label for="status">الحاله</label>
                                <input v-model='data.status' type="text" name="status" id="status" class="form-control">

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
            data: {
                name: '',
                status: ''
            },
            message: []
        }
    },
    methods: {

        addsize(event) {

            this.axios.post(`store_size`, { name: this.data.name, status: this.data.status }).then((response) => {
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