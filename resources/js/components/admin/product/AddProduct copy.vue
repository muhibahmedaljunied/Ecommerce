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

                                        <!-- <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="filePhoto">صوره المنتج</label>
                                                <input v-on:change="onFileChange" type="file" name="image"
                                                    class="form-control-file" id="filePhoto">
                                                <img src="" id="previewHolder" width="150px">
                                            </div>


                                        </div> -->




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


                                <div class="col-md-4">

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


                                    </fieldset>
                                </div>
                                <div class="col-md-8">

                                    <fieldset class="border rounded-3 p-3">
                                        <legend class="float-none w-auto px-3">الخواص</legend>
                                        <div class="col-md-12">

                                            <div class="card">


                                                <div class="card-body">
                                                    <form method="post" enctype="multipart/form-data" >

                                                        <div class="table-responsive">
                                                            <table class="table table-bordered text-right m-t-30"
                                                                style="width: 100%; font-size: x-small">
                                                                <thead>
                                                                    <tr>



                                                                        <th>السعر</th>
                                                                        <th>الكميه</th>
                                                                        <th>الخواص</th>



                                                                        <th>صوره المنتج</th>
                                                                        <th>اضافه</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="index in count" :key="index">


                                                                        <td>
                                                                            <input v-model="value[index]" type="text"
                                                                                class="form-control" name="name" id="name"
                                                                                required />
                                                                        </td>
                                                                        <td>
                                                                            <input v-model="code_value[index]" type="text"
                                                                                class="form-control" name="name"
                                                                                id="name" />
                                                                        </td>
                                                                        <td>




                                                                            <div v-for="(atta, index1) in attributes">


                                                                                <div v-for="(atta2, index2) in atta.attribute_family_mapping"
                                                                                    class="col-md-12">
                                                                                    <label for="pagoPrevio"> {{
                                                                                        atta2.attribute.name }}</label>

                                                                                    <select
                                                                                        @change="addFind(index,index2, $event,atta2.attribute.id)"
                                                                                        class="form-control">
                                                                                        <option
                                                                                            v-for="(atta3, index3) in atta2.attribute.attribute_option" :value="atta3.id">
                                                                                            {{
                                                                                                atta3.value
                                                                                            }}
                                                                                        </option>



                                                                                    </select>
                                                                                </div>



                                                                            </div>




                                                                            <!-- <a class="tn btn-info btn-sm waves-effect btn-agregar"
                                                                                data-toggle="modal" id="agregar_productos"
                                                                                data-target="#addperiods">
                                                                                <i class="fa fa-plus-circle"></i></a> -->
                                                                            <!-- <a
                                                                                class="tn btn-info btn-sm waves-effect btn-agregar">
                                                                                <i class="fa fa-plus-circle"></i></a> -->
                                                                        </td>
                                                                        <!-- <td>
                                                                            <input v-model="code_value[index]" type="text"
                                                                                class="form-control" name="name"
                                                                                id="name" />
                                                                        </td>
                                                                        <td>
                                                                            <input v-model="code_value[index]" type="text"
                                                                                class="form-control" name="name"
                                                                                id="name" />
                                                                        </td> -->
                                                                        <td>
                                                                            <input v-on:change="onFileChange($event,index)" type="file"
                                                                                name="image" class="form-control-file"
                                                                                id="filePhoto">
                                                                            <img src="" id="previewHolder" width="150px">
                                                                        </td>




                                                                        <td v-if="index == 1">
                                                                            <a  class="tn btn-info btn-sm waves-effect btn-agregar"
                                                                                v-on:click="addComponent(count)">
                                                                                <i class="fa fa-plus-circle"></i></a>

                                                                            <a  class="tn btn-info btn-sm waves-effect btn-agregar"
                                                                                v-on:click="disComponent(count)">
                                                                                <i class="fa fa-minus-circle"></i></a>
                                                                        </td>



                                                                    </tr>


                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </form>


                                                    <!-- 
                                                    <button @click="add()" type="button"
                                                        class="btn btn-primary">حفظ</button> -->

                                                </div>


                                            </div>
                                        </div>


                                    </fieldset>
                                </div>




                            </div>


                            <br />
                            <hr>



                            <button @click="submitForm"  type="button"
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
            value: '',
            code_value: '',
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
            parentselected: 0,
            jsonTreeData: '',
            attribute_families: '',
            family_attribute: '',
            attributes: '',
            attr_array: [],
            att_family: '',
            att_all_family: [],
            product_id: '',
            errors: '',
            success: '',
            filename: '',
            counts: {},
            count: 1,
            file:[],

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
        this.att_family = Array.from(Array(this.count), () => new Array(2))
    },




    methods: {

        addComponent(index) {
            // alert(index);
            this.count += 1;
            this.counts[index] = this.count;
            this.att_family = Array.from(Array(this.count), () => new Array(2))
        },
        disComponent(index) {
            this.count -= 1;
            this.$delete(this.counts, index);
        },
        addFind(index, index2, event,att) {

          
            index = index-1;
            console.log(index,index2);
            this.att_family[index][index2] = [att,event.target.value];

        },

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
        onFileChange(e,index) {

            console.log(e.target.files[0]);
            this.file[index] = e.target.files[0];
        },
        submitForm() {
           
       
            let currentObj = this;
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                },
            };
            // form data

            let formData = new FormData();
            formData.append("product", this.product);
            formData.append("parent", this.product_id);
            formData.append("attribute", this.attr_array);
            formData.append("product_attr", [this.att_family]);
            formData.append("status",'false');
            formData.append("image", this.file);


            this.axios.post('/store_product',
            formData, 
            config
            //  {

            //     product: this.product,
            //     parent: this.product_id,
            //     attribute: this.attr_array,
            //     product_attr:this.att_family,
            //     status: 'false',
            //     image: this.file,

            // }
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