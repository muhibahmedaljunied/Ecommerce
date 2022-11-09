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
                        <h3 class="text-center">Add Category</h3>
                        <form method="post" @submit.prevent="submitForm" enctype="multipart/form-data">
                            <div class="form-group">

                                <ul>
                                    <div v-for="error in errors">
                                        <li>{{ error[0] }}</li>
                                    </div>
                                </ul>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input v-model="data.name" type="text" class="form-control" name="name" id="name">

                            </div>
                            <div class="form-group">
                                <label for="filePhoto">Category Image</label>
                                <input v-on:change="onFileChange" type="file" name="image" class="form-control-file"
                                    id="filePhoto">
                                <img src="" id="previewHolder" width="150px">
                            </div>

                            <div class="form-group">
                                <label for="status">status</label>
                                <input v-model='data.status' type="text" class="form-control" name="status" id="status">

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
            data: {
                name: '',
                status: '',
                image: ''
            },
            file: '',
            errors: '',
            filename: '',
            success: ''
        }
    },
    methods: {

        onFileChange(e) {

            this.file = e.target.files[0];
        },
        submitForm(e) {
            e.preventDefault();
            let currentObj = this;
            const config = {
                headers: {
                    'content-type': 'multipart/form-data',
                }
            }
            // form data
            let formData = new FormData();
            formData.append('image', this.file);
            formData.append('name', this.data.name);
            formData.append('status', this.data.status);

            // send upload request
            this.axios.post('store_category', formData, config)
                .then(function (response) {
                    currentObj.success = response.data.success;
                    currentObj.filename = "";

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
                .catch(function (error) {
                    currentObj.output = error;
                });

                this.$router.go(-1);

        }
    }
}
</script>