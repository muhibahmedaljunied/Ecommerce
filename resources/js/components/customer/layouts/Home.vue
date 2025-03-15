<template>
  <div>
    <!--================Home Banner Area =================-->
    <section class="home_banner_area mb-40">
      <div class="banner_inner d-flex align-items-center">
        <div class="container">
          <div class="banner_content row">
            <div class="col-lg-12">
              <p class="sub text-uppercase">men Collection</p>
              <h3><span>Show</span> Your <br />Personal <span>Taste</span></h3>
              <!-- <h4>Fowl saw dry which a above together place.</h4> -->
              <a class="main_btn mt-40" href="#">View Collection</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!-- Start feature Area -->
    <section class="feature-area section_gap_bottom_custom">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="single-feature">
              <a href="#" class="title">
                <i class="flaticon-money"></i>
                <!-- <h3>Money back gurantee</h3> -->
                <h3>ضمان استعادة الاموال</h3>
              </a>
              <!-- <p>Shall open divide a one</p> -->
              <p>نعيد الأموال في غضون 30 يومًا</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="single-feature">
              <a href="#" class="title">
                <i class="flaticon-truck"></i>
                <!-- <h3>Free Delivery</h3> -->
                <h3>توصيل مجاني </h3>
              </a>
              <!-- <p>Shall open divide a one</p> -->
              <p>توصيل اي طلب مجانا</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="single-feature">
              <a href="#" class="title">
                <i class="flaticon-support"></i>
                <!-- <h3>Alway support</h3> -->
                <h3>دعم مستمر</h3>
              </a>
              <!-- <p>Shall open divide a one</p> -->
              <p>دعم عملاء ودود على مدار الساعة طوال أيام الأسبوع</p>

            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="single-feature">
              <a href="#" class="title">
                <i class="flaticon-blockchain"></i>
                <!-- <h3>Secure payment</h3> -->
                <h3>دفع أمن</h3>
              </a>
              <!-- <p>Shall open divide a one</p> -->
              <p>نحن نمتلك SSL / شهادة آمنة</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End feature Area -->

    <!--================ Feature Product Area =================-->
    <section class="feature_product_area section_gap_bottom_custom">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12">
            <div class="main_title">
              <!-- <h2><span>Featured product</span></h2> -->
              <h2><span>منتجات مميزة</span></h2>
              <!-- <p>Bring called seed first of third give itself now ment</p> -->
            </div>
          </div>
        </div>
        <div class="row">

          <div class="col-lg-4 col-md-6" v-for="f_Product in showFeaturedProduct">

            <div class="product-card">
              <div class="single-product">
                <div class="product-img">
                  <img class="img-fluid w-100" :src="`/Ecommerce//assets/upload/${f_Product.image}`" alt="" />
                  <div class="p_icon">
                    <router-link :to="`/customer/single-product/${f_Product.id}`">
                      <i class="ti-eye"></i>
                    </router-link>
                    <a href="#">
                      <i class="ti-heart"></i>
                    </a>
                    <button @click.prevent="addToCart(f_Product.id)">
                      <i class="ti-shopping-cart"></i>
                    </button>
                  </div>
                </div>
                <div class="product-btm">
                  <router-link :to="`/customer/single-product/${f_Product.id}`" class="d-block">
                    <h4>{{ f_Product.text }}</h4>
                  </router-link>
                  <div class="mt-3" v-if="f_Product.price">
                    <span class="mr-4">$ {{ f_Product.price - f_Product.discount }}</span>
                    <del style="color:red" v-if="f_Product.discount">$ {{ f_Product.price }}</del>
                  </div>
                  <!-- <div class="mt-3" v-else>
                  <span class="mr-4">$ {{ f_Product.price }}</span>
                </div> -->
                </div>
              </div>
            </div>

          </div>

        </div>
        <!-- <div class="row">
          <div class="col-md-12">
            <a style="font-size: x-large;text-align: center;padding-top: 9px;" href="#projects" class="my-work">عرض
              المزيد</a>

          </div>
        </div> -->
      </div>
    </section>
    <!--================ End Feature Product Area =================-->

    <!--================ Offer Area =================-->
    <section class="offer_area">
      <div class="container">
        <div class="row justify-content-center">
          <div class="offset-lg-4 col-lg-6 text-center">
            <div class="offer_content">
              <!-- <h3 class="text-uppercase mb-40">all men’s collection</h3> -->
              <!-- <h3 class="text-uppercase mb-40">جميع تورت حفلات التخرج </h3> -->
              <h3 class="text-uppercase mb-40">جميع  الملابس الرجاليه  </h3>

              <!-- <h2 class="text-uppercase">50% off</h2> -->
              <h2 class="text-uppercase">50% تخفيض</h2>
              <!-- <a href="#" class="main_btn mb-20 mt-5">Discover Now</a> -->
              <a href="#" class="main_btn mb-20 mt-5">تسوق الان</a>
              <!-- <p>Limited Time Offer</p>   -->
              <p>عرض لفترة محدودة </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ End Offer Area =================-->

    <!--================ Inspired Product Area =================-->
    <!-- <section class="new_product_area section_gap_top section_gap_bottom_custom">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="main_title">
            <h2><span>Inspired products</span></h2>
            <p>Bring called seed first of third give itself now ment</p>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <div class="new_product">
            <h5 class="text-uppercase">collection of 2019</h5>
            <h3 class="text-uppercase">Men’s summer t-shirt</h3>
            <div class="product-img">
              <img class="img-fluid" src="" alt="" />
            </div>
            <h4>$120.70</h4>
            <a href="#" class="main_btn">Add to cart</a>
          </div>
        </div>

        <div class="col-lg-6 mt-5 mt-lg-0">
          <div class="row">
            <div class="col-lg-6 col-md-6">
              <div class="single-product">
                <div class="product-img">
                  <img class="img-fluid w-100" src="" alt="" />
                  <div class="p_icon">
                    <a href="#">
                      <i class="ti-eye"></i>
                    </a>
                    <a href="#">
                      <i class="ti-heart"></i>
                    </a>
                    <a href="#">
                      <i class="ti-shopping-cart"></i>
                    </a>
                  </div>
                </div>
                <div class="product-btm">
                  <a href="#" class="d-block">
                    <h4>Nike latest sneaker</h4>
                  </a>
                  <div class="mt-3">
                    <span class="mr-4">$25.00</span>
                    <del>$35.00</del>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6 col-md-6">
              <div class="single-product">
                <div class="product-img">
                  <img class="img-fluid w-100" src="" alt="" />
                  <div class="p_icon">
                    <a href="#">
                      <i class="ti-eye"></i>
                    </a>
                    <a href="#">
                      <i class="ti-heart"></i>
                    </a>
                    <a href="#">
                      <i class="ti-shopping-cart"></i>
                    </a>
                  </div>
                </div>
                <div class="product-btm">
                  <a href="#" class="d-block">
                    <h4>Men’s denim jeans</h4>
                  </a>
                  <div class="mt-3">
                    <span class="mr-4">$25.00</span>
                    <del>$35.00</del>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6 col-md-6">
              <div class="single-product">
                <div class="product-img">
                  <img class="img-fluid w-100" src="" alt="" />
                  <div class="p_icon">
                    <a href="#">
                      <i class="ti-eye"></i>
                    </a>
                    <a href="#">
                      <i class="ti-heart"></i>
                    </a>
                    <a href="#">
                      <i class="ti-shopping-cart"></i>
                    </a>
                  </div>
                </div>
                <div class="product-btm">
                  <a href="#" class="d-block">
                    <h4>quartz hand watch</h4>
                  </a>
                  <div class="mt-3">
                    <span class="mr-4">$25.00</span>
                    <del>$35.00</del>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6 col-md-6">
              <div class="single-product">
                <div class="product-img">
                  <img class="img-fluid w-100" src="" alt="" />
                  <div class="p_icon">
                    <a href="#">
                      <i class="ti-eye"></i>
                    </a>
                    <a href="#">
                      <i class="ti-heart"></i>
                    </a>
                    <a href="#">
                      <i class="ti-shopping-cart"></i>
                    </a>
                  </div>
                </div>
                <div class="product-btm">
                  <a href="#" class="d-block">
                    <h4>adidas sport shoe</h4>
                  </a>
                  <div class="mt-3">
                    <span class="mr-4">$25.00</span>
                    <del>$35.00</del>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->
    <!--================ End Inspired Product Area =================-->

    <!--================ New Product Area =================-->
    <section class="inspired_product_area section_gap_bottom_custom">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12">
            <div class="main_title">
              <!-- <h2><span>New products</span></h2> -->
              <h2><span>احدث المنتجات</span></h2>
              <!-- <p>Bring called seed first of third give itself now ment</p> -->
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6" v-for="newProduct in showNewProduct">

            <div class="product-card">
              <div class="single-product">
                <div class="product-img">
                  <img class="img-fluid w-100" :src="`/Ecommerce/assets/upload/${newProduct.image}`" alt="">
                  <div class="p_icon">
                    <router-link :to="`/customer/single-product/${newProduct.id}`">
                      <i class="ti-eye"></i>
                    </router-link>
                    <a href="#">
                      <i class="ti-heart"></i>
                    </a>
                    <button @click.prevent="addToCart(newProduct.id)">
                      <i class="ti-shopping-cart"></i>
                    </button>
                  </div>
                </div>
                <div class="product-btm">
                  <router-link :to="`/customer/single-product/${newProduct.id}`" class="d-block">
                    <h4>{{ newProduct.text }}</h4>
                  </router-link>
                  <div class="mt-3" v-if="newProduct.price">
                    <span class="mr-4">$ {{ newProduct.price - newProduct.discount }}</span>
                    <del v-if="newProduct.discount" style="color:red">$ {{ newProduct.price }}</del>
                  </div>
                  <!-- <div class="mt-3" v-else>
                  <span class="mr-4">$ {{ newProduct.price }}</span>
                </div> -->
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- <div class="row">
          <div class="col-md-12">
            <a style="font-size: x-large;text-align: center;padding-top: 9px;" href="#projects" class="my-work">عرض
              المزيد </a>

          </div>
        </div> -->
      </div>
    </section>
    <!--================ End Inspired Product Area =================-->
  </div>
</template>

<script>
export default {
  methods: {
    // addToCart(id){
    //     this.$Progress.start();
    //     axios.post('/add-cart',{
    //         id: id
    //     })
    //         .then((response)=>{            
    //             this.$store.dispatch("countCart");
    //             this.$Progress.finish()
    //         })
    // }

    addToCart(id) {
      this.$Progress.start();
      this.id = id
      axios.get(`/add-cart/${id}/1`)
        .then((response) => {

          console.log(response.data.result);
          this.$store.dispatch("getCartItem");
          this.$store.dispatch("countCart");
          this.$store.dispatch("getAllCarttotal");
          this.$Progress.finish()
        })
    }
  },
  mounted() {

    this.$Progress.start();
    this.$store.dispatch("featuredProduct");
    this.$store.dispatch("newProduct");
    this.$Progress.finish();
  },
  computed: {
    showFeaturedProduct() {
      return this.$store.getters.getFeaturedProduct
    },
    showNewProduct() {
      return this.$store.getters.getNewProduct
    }
  }
}
</script>
<style>
img {

  border-radius: 7px;
}

.product-card {
  padding: 241px;
  padding-top: 21px;
  padding-right: 21px;
  padding-bottom: 21px;
  padding-left: 21px;
  border: 1px solid #e1e7ec;
  border-radius: 7px;
  background-color: #fff;
}
</style>
