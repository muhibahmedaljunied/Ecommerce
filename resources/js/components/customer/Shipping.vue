<template>
    <div class="container">
        <div class="row">
            <div class="offset-3 col-md-6">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h3>
                            <span v-if="showSession">{{ showSession.first_name }}</span>
                            , {{ $t('messages.give_shipping_info') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <button v-if="showSession" type="button" @click.prevent="getDefault" class="btn btn-primary">{{ $t('messages.your_address') }}</button>
                        <button type="button" @click.prevent="clearDefault" class="btn btn-primary">{{ $t('messages.clear_form') }}</button>
                        <form method="post">

                            <div class="form-group">
                                <label>{{ $t('messages.full_name') }}</label>
                                <input type="text" v-model="full_name" class="form-control" name="full_name" required>
                            </div>
                            <div class="form-group">
                                <label>{{ $t('messages.email_address') }}</label>
                                <input type="email" v-model="email" class="form-control" name="email_address" required>
                            </div>
                            <div class="form-group">
                                <label>{{ $t('messages.phone') }}</label>
                                <input type="text" v-model="number" class="form-control" name="phone_no" required>
                            </div>
                            <div class="form-group">
                                <label>{{ $t('messages.address') }}</label>
                                <input type="text" v-model="address" class="form-control" name="address" required>
                            </div>
                            <!-- <div class="m-t-20 col-md-4"> -->
                          


                            <button type="button" class="btn btn-primary" @click='shippingInfo'>{{ $t('messages.confirm_shipping_info') }}</button>

                        </form>
                    </div>
                </div>

            </div>

        </div>
        <div class="modal fade" id="exampleModalProduct" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <form method="post">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>


                        <div class="modal-body">
                            <div id="map"></div>

                        </div>

                        <div class="modal-footer">


                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>



<script>
import gmapsInit from './utils/gmaps';

</script>
<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgDyMQ54mW-EHsTaFTnWd0XorOOvdDR34&callback=initMap">
</script>
<script>
export default {
    data() {
        return {
            full_name: 'muhib ahmed aljunied',
            email: 'muhibalmuhib10@gmail.com',
            number: '776165784',
            address: 'sana`a'
        }
    },
    mounted() {
        console.log('Component mounted.')
        initMap();
    },
    computed: {
        showSession() {
            return this.$store.getters.getSessionData
        }
    },
    methods: {
                initMap() {
                    let map;
        const { Map } =  google.maps.importLibrary("maps");

        map = new Map(document.getElementById("map"), {
            center: { lat: -34.397, lng: 150.644 },
            zoom: 8,
        });
        },


        getDefault() {
            console.log(this.showSession);
            this.full_name = this.showSession.name
            this.email = this.showSession.email
            this.number = this.showSession.phone
            // this.address = this.showSession.address
        },
        clearDefault() {
            this.full_name = '',
                this.email = '',
                this.number = '',
                this.address = ''
        },
        shippingInfo() {
            // this.$router.push('/customer/payment')
            axios.post('/customer/shipping-info', {
                // id: this.showSession.id,
                full_name: this.full_name,
                email: this.email,
                number: this.number,
                address: this.address
            })
                .then((response) => {
                    // console.log(response);
                    this.$router.push('/customer/payment')
                })
        }
    }
}
</script>
<!-- 
<style scoped>
.custom-search {
    position: relative;
    width: 300px;
}

.custom-search-input {
    width: 100%;
    border: 1px solid #ccc;
    border-radius: 100px;
    padding: 10px 100px 10px 20px;
    line-height: 1;
    box-sizing: border-box;
    outline: none;
}

.custom-search-botton {
    position: absolute;
    right: 3px;
    top: 3px;
    bottom: 3px;
    border: 0;
    background: #d1095e;
    color: #fff;
    outline: none;
    margin: 0;
    padding: 0 10px;
    border-radius: 100px;
    z-index: 2;
}
</style> -->