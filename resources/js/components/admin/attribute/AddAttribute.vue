<template>
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0"> الخواص</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">

                    <form class="row g-3">


                        <div class="col-md-8">

                            <div class="row">

                                <div class="col-md-4">
                                    <label for="inputPassword4" class="form-label">الاسم</label>
                                    <input v-model="name" type="text" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label for="inputEmail4" class="form-label">الرمز</label>
                                    <input v-model="code" type="text" class="form-control">
                                </div>
                              
                                <div class="col-md-3">
                                    <label for="Category">النوع</label>
                                    <select name="Category"  class="form-control">
                                        <option value="">select</option>

                                    </select>
                                </div>



                            </div>
                        </div>




                        <br>
                        <hr>
                        <div class="col-md-12">

                            <div class="card">


                                <div class="card-body">
                                    <form method="post"  >

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
                                                            <input v-model="value[index]" type="text" class="form-control"
                                                                name="name" id="name" required />
                                                        </td>
                                                        <td>
                                                            <input v-model="code_value[index]" type="text" class="form-control"
                                                                name="name" id="name" />
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


                                                </tbody>
                                            </table>
                                        </div>
                                    </form>



                                    <button @click="add()" type="button" class="btn btn-primary">حفظ</button>

                                </div>


                            </div>


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
            code_value: [],
            status: '',
            counts: {},
            count: 1,
            value: [],

        }
    },

    mounted() {

        this.counts[0] = 1;

    },
    methods: {

        addComponent(index) {
            // alert(index);
            this.count += 1;
            this.counts[index] = this.count;
        },
        disComponent(index) {
            this.count -= 1;
            this.$delete(this.counts, index);
        },

        add() {

            let currentObj = this;


            this.axios.post('/store_attribute', {
                count: this.counts,
                code: this.code,
                name:this.name,
                value: this.value,
                code_value: this.code_value,
                
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