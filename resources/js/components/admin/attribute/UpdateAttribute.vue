<template>

    <div class="wrapper">
        <div class="container-fluid">

            <div class="row row-sm">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            تعديل الخواص
                        </div>
                        <div class="card-body">


                            <form class="row g-3">


                                <div class="col-md-12">



                                    <fieldset class="border rounded-3 p-3">
                                        <legend class="float-none w-auto px-3">الاسم</legend>

                                        <input v-model="data.name" type="text" class="form-control">
                                    </fieldset>

                                    <fieldset class="border rounded-3 p-3">
                                        <legend class="float-none w-auto px-3">الرمز</legend>


                                        <input v-model="data.code" type="text" class="form-control">
                                    </fieldset>



                                    <fieldset class="border rounded-3 p-3">
                                        <legend class="float-none w-auto px-3">قيم الخاصيه</legend>
                                        <form method="post">

                                            <div class="table-responsive">
                                                <table class="table table-bordered text-right m-t-30"
                                                    style="width: 100%; font-size: x-small">
                                                    <thead>
                                                        <tr>
                                                            <th> القيمه</th>
                                                            <th> الرمز</th>

                                                            <th>اضافه</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="index in count" :key="index">


                                                            <td>
                                                                <input v-model="data.attribute_option[index - 1].value"
                                                                    type="text" class="form-control" name="name"
                                                                    id="name" required />
                                                            </td>
                                                            <td>
                                                                <input v-model="data.attribute_option[index - 1].code"
                                                                    type="text" class="form-control" name="name"
                                                                    id="name" />
                                                            </td>


                                                            <td v-if="index == 1">
                                                                <a class="tn btn-info btn-sm waves-effect btn-agregar"
                                                                    v-on:click="addComponent(count)">
                                                                    <i class="fa fa-plus-circle"></i></a>

                                                                <a class="tn btn-info btn-sm waves-effect btn-agregar"
                                                                    v-on:click="disComponent(count)">
                                                                    <i class="fa fa-minus-circle"></i></a>
                                                            </td>



                                                        </tr>
                                                        <tr>
                                                            <td colspan="2"></td>
                                                            <td> <button @click="add()" type="button"
                                                                    class="btn btn-primary">حفظ</button></td>
                                                        </tr>


                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
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
            code: '',
            code_value: [],
            status: '',
            counts: {},
            count: 1,
            value: [],

        }
    },


    props: ['data'],

    mounted() {
        // console.log('almuhiiiiiiiiiiiiiiiiiiiiii', this.$route.params.data.id);
        // console.log('almuhiiiiiiiiiiiiiiiiiiiiii', this.data);
        // this.count = data.attribute_option.length;
        this.counts[0] = 1;
        // this.axios.post(`/edit_attribute/${this.$route.params.data.id}`).then(response => {
        //     this.attributes = response.data.attributes;
        // })
    },


    methods: {

        addComponent(index) {
            // alert(index);
            this.count += 1;
            if (index == 0) {

                this.counts[index] = 0;
            } else {
                this.counts[index] = this.count;

            }
        },
        disComponent(index) {
            if (this.count > 1) {

                this.count -= 1;
                $this.counts.pop();
            }
            // this.$delete(this.counts, index);
        },
        add() {

            let currentObj = this;


            this.axios.post('/store_attribute', {
                count: this.counts,
                code: this.code,
                name: this.name,
                value: this.value,
                code_value: this.code_value,

            })
                .then(function (response) {

                })
                .catch(function (error) {
                    currentObj.output = error;
                });

            // this.$router.go(-1);

        },


    }
}
</script>