<template>

    <div class="wrapper">
        <div class="container-fluid">

            <div class="row sow-sm">

                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">

                            <form class="row g-3">


                                <div class="row">


                                    <fieldset class="border rounded-3 p-3">



                                        <legend class="float-none w-auto px-3"> {{ $t('messages.name') }} </legend>









                                        <input v-model="name" type="text" class="form-control" id="inputAddress">



                                    </fieldset>
                                    <fieldset class="border rounded-3 p-3">



                                        <legend class="float-none w-auto px-3">{{ $t('messages.category_tree') }}</legend>



                                        <div class="input-group">

                                            <input type="text" id="ricerca-enti" class="form-control"
                                                :placeholder="$t('messages.search') + '...'" aria-describedby="search-addon">

                                        </div>



                                        <div id="treeview_json_product_add">
                                            <div id="test">

                                            </div>
                                        </div>








                                    </fieldset>

                                    <fieldset class="border rounded-3 p-3">



                                        <legend class="float-none w-auto px-3">{{ $t('messages.attributes') }}</legend>




                                        <div>



                                            <div style="float: right;" v-for="(item) in attributes"
                                                class="form-check form-check-inline">
                                                <input v-model="checkedItems" :value="item.id" id="checkedItems"
                                                    class="form-check-input" type="checkbox">
                                                <label class="form-check-label" for="inlineCheckbox1">{{ item.name
                                                }}</label>
                                            </div>


                                            <button style="float: left;" @click="add()" type="button"
                                                class="btn btn-primary">{{ $t('messages.save') }}</button>


                                        </div>

                                    </fieldset>






                                </div>











                            </form>
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

        this.axios.post('/get_attribute').then(response => {

            this.attributes = response.data.attributes;

        })

        this.showtree();
    },
    watch: {
        currentLocale() {
            this.refreshTree();
        }
    },
    methods: {
        refreshTree() {
            if ($('#treeview_json_product_add').jstree(true)) {
                $('#treeview_json_product_add').jstree(true).destroy();
            }
            this.showtree();
        },
        translateTree(nodes) {
            if (!nodes) return [];
            return nodes.map(node => {
                const newNode = { ...node };
                if (newNode.text) {
                    newNode.text = this.$t('messages.' + newNode.text);
                }
                if (newNode.children && newNode.children.length > 0) {
                    newNode.children = this.translateTree(newNode.children);
                }
                return newNode;
            });
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

                this.jsonTreeData = this.translateTree(response.data.trees);
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
                                label: this.$t('messages.edit'),
                                action: function (data) {

                                    console.log('تحرير');
                                },
                            },
                            deleteItem: {
                                // The "delete" menu item
                                label: this.$t('messages.delete'),
                                action: function (data) {

                                    console.log('حذف');

                                },
                            },
                            addItem: {
                                // The "delete" menu item
                                label: this.$t('messages.add'),
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

            // $('#treeview_json_product_add').jstree(true).destroy();

        },



        add() {

            let currentObj = this;


            this.axios.post('/store_category', { parent: this.parent, product: this.name, items: this.checkedItems })
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
