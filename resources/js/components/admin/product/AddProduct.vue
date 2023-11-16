<template>
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">المنتجات</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form">
                        <form method="post">
                            <div class="form-group">
                                <ul>
                                    <div v-for="error in errors">
                                        <li>{{ error[0] }}</li>
                                    </div>
                                </ul>
                            </div>
                            <div class="form-group">
                                <label for="Product">الاسم</label>
                                <input v-model="product" type="text" name="Product" id="Product" class="form-control">

                            </div>

                            <div class="form-group">
                                <label for="Category">الصنف</label>
                                <select v-model="categoryselected" name="Category" id="Category" class="form-control">
                                    <option value="">select</option>
                                    <option v-for="categorys in category" v-bind:value='categorys.id'>{{ categorys.name
                                    }}
                                    </option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="Country">بلد الصنع</label>
                                <select v-model='countryselected' name="Country" id="Country" class="form-control">
                                    <option value="">select</option>
                                    <option v-for="countrys in country" v-bind:value='countrys.id'>{{ countrys.name }}
                                    </option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="filePhoto">صوره المنتج</label>
                                <input v-on:change="onFileChange" type="file" name="image" class="form-control-file"
                                    id="filePhoto">
                                <img src="" id="previewHolder" width="150px">
                            </div>
                            <div class="form-group">
                                <label for="Size">المقاس</label>
                                <select v-model='sizeselected' name="Size" id="Size" class="form-control">
                                    <option value="">select</option>
                                    <option v-for="sizes in size" v-bind:value='sizes.id'>{{ sizes.name }}</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="Product">الكميه</label>
                                <input v-model="qty" type="text" name="Qty" id="Qty" class="form-control">

                            </div>
                            <div class="form-group">
                                <label for="Product">السعر</label>
                                <input v-model="price" type="text" name="price" id="price" class="form-control">

                            </div>
                            <div class="form-group">
                                <label for="Product">الخصم</label>
                                <input v-model="discount" type="text" name="discount" id="discount" class="form-control">

                            </div>
                            <div class="form-group">
                                <label for="Product">الحاله</label>
                                <input v-model="status" type="text" name="status" id="status" class="form-control">

                            </div>

                            <button @click="submitForm()" type="button"
                                class="btn btn-primary btn-lg btn-block">حفظ</button>
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

            category: '',
            country: '',
            size: '',
            product: '',
            qty: '',
            price: '',
            discount: '',
            status: '',
            image: '',
            categoryselected: '',
            countryselected: '',
            sizeselected: '',
            errors: '',
            success: '',
            filename: ''
        }
    },
    created() {
        this.axios.post('/create_product').then((response) => {
            console.log(response.data);
            this.category = response.data.category;
            this.country = response.data.country;
            this.size = response.data.size;

        });
    },
    methods: {
        onFileChange(e) {

            this.file = e.target.files[0];
        },
        submitForm() {
            let currentObj = this;
            const config = {
                headers: {
                    'content-type': 'multipart/form-data',
                }
            }
            // form data
            let formData = new FormData();
            formData.append('product', this.product);
            formData.append('category', this.categoryselected);
            formData.append('country', this.countryselected);
            formData.append('size', this.sizeselected);
            formData.append('qty', this.qty);
            formData.append('price', this.price);
            formData.append('discount', this.discount);
            formData.append('status', this.status);
            formData.append('image', this.file);
            // send upload request
            this.axios.post('store_product', formData, config)
                .then(function (response) {
                    // currentObj.success = response.data.success;
                    // currentObj.filename = "";

                    toast.fire({
                        title: "Added!",
                        text: "Your product has been added.",
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
            // this.$router.go(-1);
        }
    }
}
</script>