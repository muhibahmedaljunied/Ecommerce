<template>
    <header class="header_area">
    <div class="top_menu">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <div class="float-left" v-if="showSession">
              <p>Phone: +967 {{showSession.phone}}</p>
              <p>email:{{showSession.email}} </p>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="float-right">
              <ul class="right_side" v-if="showSession">
                <li>
                  <a href="#">
                    {{showSession.name}}
                  </a>
                </li>
                <li >  

                  <a href="#" @click ="logout">
                    logout
                  </a>
                </li>

         <!-- <li>
                  
                  <button type = 'button' @click ="logout"  class="btn ">Logout</button>

                </li>  -->
              </ul>
              <ul class="right_side" v-else>
                <li>
                  <router-link to="/customer/login">
                    Login
                  </router-link>
                </li>
                <li>  
                  <router-link to="/customer/register">
                    Register
                  </router-link>

            
                </li>
             
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="main_menu">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light w-100">
          <!-- Brand and toggle get grouped for better mobile display -->
          <a class="navbar-brand logo_h" href="#">
            <img src="" alt="" />
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse offset w-100" id="navbarSupportedContent">
            <div class="row w-100 mr-0">
              <div class="col-lg-7 pr-0">
                <ul class="nav navbar-nav center_nav pull-right">
                  <li class="nav-item active">
                    <router-link class="nav-link" to="/customer/home">Home</router-link>
                  </li>
                  <li class="nav-item submenu dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                      aria-expanded="false">Category</a>
                      
                    <ul class="dropdown-menu">
                      <li class="nav-item" v-for="category in categories">
                        <router-link class="nav-link" :to ="`/customer/category/${category.id }`">{{category.name}}</router-link>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/">Dashboard</a>
                  </li>
                </ul>
              </div>

              <div class="col-lg-5 pr-0">
                <ul class="nav navbar-nav navbar-right right_nav pull-right">
                  <!-- <li class="nav-item submenu dropdown">
                    <input type="search" autocomplete='off' v-model="searchKey" name="search" data-toggle="dropdown" role="button" aria-haspopup="true"
                      aria-expanded="false" placeholder="search product">
                      <ul class="dropdown-menu" v-if="searchKey">
                        <li class="nav-item" v-for="search in searchResult">
                          <router-link class="nav-link" :to="`/single-product/${search.id}`">{{search.product_name}}</router-link>
                        </li>
                      </ul>
                    <a href="#" class="icons">
                      <i class="ti-search" aria-hidden="true"></i>
                    </a>
                  </li> -->

                <li class="nav-item">
                    <router-link to="/customer/cart" class="icons">
                      <i class="fa fa-shopping-cart"></i>
                      <span class="badge badge-notify"  >{{showCountCart}}</span>
                    </router-link>
                    
                  </li>
                  <li class="nav-item">
                    <router-link to="/customer/login" class="icons">
                      <i class="ti-user" aria-hidden="true"></i>
                    </router-link>
                  </li>

                  <!-- <li class="nav-item">
                    <a href="#" class="icons">
                      <i class="ti-heart" aria-hidden="true"></i>
                    </a>
                  </li> -->
                </ul>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </header>
</template>

<script>
    export default {
      // name: "header_area",
      data(){
            return{
                categories:[],
            }
        },
        created(){
           this.axios.post('/home')
                .then((response =>{
                  // console.log(response.data);
                    this.categories = response.data
                }))
        },
        mounted(){
          this.$Progress.start();
          this.$store.dispatch("countCart");
          this.$store.dispatch("customerSession");
          this.$Progress.finish();
        },
        computed:{
          showCountCart(){
              return this.$store.getters.getCountCart
          },
          showSession(){
              return this.$store.getters.getSessionData
          }
        },
        methods:{
          logout(){
            axios.post('/customer/customer-logout')
              .then((response)=>{
                // console.log(response.data)
                this.$store.dispatch("customerSession");
              })
          },
          // search(){
          //   axios.post('/search-product',{
          //     searchKey: this.searchKey
          //   })
          //   .then((response)=>{
          //     //console.log(response.data.searchData)
          //     this.searchResult = response.data.searchData
              
          //   })
          // }https://www.youtube.com/watch?v=eSLOOb5Mb5c&list=PLfDx4cQoUNObqJzxBKEst6Sd8uw6C2qSK

        },
    //     watch: {
    //     searchKey(after, before) {
    //         this.search();
    //     }
    // },
    }
</script>
