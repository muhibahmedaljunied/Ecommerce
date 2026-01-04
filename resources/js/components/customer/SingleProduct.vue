<template>
  <div>
    <!--================Single Product Area =================-->
    <div class="product_image_area">
      <div class="container">
        <div class="row s_product_inner" v-for="single in singleProduct">

          <div class="col-lg-6">
            <div class="s_product_img">
              <div class="product-card">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">
                    <img :src="`/Ecommerce/assets/upload/${single.image}`" alt="product image" class="w-100" />
                  </li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1">
                    <img :src="`/Ecommerce/assets/upload/${single.image}`" alt="product image" class="w-100" />
                  </li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2">
                    <img :src="`/Ecommerce/assets/upload/${single.image}`" alt="product image" class="w-100" />
                  </li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img class="d-block w-100" :src="`/Ecommerce/assets/upload/${single.image}`" alt="First slide" />
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" :src="`/Ecommerce/assets/upload/${single.image}`" alt="Second slide" />
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" v-bind:src="`/Ecommerce/assets/upload/${single.image}`" alt="Third slide" />
                  </div>
                </div>
              </div>

              </div>

            </div>
          </div>
          <div class="col-lg-5 offset-lg-1">
            <div class="s_product_text">
              <h3>{{ single.name }} </h3>
              <span>
                <h2>${{ single.price - single.discount }} </h2>
                <del style="color:red;" v-if="single.discount">${{ single.price }}</del>
              </span>
              <span>
                <h2></h2>

              </span>
              <ul class="list">


                <li>

                      <span>{{ $t('messages.Product') }}</span> : {{ single.product.text }}

                </li>

                    <li v-for="single2 in single.family_attribute_option" >


                          <span>{{single2.attribute_option.attribute.name}}</span> : {{single2.attribute_option.value}}

                </li>





                <li>
                  <span>{{ $t('messages.available') }}</span> {{ $t('messages.in_stock') }} :{{ singleProduct.qty }}
                </li>
                <li>
                  <span>{{ $t('messages.sales') }}</span> :{{ singleProduct.qty }}
                </li>
              </ul>
              <p>
              </p>
              <form method="post" @submit.prevent="addToCart(single.id)">
                <div class="product_count">

                  <input type="number" name="qty" v-model="cartQty" value="1" title="Quantity" class="input-text qty" />
                  <label for="qty">:{{ $t('messages.quantity') }}</label>
                </div>
                <div class="card_area">
                  <input type="submit" class="main_btn" :value="$t('messages.add_to_cart')">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--================End Single Product Area =================-->
    <!--================Product Description Area =================-->
    <section class="product_description_area">
      <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" ria-controls="home"
              aria-selected="true">{{ $t('messages.description') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
              aria-selected="false">{{ $t('messages.specification') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="detail-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="detail"
              aria-selected="false">{{ $t('messages.comments') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review"
              aria-selected="false">{{ $t('messages.reviews') }}</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <!-- <p>
            {{singleProduct.long_desc}}
          </p> -->
          </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="table-responsive">

            </div>
          </div>

          <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
            <div class="row">
              <div class="col-lg-6">
                <div class="row total_rate">
                  <div class="col-6">
                    <div class="box_total">
                      <h5>{{ $t('messages.overall') }}</h5>
                      <h4>4.0</h4>
                      <h6>(03 {{ $t('messages.reviews') }})</h6>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="rating_list">
                      <h3>{{ $t('messages.based_on') }} 3 {{ $t('messages.reviews') }}</h3>
                      <ul class="list">
                        <li>
                          <a href="#">5 Star
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> 01</a>
                        </li>
                        <li>
                          <a href="#">4 Star
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> 01</a>
                        </li>
                        <li>
                          <a href="#">3 Star
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> 01</a>
                        </li>
                        <li>
                          <a href="#">2 Star
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> 01</a>
                        </li>
                        <li>
                          <a href="#">1 Star
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> 01</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="review_list">
                  <div class="review_item">
                    <div class="media">
                      <div class="d-flex">
                        <img src="" alt="" />
                      </div>
                      <div class="media-body">
                        <h4>Blake Ruiz</h4>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                    </div>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore magna
                      aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                      ullamco laboris nisi ut aliquip ex ea commodo
                    </p>
                  </div>
                  <div class="review_item">
                    <div class="media">
                      <div class="d-flex">
                        <img src="" alt="" />
                      </div>
                      <div class="media-body">
                        <h4>Blake Ruiz</h4>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                    </div>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore magna
                      aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                      ullamco laboris nisi ut aliquip ex ea commodo
                    </p>
                  </div>
                  <div class="review_item">
                    <div class="media">
                      <div class="d-flex">
                        <img src="" alt="" />
                      </div>
                      <div class="media-body">
                        <h4>Blake Ruiz</h4>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                    </div>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore magna
                      aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                      ullamco laboris nisi ut aliquip ex ea commodo
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="review_box">
                  <h4>{{ $t('messages.add_review') }}</h4>
                  <p>{{ $t('messages.your_rating') }}:</p>
                  <ul class="list">
                    <li>
                      <a href="#">
                        <i class="fa fa-star"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="fa fa-star"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="fa fa-star"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="fa fa-star"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="fa fa-star"></i>
                      </a>
                    </li>
                  </ul>
                  <p>{{ $t('messages.outstanding') }}</p>
                  <form class="row contact_form" action="contact_process.php" method="post" id="contactForm"
                    novalidate="novalidate">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" :placeholder="$t('messages.full_name')" />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="email" class="form-control" id="email" name="email" :placeholder="$t('messages.email_address')" />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="text" class="form-control" id="number" name="number" :placeholder="$t('messages.phone')" />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <textarea class="form-control" name="message" id="message" rows="1"
                          :placeholder="$t('messages.reviews')"></textarea>
                      </div>
                    </div>
                    <div class="col-md-12 text-right">
                      <button type="submit" value="submit" class="btn submit_btn">
                        {{ $t('messages.submit_now') }}
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
    <!--================End Product Description Area =================-->
  </div>
</template>
<script>
export default {
  // name: "singleProduct",
  data() {
    return {
      cartQty: '1',
      id: '',
      commentText: ''
    }
  },
  mounted() {
    this.fetchProduct();
  },
  watch: {
    currentLocale() {
      this.fetchProduct();
    }
  },
  computed: {
    singleProduct() {
      this.commentText = this.$store.getters.getSingleProduct
      return this.$store.getters.getSingleProduct
    },
    //   showSession(){
    //     return this.$store.getters.getSessionData
    //   }
  },
  methods: {
    fetchProduct() {
      this.$Progress.start();
      this.$store.dispatch("getProducstbyId", this.$route.params.id);
      this.$Progress.finish();
    },
    addToCart(id) {
      this.$Progress.start();
      this.id = id
      axios.get(`/add-cart/${this.id}/${this.cartQty}`)
        .then((response) => {

          console.log(response.data.result);
          this.$store.dispatch("getCartItem");
          this.$store.dispatch("countCart");
          this.$store.dispatch("getAllCarttotal");
          this.$Progress.finish()
        })
    }
  }
}
</script>
