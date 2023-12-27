<template>
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0"> الاصناف</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">

                    <form class="row g-3">


                        <div class="col-md-6">

                            <div class="row">



                                <div class="col-12">
                                    <label for="inputAddress" class="form-label">الاسم</label>
                                    <input v-model="name" type="text" class="form-control" id="inputAddress"
                                        placeholder="insert category">
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="card-body">
                                <!-- <div class="container">
                        <div class="well" id="treeview_json_product"></div>

                      </div> -->

                                <!-- ----------------- -->

                                <div class="container">
                                    <div class="row">
                                        <div class="col-xs-6">

                                            <div class="input-group">

                                                <input type="text" id="ricerca-enti" class="form-control"
                                                    placeholder="بحث..." aria-describedby="search-addon">

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




                        <br>


                        <div class="col-md-12">

                            <p>الخواص</p>

                            <!-- <div v-for="(item, index) in items">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" v-model="checkedItems[index]"
                                        :value="item.id">{{ item.text }}
                                </label>
                            </div> -->

                            <div v-for="(item) in attributes" class="form-check form-check-inline">
                                <input v-model="checkedItems" :value="item.id" id="checkedItems" class="form-check-input"
                                    type="checkbox">
                                <label class="form-check-label" for="inlineCheckbox1">{{ item.name }}</label>
                            </div>

                            <!--     <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                <label class="form-check-label" for="inlineCheckbox1">اللون</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                <label class="form-check-label" for="inlineCheckbox1">العلامه التجاريه</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                <label class="form-check-label" for="inlineCheckbox1">العرض</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                <label class="form-check-label" for="inlineCheckbox1">الطول</label>
                            </div> -->



                        </div>


                        <div class="col-md-12">


                            <button @click="add()" type="button" class="btn btn-primary">حفظ</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
export default {
    data() {
        return {

            name: '',
            attributes: '',
            file: '',
            errors: '',
            filename: '',
            success: '',
            jsonTreeData: '',
            parent: 0,
            checkedItems: [],

        }
    },
    mounted() {

        this.showtree();
    },
    methods: {

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
                this.attributes = response.data.attributes;
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

                    gf.parent = data.node.id;


                    // axios.post(`/category_filter/${data.node.id}`).then((response) => {

                    //     gf.showCatProduct = response.data;
                    //     gf.array_id.product_id = data.node.id;

                    // });

                });

            });

            // $('#treeview_json_product').jstree(true).destroy();

        },



        add() {

            let currentObj = this;


            this.axios.post('/store_category', {parent:this.parent, product: this.name, items: this.checkedItems })
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