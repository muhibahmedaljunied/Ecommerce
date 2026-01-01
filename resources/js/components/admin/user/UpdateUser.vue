<template>
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                            {{ $t('messages.edit_user') }}
                        </div>
                <div class="card-body">
                    <div class="form">
                        <form method="post" @submit.prevent="adduser">

                            <div class="form-group">
                                <label for="name">{{ $t('messages.name') }}</label>
                                <input v-model="data.name" type="text" name="name" id="name">

                            </div>

                            <div class="form-group">
                                <label for="name">{{ $t('messages.phone') }}</label>
                                <input v-model="data.phone" type="text" name="name" id="name">

                            </div>

                            <div class="form-group">
                                <label for="name">{{ $t('messages.email') }}</label>
                                <input v-model="data.email" type="text" name="name" id="name">

                            </div>

                            
                            <div class="form-group">
                                <label for="name">{{ $t('messages.address') }}</label>
                                <input v-model="data.address" type="text" name="name" id="name">

                            </div>

                            <div class="form-group">
                                <label for="status">{{ $t('messages.status') }}</label>
                                <input v-model='data.status' type="text" name="status" id="status">

                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">{{ $t('messages.save') }}</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- /row -->

</template>
<script>
export default {
    data() {
        return {

        }
    },
    props: ['data'],
    methods: {

        adduser(event) {

            this.axios.post(`/store_user`).then((response) => {
                event.preventDefault();
                this.$router.push('user')
            })

        }
    }
}
</script>