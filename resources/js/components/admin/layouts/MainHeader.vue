<template>
<!-- main-header opened -->
			<div class="main-header sticky side-header nav nav-item">
				<div class="container-fluid">
					<div class="main-header-left ">
						<div class="responsive-logo">
							<a href="#"><img src="" class="logo-1" alt="logo"></a>
							<a href="#"><img src="" class="dark-logo-1" alt="logo"></a>
							<a href="#"><img src="" class="logo-2" alt="logo"></a>
							<a href="#"><img src="" class="dark-logo-2" alt="logo"></a>
						</div>
						<div class="app-sidebar__toggle" data-toggle="sidebar">
							<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
							<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
						</div>
						<div class="main-header-center mr-3 d-sm-none d-md-none d-lg-block">
							<input class="form-control" placeholder="Search for anything..." type="search"> <button class="btn"><i class="fas fa-search d-none d-md-block"></i></button>
						</div>
					</div>
					<div class="col-md-4 logo_agile">
                            <h1 class="text-center">
                                <a href="customer/home"
                                    class="font-weight-slim font-italic">
                                    <img src="" alt=""
                                        class="img-fluid">Shop
                                </a>
                            </h1>
                      </div>
					<div class="main-header-right">
						<div class="nav nav-item  navbar-nav-right ml-auto">
							<div class="nav-link" id="bs-example-navbar-collapse-1">
								<form class="navbar-form" role="search">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Search">
										<span class="input-group-btn">
											<button type="reset" class="btn btn-default">
												<i class="fas fa-times"></i>
											</button>
											<button type="submit" class="btn btn-default nav-link resp-btn">
												<!-- <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg> -->
											</button>
										</span>
									</div>
								</form>
							</div>
							<div class="dropdown main-profile-menu nav nav-item nav-link">
								<a class="profile-user d-flex" href=""><img alt="" src="assets/img/background.jpg"></a>
								<div class="dropdown-menu">
									<div class="main-header-profile bg-primary p-3">
										<div class="d-flex wd-100p">
											<div class="main-img-user"><img alt="" src="assets/img/background.jpg" class=""></div>
											<div class="mr-3 my-auto">
												<h6>{{username}}</h6><span>{{email}}</span>
											</div>
										</div>
									</div>
									<a class="dropdown-item" href=""><i class="bx bx-user-circle"></i>Profile</a>
									<a class="dropdown-item" href=""><i class="bx bx-cog"></i> Edit Profile</a>
									<a class="dropdown-item" href=""><i class="bx bx-slider-alt"></i> Account Settings</a>
									<a class="dropdown-item" href="logout"><i class="bx bx-log-out"></i> Sign Out</a>
								</div>
							</div>
							
						</div>
					</div>
					  
					  
				</div>
			</div>
<!-- /main-header -->
</template>
<script>
    export default {
        data(){
          return{
            username:'',
			email:''
       
          }
        },
         mounted(){
            this.axios.post('/user_name').then(response => {
				this.username = response.data.user.name
				this.email = response.data.user.email

            });
        }
        
    }
</script>