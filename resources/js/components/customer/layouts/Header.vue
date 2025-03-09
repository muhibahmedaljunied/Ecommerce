<template>
  
  <header class="header_area">
    <div class="top_menu">
      <div class="container">
        <div class="row">
          <div class="col-lg-2">
            <div class="float-left" v-if="showSession">
             <i class="fa fa-phone"></i>: +967 {{ showSession.phone }}

            </div>
          </div>
          <div class="col-lg-2">
            <div class="float-left" v-if="showSession">

             <i class="fa fa-mail-forward"></i>:{{ showSession.email }} 
            </div>
          </div>
          <div class="col-lg-1">
            <div class="float-left" v-if="showSession">
    
              <i class="fa fa-whatsapp"></i> 
            </div>
          </div>
          <div class="col-lg-1">
            <div class="float-left" v-if="showSession">
    
              <i class="fa fa-facebook"></i> 
            </div>
          </div>

          <div class="col-lg-3">
            <div class="float-right">
              <ul class="right_side" v-if="showSession">
                <li>
                  <a href="#">
                    {{ showSession.name }}
                  </a>
                </li>
                <li>

                  <a href="#" @click="logout">
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
      <div class="container-fluid">
        <div class="navbar">
         
              <!-- Navbar logo -->
              <div class="nav-header">
                  <div class="nav-logo">
                      <a href="#">
                          <img src="/assets/img/logo_muhib.jpg" width="100px" alt="logo">
                        </a>
                    </div>
                </div>
         
              <!-- responsive navbar toggle button -->
          <!--     <input type="checkbox" id="nav-check">
              <div class="nav-btn">
                  <label for="nav-check">
                    <span></span>
                      <span></span>
                      <span></span>
                    </label>
                </div> -->
         
              <!-- Navbar items -->
              <div class="nav-links">
            <!--       <a href="#">Home</a> -->
            <router-link to="/customer/home">الرئيسيه</router-link>
              
           

            <!--       <div class="dropdown">
                      <a class="dropBtn" href="#">Category
                        </a>
                      <div class="drop-content">

                <ul>
                  <li v-for="category in categories" class="nav-item">
                    <router-link :to="`/customer/category/${category.id}`">{{ category.name }}</router-link>

                  </li>
                </ul>


                        
              </div>
                    </div> -->
                 <div class="dropdown" v-for="category in categories">
                    
              <!-- <router-link :to="`/customer/category/${category.id}`">{{ category.text }}</router-link> -->
              <router-link :to="{ name: 'CustomerCategory', params: { id: category.id }}" replace: true >{{ category.text }}</router-link>
               
                  
            </div>
               <a href="/Ecommerce/">لوحه التحكم</a>
               
                  <router-link to="/customer/cart"><i class="fa fa-shopping-cart"></i> <span class="badge badge-notify">{{
                    showCountCart }}</span></router-link>
             <router-link to="/customer/login"><i class="ti-user" aria-hidden="true"></i></router-link>
              
          </div>
         
            </div>


        <!-- <nav class="navbar navbar-expand-lg navbar-light w-100">
          <a class="navbar-brand logo_h" href="#">
            <img src="" alt="" />
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
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

           
                </ul>
              </div>
            </div>
          </div>
        </nav> -->
      </div>
    </div>
  </header>
</template>

<script>
export default {
  // name: "header_area",
  data() {
    return {
      categories: [],
    }
  },
  created() {
    this.axios.post('/home')
      .then((response => {
        // console.log(response.data);
        this.categories = response.data
      }))
  },
  mounted() {
    this.$Progress.start();
    this.$store.dispatch("countCart");
    this.$store.dispatch("customerSession");
    this.$Progress.finish();
  },
  computed: {
    showCountCart() {
      return this.$store.getters.getCountCart
    },
    showSession() {
      return this.$store.getters.getSessionData
    }
  },
  methods: {

    push(id) {

      this.$router.push({
        name: 'CustomerCategory',
        params: id
      },
      );

    },
    logout() {
      axios.post('/customer/customer-logout')
        .then((response) => {
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
<style scoped>
/* ------------------- */



* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  /* background-image: url(background-img.jpg); */
  background-size: cover;
  background-attachment: fixed;
}

.navbar {
  height: 70px;
  width: 100%;
  padding: 19px 30px;
  background-color: #244976;
  position: relative;
}

.navbar .nav-header {
  display: inline;
}

.navbar .nav-header .nav-logo {
  display: inline-block;
  margin-top: -7px;
}

.navbar .nav-links {
  display: inline;
  float: right;
  font-size: 18px;
}

.navbar .nav-links .loginBtn {
  display: inline-block;
  padding: 5px 15px;
  margin-left: 20px;
  font-size: 17px;
  color: rgb(9, 14, 90);
}

.navbar .nav-links a {
  padding: 10px 12px;
  text-decoration: none;
  font-weight: 550;
  color: white;
}

/* Hover effects */
.navbar .nav-links a:hover {
  background-color: rgba(0, 0, 0, 0.3);
}

/* responsive navbar toggle button */
.navbar #nav-check,
.navbar .nav-btn {
  display: none;
}

@media (max-width:700px) {
  .navbar .nav-btn {
    display: inline-block;
    position: absolute;
    top: 0px;
    right: 0px;
  }

  .navbar .nav-btn label {
    display: inline-block;
    width: 80px;
    height: 70px;
    padding: 25px;
  }

  .navbar .nav-btn label span {
    display: block;
    height: 10px;
    width: 25px;
    border-top: 3px solid #eee;
  }

  .navbar .nav-btn label:hover,
  .navbar #nav-check:checked~.nav-btn label {
    background-color: rgb(9, 14, 90);
    transition: all 0.5s ease;
  }

  .navbar .nav-links {
    position: absolute;
    display: block;
    text-align: center;
    width: 50%;
    background-color: rgb(9, 14, 90);
    transition: all 0.3s ease-in;
    overflow-y: hidden;
    top: 70px;
    right: 0px;
  }

  .navbar .nav-links a {
    display: block;
  }

  /* when nav toggle button not checked */
  .navbar #nav-check:not(:checked)~.nav-links {
    height: 0px;
  }

  /* when nav toggle button is checked */
  .navbar #nav-check:checked~.nav-links {
    height: calc(100vh - 70px);
    overflow-y: auto;
  }

  .navbar .nav-links .loginBtn {
    padding: 10px 40px;
    margin: 20px;
    font-size: 18px;
    font-weight: bold;
    color: rgb(9, 14, 90);
  }

  /* Responsive dropdown code */
  .navbar .nav-links .dropdown,
  .navbar .nav-links .dropdown2 {
    float: none;
    width: 100%;
  }

  .navbar .nav-links .drop-content,
  .navbar .nav-links .drop-content2 {
    position: relative;
    background-color: rgb(220, 220, 250);
    top: 0px;
    left: 0px;
  }

  /* Text color */
  .navbar .nav-links .drop-content a {
    color: rgb(9, 14, 90);
  }

}

/* Dropdown menu CSS code */
.dropdown {
  position: relative;
  display: inline-block;
}

.drop-content,
.drop-content2 {
  display: none;
  position: absolute;
  background-color: #1b4cd3;
  min-width: 120px;
  font-size: 16px;
  top: 34px;
  z-index: 1;
  box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.4);
}

/* on hover show dropdown */
.dropdown:hover .drop-content,
.dropdown2:hover .drop-content2 {
  display: block;
}

/* drondown links */
.drop-content a {
  padding: 12px 10px;
  border-bottom: 1px solid rgb(197, 197, 250);
  display: block;
  transition: all 0.5s ease !important;
}

.dropBtn .drop-content a:hover {
  background-color: rgb(230, 230, 230);
}

.dropdown:hover .dropBtn,
.dropdown2:hover .dropBtn2 {
  background-color: rgba(0, 0, 0, 0.3);
}

.dropdown2 .drop-content2 {
  position: absolute;
  left: 120px;
  top: 126px;
}

.dropBtn2 i {
  margin-left: 15px;
}

.badge-notify {
  background: #2CC701;
  position: relative;
  top: -15px;
  left: -7px;
  color: black;
}
</style>
