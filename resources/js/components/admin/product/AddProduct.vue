<template>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row row-sm">

                <div class="col-md-12">
                    <div class="card">



                        <div class="card-body">


                            <fieldset class="border rounded-3 p-3">
                                <legend class="float-none w-auto px-3">شحره الاصناف </legend>








                                <div class="input-group">


                                    <input type="text" id="ricerca-enti" class="form-control" placeholder="بحث..."
                                        aria-describedby="search-addon">


                                </div>

                                <div id="treeview_json_product_add">
                                    <div id="test">

                                    </div>
                                </div>








                            </fieldset>
                            <fieldset class="border rounded-3 p-3">
                                <legend class="float-none w-auto px-3">بياتات المنتج</legend>
                                <form @submit.prevent="formSubmit" enctype="multipart/form-data">
                                    <div class="row">

                                        <div v-if="status_product == 'true'" class="col-md-6">
                                            <label for="pagoPrevio">المنتج</label>
                                            <input v-model="product" type="text" name="Product" id="Product"
                                                class="form-control">


                                        </div>
                                        <!-- <div class="col-md-6">
                                            <label for="pagoPrevio">الباركود</label>
                                            <input v-model="barcode" type="number" name="barcode" id="barcode"
                                                class="form-control">


                                        </div> -->

                                        <!-- <div class="col-md-6">
                                            <label for="pagoPrevio">نوع المنتج</label>

                                            <select v-model="product_type" name="product_type" id="Category"
                                                class="form-control">
                                                <option v-bind:value="1">
                                                    فردي
                                                </option>
                                                <option v-bind:value="2">
                                                    تجميعي
                                                </option>
                                                <option v-bind:value="3">
                                                    متباين
                                                </option>



                                            </select>


                                        </div> -->

                                        <div class="col-md-6">
                                            <label for="pagoPrevio">مجموعه الخواص</label>

                                            <select @change="get_attribute()" v-model="family_attribute" name="Category"
                                                id="Category" class="form-control">
                                                <option v-for="families in attribute_families"
                                                    v-bind:value="families.id">
                                                    {{ families.name }}
                                                </option>



                                            </select>

                                        </div>
                                        <div class="col-md-12">
                                            <label for="pagoPrevio">جديد</label>

                                            <select v-model="New" name="Category" id="Category" class="form-control">
                                                <option value="">select</option>
                                                <option value="yes">yes</option>
                                                <option value="no">no</option>

                                            </select>

                                        </div>
                                        <div class="col-md-12">
                                            <label for="pagoPrevio">مميز</label>


                                            <select v-model="featured" name="Category" id="Category"
                                                class="form-control">
                                                <option value="">select</option>
                                                <option value="yes">yes</option>
                                                <option value="no">no</option>


                                            </select>

                                        </div>


                                    </div>
                                </form>
                            </fieldset>



<!-- 
                            <div v-if="attributes[0]">

                                {{ attributes[0].attribute_family_mapping[0].attribute.name }}

                            </div> -->

                            <fieldset class="border rounded-3 p-3">
                                <legend class="float-none w-auto px-3">تباينات المنتج</legend>
                                <div class="col-md-12">


                                    <form @submit.prevent="formSubmit" enctype="multipart/form-data">

                                        <!-- <form action="post" @submit.prevent="submitForm" enctype="multipart/form-data"> -->

                                        <div class="table-responsive">
                                            <table class="table table-bordered text-right m-t-30"
                                                style="width: 100%; font-size: x-small">
                                                <thead>
                                                    <tr>
                                                        <th>السعر</th>
                                                        <th>الخصم</th>
                                                        <th>الكميه</th>
                                                        <th>الخواص</th>
                                                        <th>صوره المنتج</th>
                                                        <th>الوصف</th>
                                                        <th>اضافه</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="index in count" :key="index">

                                                        
                                                        <td>
                                                            <input v-model="price[index - 1]" type="text"
                                                                class="form-control" name="name" id="name" required />
                                                        </td>
                                                        <td>
                                                            <input v-model="discount[index - 1]" type="text"
                                                                class="form-control" name="name" id="name" required />
                                                        </td>
                                                        <td>
                                                            <input v-model="qty[index - 1]" type="text"
                                                                class="form-control" name="name" id="name" />
                                                        </td>
                                                        <td>

                                                            <div v-for="(atta, index1) in attributes">


                                                                <div v-for="(atta2, index2) in atta.attribute_family_mapping"
                                                                    class="col-md-12">
                                                                    <label for="pagoPrevio"> {{
                                                                        atta2.attribute.name
                                                                    }}</label>

                                                                    <select
                                                                        @change="addFind(index, index2, $event, atta2.id)"
                                                                        class="form-control">
                                                                        <option
                                                                            v-for="(atta3, index3) in atta2.attribute.attribute_option"
                                                                            :value="atta3.id">
                                                                            {{
                                                                                atta3.value
                                                                            }}
                                                                        </option>



                                                                    </select>
                                                                </div>



                                                            </div>




                                                        </td>

                                                        <td>
                                                            <input type="file" class="form-control"
                                                                v-on:change="onFileChange($event, index)">


                                                            <!-- <input v-on:change="onFileChange(index)"
            type="file" name="image"
            class="form-control-file" id="filePhoto">
        <img src="" id="previewHolder" width="150px"> -->
                                                        </td>


                                                        <td>
                                                            <input v-model='description[index - 1]' type="text"
                                                                class="form-control">


                                                        </td>


                                                        <td v-if="index == 1">
                                                            <a class="tn btn-info btn-sm waves-effect btn-agregar"
                                                                @click="addComponent(count)">
                                                                <i class="fa fa-plus-circle"></i></a>

                                                            <a class="tn btn-info btn-sm waves-effect btn-agregar"
                                                                @click="disComponent(count)">
                                                                <i class="fa fa-minus-circle"></i></a>
                                                        </td>



                                                    </tr>
                                                    <tr>

                                                        <td colspan="6"></td>
                                                        <td>
                                                            <button
                                                                class="btn btn-primary btn-lg btn-block">حفظ</button>
                                                        </td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- </form> -->



                                    </form>




                                </div>


                            </fieldset>












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

            product: '',
            qty: [],
            price: [],
            description: [],
            discount: [],

            New: '',
            featured: '',
            status: '',
            status_product: 'true',

            image: '',
            categoryselected: '',
            parentselected: 0,
            jsonTreeData: '',
            attribute_families: '',
            family_attribute: '',
            attributes: '',
            attr_array: [],
            att_family: '',
            barcode: '',
            // att_all_family: [],
            product_id: '',
            errors: '',
            success: '',
            // filename: '',
            counts: [],
            count: 1,
            count_attributes: 1,
            file: [],

        }
    },
    // created() {
    //     this.axios.post('/create_product').then((response) => {
    //         console.log(response.data);
    //         this.parent = response.data.product;



    //     });
    // },
    mounted() {
        this.counts[0] = 1;
        this.showtree();
        this.att_family = Array.from(Array(this.count), () => new Array(this.count_attributes))
    },




    methods: {

        addComponent(index) {
            // alert(index);
            this.count += 1;
            // this.counts[index] = this.count;
            if (index == 0) {

                this.counts[index] = 0;
            } else {
                this.counts[index] = this.count;

            }

            this.att_family = Array.from(Array(this.count), () => new Array(2))
        },
        disComponent(index) {
            if (this.count > 1) {

                this.count -= 1;
                $this.counts.pop();
            }

            // this.$delete(this.counts, index);
        },
        addFind(index, index2, event, att) {


            index = index - 1;
            console.log(index, index2);
            this.att_family[index][index2] = [att, event.target.value];

        },

        get_attribute() {


            var gf = this;
            this.axios.post('/product/get_attributes',
                {
                    id: this.family_attribute
                }).then(function (response) {


                    console.log(response.data.attributes);
                    gf.count_attributes = response.data.count_attributes
                    gf.attributes = response.data.attributes;

                })
                .catch(function (error) {
                    // currentObj.output = error;
                });

            return

        },
        showtree() {

            // console.log('in show tree', this.$route.params.id);
            var uri = `/tree_product`;
            var gf = this;
            // ------------هذا لاجل البحث في الشجره-----------------------------
            var to = false;
            $('#ricerca-enti').keyup(function () {
                if (to) {
                    clearTimeout(to);
                }
                to = setTimeout(function () {
                    var v = $('#ricerca-enti').val();
                    $('#treeview_json_product_add').jstree(true).search(v);
                }, 250);
            });

            // -------------------------------------------------

            this.axios.post(uri).then((response) => {
                //   this.trees = response.data.trees;

                this.jsonTreeData = response.data.trees;
                this.attribute_families = response.data.attribute_families;

                $(`#treeview_json_product_add`).jstree({
                    core: {
                        themes: {
                            responsive: false,
                        },
                        // so that create works
                        check_callback: true,
                        data: this.jsonTreeData,
                    },
                    // types: {
                    // default: {
                    //   icon: "fa fa-plus text-primary",
                    // },
                    // file: {
                    //   icon: "fa fa-file  text-primary",
                    // },
                    // },
                    // checkbox: {
                    //   three_state: false,

                    // },
                    state: {
                        key: "demo2"
                    },
                    search: {
                        case_insensitive: true,
                        show_only_matches: true
                    },
                    plugins: [
                        // "checkbox",
                        "contextmenu",
                        "dnd",
                        "massload",
                        "search",
                        // "sort",
                        "state",
                        // "types",
                        "unique",
                        "wholerow",
                        "changed",
                        "conditionalselect"],
                    contextmenu: {
                        items: {

                            renameItem: {
                                // The "rename" menu item
                                label: "تحرير",
                                action: function (data) {

                                    console.log('تحرير');
                                },
                            },
                            deleteItem: {
                                // The "delete" menu item
                                label: "حذف",
                                action: function (data) {

                                    console.log('حذف');

                                },
                            },
                            addItem: {
                                // The "delete" menu item
                                label: "اضافه",
                                action: function (data) {


                                    console.log('اضافه');


                                },
                            },

                        }
                    },

                }).on('rename_node.jstree', function (e, data) {

                }).on("changed.jstree", function (e, data) {



                    axios.post(`/get_product_status/${data.node.id}`).then((response) => {

                        console.log('muhibbbbbbbbb', response.data.product);

                        gf.status_product = response.data.product.status;
                        // gf.array_id.product_id = data.node.id;

                    });

                });

            });

            // $('#treeview_json_product_add').jstree(true).destroy();

        },
        onFileChange(e, index) {


            this.file[index] = e.target.files[0];
            console.log(this.file);
        },
        formSubmit() {


            // alert(this.counts);

            let currentObj = this;
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                },
            };
            // form data

            let formData = new FormData();
            formData.append("count", JSON.stringify(this.counts));
            formData.append("product", this.product);
            formData.append("parent", this.product_id);
            formData.append("attribute", this.attr_array);
            formData.append("family_id", this.family_attribute);
            formData.append("product_attr", JSON.stringify(this.att_family));
            formData.append("status", 'false');
            formData.append("status_product", this.status_product);
            formData.append("qty", JSON.stringify(this.qty));
            formData.append("price", JSON.stringify(this.price));
            formData.append("description", JSON.stringify(this.description));
            formData.append("discount", JSON.stringify(this.discount));
            formData.append("featured", this.featured);
            formData.append("new", this.New);

            for (let i = 0; i < this.file.length; i++) {

                // payload.append('image[]', this.image[i])
                formData.append("image[]", this.file[i]);

            }

            // formData.append("image", this.file);


            this.axios.post('/store_product',
                formData,
                config

            )
                .then(function (response) {


                })
                .catch(function (error) {
                    currentObj.output = error;
                });
            // this.$router.go(-1);
        }
    }
}
</script>