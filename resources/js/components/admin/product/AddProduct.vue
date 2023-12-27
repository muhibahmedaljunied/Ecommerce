<template>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">

                <div class="card text-right">
                    <div class="card-header">


                        <h2 class="card-title mg-b-0">المنتجات</h2>
                    </div>

                    <div class="card-body">

                        <form method="post">

                            <div class="row">


                                <div class="col-md-6">


                                    <div class="row">



                                        <div class="col-md-12">
                                            <label for="pagoPrevio">المنتج</label>
                                            <input v-model="product" type="text" name="Product" id="Product"
                                                class="form-control">


                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="filePhoto">صوره المنتج</label>
                                                <input v-on:change="onFileChange" type="file" name="image"
                                                    class="form-control-file" id="filePhoto">
                                                <img src="" id="previewHolder" width="150px">
                                            </div>


                                        </div>




                                    </div>
                                </div>


                                <div class="col-md-6">

                                    <div class="row">

                                        <div class="col-md-6">
                                            <label for="Category"> الصنف</label>
                                            <div class="card">


                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                                    data-parent="#accordion">

                                                    <!-- ////////////////////////////////////////////////////////////// -->
                                                    <div class="card-body">

                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <div class="input-group">

                                                                        <input type="text" id="ricerca-enti"
                                                                            class="form-control" placeholder="بحث..."
                                                                            aria-describedby="search-addon">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xs-12" id="treeview_json_product">
                                                                    <div id="test">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- ------------------------ -->
                                                    </div>

                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                     <label for="Category">المنتج الرئيسي</label>
                                    <select v-model="parentselected" name="Category" id="Category" class="form-control">
                                        <option value="">select</option>
                                        <option v-for="parents in parent" v-bind:value='parents.id'>{{ parents.text
                                        }}
                                        </option>
                                    </select> 
                                  
                                </div>-->







                            </div>


                            <div class="row">


                                <div class="col-md-12">

                                    <fieldset class="border rounded-3 p-3">
                                        <legend class="float-none w-auto px-3">الخواص</legend>
                                        <div class="col-md-12">
                                            <label for="pagoPrevio">مجموعه الخواص</label>

                                            <select @change="get_attribute()" v-model="family_attribute" name="Category"
                                                id="Category" class="form-control">
                                                <option v-for="families in attribute_families" v-bind:value="families.id">{{
                                                    families.name }}</option>



                                            </select>

                                        </div>
                                        <div class="col-md-12">
                                            <label for="pagoPrevio">جديد</label>

                                            <select v-model="New" name="Category" id="Category" class="form-control">
                                                <option value="">select</option>
                                                <option value="">yes</option>
                                                <option value="">no</option>

                                            </select>

                                        </div>
                                        <div class="col-md-12">
                                            <label for="pagoPrevio">مميز</label>


                                            <select v-model="featured" name="Category" id="Category" class="form-control">
                                                <option value="">select</option>
                                                <option value="">yes</option>

                                                <option value="">no</option>


                                            </select>

                                        </div>
                                        <div v-for="attr in attributes">

                                            <div v-for=" (att, index) in attr.attribute_family_mapping" class="col-md-6">
                                                <label for="Category">{{ att.attribute.name }}</label>
                                                <select v-model="attr_array[index]" class="form-control">
                                                    <option value="">select</option>
                                                    <option v-for="att2 in att.attribute.attribute_option"
                                                        :value="[att.attribute.name, att2.id]">
                                                        {{ att2.name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                    </fieldset>
                                </div>
                                <div class="col-md-12">

                                    <fieldset class="border rounded-3 p-3">
                                        <legend class="float-none w-auto px-3"></legend>
                                        <div class="row">

                                            <div class="form-group">
                                                <label for="Product">الكميه</label>
                                                <input v-model="qty" type="text" name="Qty" id="Qty" class="form-control">

                                            </div>
                                            <div class="form-group">
                                                <label for="Product">السعر</label>
                                                <input v-model="price" type="text" name="price" id="price"
                                                    class="form-control">

                                            </div>
                                            <div class="form-group">
                                                <label for="Product">الوصف</label>
                                                <input v-model="description" type="text" name="description" id="description"
                                                    class="form-control">

                                            </div>

                                            <div class="form-group">
                                                <label for="Product">الخصم</label>
                                                <input v-model="discount" type="text" name="discount" id="discount"
                                                    class="form-control">

                                            </div>

                                        </div>


                                    </fieldset>
                                </div>








                            </div>


                            <br />
                            <hr>



                            <button @click="submitForm()" type="button"
                                class="btn btn-primary btn-lg btn-block">حفظ</button>
                        </form>

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

            category: '',
            country: '',
            size: '',
            color: '',
            brand: '',
            age: '',
            product: '',
            qty: '',
            price: '',
            discount: '',
            description: '',
            New: '',
            featured: '',
            status: '',
            image: '',
            categoryselected: '',
            countryselected: '',
            sizeselected: '',
            brandselected: '',
            colorselected: '',
            ageselected: '',
            parentselected: 0,
            jsonTreeData: '',
            attribute_families: '',
            family_attribute: '',
            attributes: 3,
            attr_array: [],
            product_id: '',
            errors: '',
            success: '',
            filename: '',

        }
    },
    created() {
        this.axios.post('/create_product').then((response) => {
            console.log(response.data);
            this.category = response.data.category;
            this.country = response.data.country;
            this.size = response.data.size;
            this.brand = response.data.brand;
            this.color = response.data.color;
            this.age = response.data.age;
            this.parent = response.data.product;



        });
    },
    mounted() {

        this.showtree();
    },




    methods: {

        get_attribute() {


            var gf = this;
            this.axios.post('/get_attributes',
                {
                    id: this.family_attribute
                }).then(function (response) {

                    // $('#klm').val(2);
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
                    $('#treeview_json_product').jstree(true).search(v);
                }, 250);
            });

            // -------------------------------------------------

            this.axios.post(uri).then((response) => {
                //   this.trees = response.data.trees;

                this.jsonTreeData = response.data.trees;
                this.attribute_families = response.data.attribute_families;

                $(`#treeview_json_product`).jstree({
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

                    gf.product_id = data.node.id;
                    // axios.post(`/category_filter/${data.node.id}`).then((response) => {

                    //     gf.showCatProduct = response.data;
                    //     gf.array_id.product_id = data.node.id;

                    // });

                });

            });

            // $('#treeview_json_product').jstree(true).destroy();

        },
        onFileChange(e) {

            this.file = e.target.files[0];
        },
        submitForm() {
            let currentObj = this;
           
            
            this.axios.post('/store_product', {

                product:this.product,
                category:this.product_id,
                attribute:this.attr_array,
                qty:this.qty,
                price:this.price,
                discount:this.discount,
                status:this.status,
                parent:this.parentselected,
                image:this.file,

            })
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