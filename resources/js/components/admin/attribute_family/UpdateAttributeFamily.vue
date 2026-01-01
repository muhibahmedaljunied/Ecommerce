<template>
    <div class="wrapper">
        <div class="container-fluid">

        </div>
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        {{ $t('messages.edit_attribute_family') }}
                    </div>

                    <div class="card-body">

                        <form class="row g-3">

                            <!-- <div>
                                <h1>Pets I like: {{ arr }}</h1>
                                <div>
                                    <input type="checkbox" :value="arr.includes('cats')" id="cats"
                                        @input="updateArr('cats', $event.target.checked)">
                                    <label for="cats">Cats</label>
                                </div>
                                <div>
                                    <input type="checkbox" :value="arr.includes('dogs')" id="dogs"
                                        @input="updateArr('dogs', $event.target.checked)">
                                    <label for="dogs">Dogs</label>
                                </div>
                            </div> -->






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

                                <div v-for="item in data.attribute_family_mapping" :key="item.attribute.id" class="form-check form-check-inline">

                                    <!-- <label class="form-check-label" for="inlineCheckbox1">الخواص</label> -->

                                    <input @input="update_data(item.attribute.id, $event.target.checked)"
                                        id='checkedItems' class="form-check-input" type="checkbox" :checked=true>
                                    <label class="form-check-label" for="inlineCheckbox1">{{ $t('messages.' + item.attribute.name)
                                        }}</label>
                                </div>
                            </fieldset>











                            <fieldset>

                                <button @click="update(data.id)" type="button" class="btn btn-primary">{{ $t('messages.save') }}</button>

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

            arr: ['cats', 'dogs']

        }
    },
    props: ['data'],

    created() {

        // console.log('almuhiiiiiiiiiiiiiiiiiiiiii', this.data.attribute_option.length);


        this.name = this.data.name;
        this.code = this.data.code;

        //     console.log('almuhiiiiiiiiiiiiiiiiiiiiii', i);

        this.data.attribute_family_mapping.forEach(element => {


            this.checkedItems.push(element.attribute.id);

            // this.checkedItems = element.attribute.id;

        });

        // console.log('almuhiiiiiiiiiiiiiiiiiiiiii', this.checkedItems);



    },
    mounted() {
        // console.log('almuhiiiiiiiiiiiiiiiiiiiiii', window.axios.defaults.baseURL);

        // this.axios.post(`/edit_attribute_family/${id}`).then(response => {
        // 	this.attributes = response.data.attribute_family;
        // })
    },
    methods: {

        updateArr(element, includeElement) {
            if (includeElement && !this.arr.includes(element)) {
                this.arr.push(element);
            } else {
                this.arr = this.arr.filter(el => el !== element);
            }

            console.log('newwwwwwww', this.arr, this.arr.includes(element), includeElement);
        },
        update_data(element, includeElement) {
       

            if (includeElement == true) {

                this.checkedItems.push(element);

            } else {

                this.checkedItems = this.checkedItems.filter(el => el !== element);

            }

        },


        update(id) {

            this.axios.post(`/update_attribute_family_mapping/${id}`, {
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