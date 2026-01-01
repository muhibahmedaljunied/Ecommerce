<template>
    <div class="wrapper">
        <div class="container-fluid">

        </div>
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                   
                    <div class="card-body">

                        <form class="row g-3">








                            <fieldset>

                                <legend>{{ $t('messages.name') }}</legend>

                                <input v-model="name" type="text" class="form-control" id="inputZip">

                            </fieldset>




                            <fieldset>
                                <legend>{{ $t('messages.code') }}</legend>

                                <input v-model="code" type="text" class="form-control" id="inputZip">
                            </fieldset>


                            <fieldset>
                                <legend>{{ $t('messages.attributes') }}</legend>

                                <div v-for="item in attributes" :key="item.id" class="form-check form-check-inline">
                                    <!-- <label class="form-check-label" for="inlineCheckbox1">الخواص</label> -->
                                    <input v-model="checkedItems" :value="item.id" id="checkedItems"
                                        class="form-check-input" type="checkbox">
                                    <label class="form-check-label" for="inlineCheckbox1">{{ $t('messages.' + item.name)
                                        }}</label>
                                </div>
                            </fieldset>











                            <fieldset>

                                <button @click="add()" type="button" class="btn btn-primary">{{ $t('messages.save') }}</button>

                            </fieldset>














                        </form>
                    </div>

                    <div class="card-footer">


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
            message: [],

            attributes: '',
            checkedItems: [],
        }
    },

    mounted() {
        this.fetchAttributes();
    },
    watch: {
        currentLocale() {
            this.fetchAttributes();
        }
    },
    methods: {
        fetchAttributes() {
            this.axios.post(`/attribute_family/get_attributes`).then((response) => {
                this.attributes = response.data.attributes;
            })
        },


        add() {

            this.axios.post(`/store_attribute_family_mapping`, {
                name: this.name,
                code: this.code,
                item: this.checkedItems

            }).then((response) => {

            })
            // this.$router.go(-1);

        },
    }
}
</script>