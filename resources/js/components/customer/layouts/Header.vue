<template>

    <header class="header_area">
        <div class="top_menu">
            <div class="container-fluid">
                <div class="row">



                    <div class="col-lg-6 top-left">
                        <div class="top-icons" v-if="showSession">
                            <span class="top-icon"><i class="fa fa-facebook" aria-hidden="true"></i></span>
                            <span class="top-icon"><i class="fa fa-whatsapp" aria-hidden="true"></i></span>
                            <span class="top-icon"><i class="fa fa-mail-forward" aria-hidden="true"></i> <span class="contact-text">{{ showSession.email }}</span></span>
                            <span class="top-icon"><i class="fa fa-phone" aria-hidden="true"></i> <span class="contact-text">+967 {{ showSession.phone }}</span></span>
                        </div>
                    </div>

                    <div class="col-lg-3 top-right">
                        <div class="float-right">
                            <ul class="right_side" v-if="showSession">

                                <li>
                                    <a href="#">
                                        {{ $t('messages.welcome') }}, {{ showSession.name }}
                                    </a>
                                </li>

                                <li>

                                    <a href="#" @click="logout">
                                        {{ $t('messages.logout') }}
                                    </a>
                                </li>
                                <li class="lang-item">
                                    <div class="lang-wrap">
                                        <select v-model="selectedLanguage" @change="changeLang" class="lang-select"
                                            aria-label="Select language">
                                            <option value="en">English</option>
                                            <option value="ar">العربية</option>
                                            <option value="fr">Français</option>
                                            <option value="de">Deutsch</option>
                                            <option value="it">Italiano</option>
                                            <option value="ru">Русский</option>
                                            <option value="es">Español</option>
                                        </select>
                                    </div>
                                </li>

                                <!-- <li>

                  <button type = 'button' @click ="logout"  class="btn ">Logout</button>

                </li>  -->
                            </ul>
                            <ul class="right_side" v-else>

                                <li>
                                    <!-- <router-link to="/customer/login">
                    Login
                  </router-link> -->
                                    <router-link to="/customer/login">
                                        {{ $t('messages.login') }}
                                    </router-link>
                                </li>

                                <li>
                                    <!-- <router-link to="/customer/register">
                    Register
                  </router-link> -->
                                    <router-link to="/customer/register">
                                        {{ $t('messages.register') }}
                                    </router-link>


                                </li>
                                <li class="lang-item">
                                    <div class="lang-wrap">
                                        <select v-model="selectedLanguage" @change="changeLang" class="lang-select"
                                            aria-label="Select language">
                                            <option value="en">English</option>
                                            <option value="ar">العربية</option>
                                            <option value="fr">Français</option>
                                            <option value="de">Deutsch</option>
                                            <option value="it">Italiano</option>
                                            <option value="ru">Русский</option>
                                            <option value="es">Español</option>
                                        </select>
                                    </div>
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
                                          <img src="/Ecommerce/assets/img/logo_muhib.jpg" width="100px" alt="logo">
                                        </a>
                                  </div>
                            </div>

                        <!-- responsive navbar toggle button -->
                        <div class="nav-btn" role="button" aria-label="Toggle navigation" @click="navOpen = !navOpen"
                        :aria-expanded="navOpen">
                              <label>
                                  <span></span>
                                    <span></span>
                                    <span></span>
                                  </label>
                            </div>
                        <!-- Navbar items -->
                        <div class="nav-links" :class="{ open: navOpen }" @click="navOpen = false">
                        <!-- Search (main menu) -->
                        <form class="search-form" @submit.prevent="performSearch" role="search" aria-label="Site search">
                            <input type="search" v-model="searchQuery" class="search-input" :placeholder="$t('messages.search_placeholder')" aria-label="Search products" />
                            <button type="submit" class="search-btn" aria-label="Search"><i class="fa fa-search"></i></button>
                        </form>
                        <!--       <a href="#">Home</a> -->
                        <router-link to="/customer/home">{{ $t('messages.home') }}</router-link>



                        <!--       <div class="dropdown">
                      <a class="dropBtn" href="#">Category
                        </a>
                      <div class="drop-content">

                <ul>
                  <li v-for="category in categories" class="nav-item">
                    <router-link :to="`/customer/category/${category.id}`">{{ category.name }}</router-link>

                  </li>
                </ul>


                        {}
              </div>
                    </div> -->

                             <div class="dropdown" v-for="category in categories">


                            <!-- <router-link :to="`/customer/category/${category.id}`">{{ category.text }}</router-link> -->
                            <router-link :to="{ name: 'CustomerCategory', params: { id: category.id } }" replace:
                                true>{{ $t('messages.' + category.text) }}</router-link>


                        </div>
                           <a href="/Ecommerce">{{ $t('messages.dashboard') }}</a>

                              <router-link to="/customer/cart"><i class="fa fa-shopping-cart"></i> <span
                                class="badge badge-notify">{{
                                    showCountCart }}</span></router-link>
                        <!--  <router-link to="/customer/login"><i class="ti-user" aria-hidden="true"></i></router-link> -->

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
            navOpen: false,
            searchQuery: '',
        }
    },
    created() {
        this.axios.post('/home')
            .then((response => {
                this.categories = response.data
            }))
    },
    async mounted() {
        this.$Progress.start();
        this.$store.dispatch("countCart");
        this.$store.dispatch("customerSession");
        await this.$store.dispatch("loadTranslations", this.selectedLanguage);
        document.documentElement.dir = this.currentDirection;
        this.$Progress.finish();
    },
    computed: {
        showCountCart() {
            return this.$store.getters.getCountCart
        },
        showSession() {
            return this.$store.getters.getSessionData
        },
        selectedLanguage: {
            get() {
                return this.$store.getters.getCurrentLocale;
            },
            set(value) {
                this.$store.dispatch('setLanguage', value);
            }
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
                    this.$store.dispatch("customerSession");
                    const currentPath = this.$route.path;
                    // If user logs out while choosing payment, send them to customer login and return to payment after login
                    if (currentPath === '/customer/payment') {
                        this.$router.push({ path: '/customer/login', query: { redirect: '/customer/payment' } });
                    } else {
                        // Otherwise, go to customer home
                        this.$router.push('/customer/home');
                    }
                })
        },
        changeLang() {
            // Handled by selectedLanguage setter
        },
        performSearch() {
            if (!this.searchQuery || !this.searchQuery.trim()) return;
            // close mobile nav if open
            this.navOpen = false;
            // push to search route (adjust route/path as needed)
            this.$router.push({ path: '/customer/search', query: { q: this.searchQuery.trim() } });
            // clear input if you want: this.searchQuery = '';
        },
        // search(){
        //   axios.post('/search-product',{
        //     searchKey: this.searchKey
        //   })
        //   .then((response)=>{
        //     //console.log(response.data.searchData)
        //     this.searchResult = response.data.searchData

        //   })
        // }

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
    font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    /* background-image: url(background-img.jpg); */
    background-size: cover;
    background-attachment: fixed;
}

.navbar {
    height: 100px;
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

/* Search form in main menu */
.navbar .search-form { display: inline-block; margin-right: 300px; vertical-align: middle; }
.navbar .search-form .search-input { padding: 8px 83px; border-radius: 30px; border: none; min-width: 220px; }
.navbar .search-form .search-btn { background: transparent; border: none; color: #fff; padding: 8px; cursor: pointer; }

@media (max-width:700px) {
    .navbar .search-form { display: block; margin: 12px auto; width: calc(100% - 40px); padding: 0 20px; text-align: center; }
    .navbar .search-form .search-input { width: calc(100% - 44px); min-width: auto; }
    .navbar .search-form .search-btn { position: relative; right: 0; }
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
        cursor: pointer;
    }

    .navbar .nav-btn label span {
        display: block;
        height: 3px;
        width: 25px;
        background: #fff;
        margin: 6px 0;
    }

    .navbar .nav-btn label:hover {
        background-color: rgb(9, 14, 90);
        transition: all 0.5s ease;
    }

    .navbar .nav-links {
        position: absolute;
        display: block;
        text-align: center;
        width: 100%;
        background-color: rgb(9, 14, 90);
        z-index: 9999;
        transition: height 0.3s ease-in;
        overflow-y: hidden;
        top: 70px;
        right: 0px;
        height: 0px;
    }

    .navbar .nav-links a {
        display: block;
    }

    /* when nav toggle button is open */
    .navbar .nav-links.open {
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

    /* Stack the top menu items */
    .top_menu .container .row>div {
        flex: 0 0 100%;
        max-width: 100%;
        text-align: center;
        margin-bottom: 5px;
    }

    .top_menu .float-left,
    .top_menu .float-right {
        float: none;
        display: inline-block;
    }

    .navbar .nav-header .nav-logo img {
        width: 80px;
    }

    .badge-notify {
        top: -10px;
        left: -3px;
    }

}

/* Top menu improvements */
.top_menu {
    background: #fff;
    padding: 6px 0;
    border-bottom: 1px solid rgba(36, 73, 118, 0.08);
    font-size: 14px;
    color: #244976;
    /* margin-bottom: 10px; */
    /* space between top menu and main menu */
}

.top_menu .row>div {
    display: flex;
    align-items: center;
}

.top_menu .container .row {
    display: flex;
    align-items: center;
    gap: 12px;
    justify-content: space-between;
}

@media (max-width:700px) {
    .top_menu .container .row {
        display: block;
    }

    .top_menu .row>div {
        display: block;
        width: 100%;
        text-align: center;
        margin-bottom: 6px;
    }
}

/* Left and right alignment */
.top_menu .top-left { justify-content: center;}
.top_menu .top-left .top-icons { display: flex; gap: 14px; align-items: center; }
.top_menu .top-left .top-icon { color: #244976; display: inline-flex; align-items: center; gap: 8px; font-weight: 600; }
.top_menu .top-left .top-icon i { color: #244976; }
.top_menu .top-left .contact-text { font-weight: 500; color: #244976; }

.top_menu .top-right { justify-content: flex-end; padding-right: 12px; }
.top_menu .top-right .float-right { margin-left: 0; display: flex; align-items: center; }
.top_menu .top-right .right_side { margin: 0; }

@media (max-width:700px) {
    .top_menu .top-left { margin-right: 0; padding-left: 0; }
    .top_menu .top-right { padding-right: 0; }
}

@media (max-width:700px) {
    .top_menu .top-left .top-icons { justify-content: center; gap: 8px; }
    .top_menu .top-right { text-align: center; }
    .top_menu .top-right .float-right { justify-content: center; }
}

.top_menu .float-left {
    margin-right: 8px;
    color: #244976;
}

.top_menu .float-right {
    margin-left: auto;
}

.top_menu .right_side {
    list-style: none;
    display: flex;
    gap: 12px;
    align-items: center;
    padding: 0;
    margin: 0;
}

.top_menu .right_side li a {
    color: #244976;
    text-decoration: none;
    font-weight: 600;
}

.top_menu .right_side li a:hover {
    text-decoration: underline;
}

.top_menu .right_side .lang-item {
    display: flex;
    align-items: center;
}

.top_menu .right_side .lang-item .lang-select {
    min-width: 90px;
    padding: 6px 8px;
}

/* Language select styles */
.lang-wrap {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-left: 8px;
}

.lang-wrap .fa-globe {
    color: #244976;
    font-size: 16px;
}

.lang-select {
    background: #fff;
    border: 0px solid #ccc;
    color: #333;
    font-weight: 600;
    padding: 6px 8px;
    border-radius: 4px;
    outline: none;
    min-width: 90px;
}

.lang-select option {
    color: #000;
}

@media (max-width:700px) {
    .lang-wrap {
        display: block;
        margin: 6px auto;
        text-align: center;
    }

    .lang-wrap .fa-globe {
        display: none;
    }

    .lang-select {
        color: #000;
        background: #fff;
        border: 1px solid rgba(0, 0, 0, 0.1);
        padding: 8px 12px;
        width: 80%;
        min-width: 120px;
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
