<template>
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">مجموعه الخواص </h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">

                    <form class="row g-3">


                        <div class="col-md-8">

                            <div class="row">

                                <div class="col-md-4">
                                    <label for="inputZip" class="form-label">الاسم</label>
                                    <input v-model="name" type="text" class="form-control" id="inputZip">
                                </div>
                                <div class="col-md-4">
                                    <label for="inputZip" class="form-label">الرمز</label>
                                    <input v-model="code" type="text" class="form-control" id="inputZip">
                                </div>






                            </div>
                        </div>

                        <br>

                        <div class="col-md-12">



                            <p>الخواص</p>




                            <div v-for="(item) in attributes" class="form-check form-check-inline">
                                <input v-model="checkedItems" :value="item.id" id="checkedItems" class="form-check-input"
                                    type="checkbox">
                                <label class="form-check-label" for="inlineCheckbox1">{{ item.name }}</label>
                            </div>




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
            code: '',
            message: [],

            attributes: '',
            checkedItems: [],
        }
    },

    mounted() {

        this.axios.post(`/attribute`).then((response) => {

            this.attributes = response.data.attributes;
        })

    },
    methods: {



        add() {

            this.axios.post(`/store_attribute_family_mapping`, {
                name: this.name,
                code: this.code,
                item: this.checkedItems

            }).then((response) => {

            })
            // this.$router.go(-1);

        }
    }
}
</script>