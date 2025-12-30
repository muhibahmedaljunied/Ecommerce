<template>
    <!-- main-sidebar -->
    <div>
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll" :class="currentDirection === 'rtl' ? 'sidebar-right' : 'sidebar-left'">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" href="'index'"><img src='/Ecommerce/assets/img/logo_muhib.jpg' class="main-logo" alt="logo"></a>
				<a class="desktop-logo logo-dark active" href="'index'"><img src='/Ecommerce/assets/img/brand/logo-white.png' class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="'index'"><img src='/Ecommerce/assets/img/brand/favicon.png' class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="'index'"><img src='/Ecommerce/assets/img/brand/favicon-white.png' class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">

				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img alt="user-img" class="avatar avatar-xl brround" src='/Ecommerce/assets/img/background.png'><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">مهيب الجنيد </h4>
							<!-- <span class="mb-0 text-muted">Premium Member</span> -->
						</div>
					</div>
				</div>
				<ul class="side-menu">

					<!-- <li class="slide">
						<a class="side-menu__item" data-toggle="slide" href='#'><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/></svg><span class="side-menu__label">Charts</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
                            <router-link class="side-menu__item" data-toggle="slide" to="category"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/></svg><span class="side-menu__label">Category</span><i class="angle fe fe-chevron-down"></i></router-link>
						<router-link class="side-menu__item" data-toggle="slide" to="country"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/></svg><span class="side-menu__label">Country</span><i class="angle fe fe-chevron-down"></i></router-link>
						<router-link class="side-menu__item" data-toggle="slide" to="size"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/></svg><span class="side-menu__label">Size</span><i class="angle fe fe-chevron-down"></i></router-link>
						<router-link class="side-menu__item" data-toggle="slide" to="product"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/></svg><span class="side-menu__label">Product</span><i class="angle fe fe-chevron-down"></i></router-link>
						<router-link class="side-menu__item" data-toggle="slide" to="order"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/></svg><span class="side-menu__label">Order</span><i class="angle fe fe-chevron-down"></i></router-link>
						<router-link class="side-menu__item" data-toggle="slide" to="user"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/></svg><span class="side-menu__label">User</span><i class="angle fe fe-chevron-down"></i></router-link>
						<router-link class="side-menu__item" data-toggle="slide" to="order"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/></svg><span class="side-menu__label">Authorize</span><i class="angle fe fe-chevron-down"></i></router-link>


						</ul>
					</li> -->

                    <!-- <li class="side-item side-item-category">Main</li> -->
					<li class="slide">
						<router-link class="side-menu__item" to="/dashboard"><span class="side-menu__label">{{ $t('messages.dashboard') }}</span><span class="badge badge-success side-badge">1</span></router-link>
					</li>
					<!-- <li class="side-item side-item-category">General</li> -->

					<li class="slide">
						<router-link class="side-menu__item" data-toggle="slide" to="/attribute"><span class="side-menu__label">{{ $t('messages.attributes') }}</span><i class="angle fe fe-chevron-down"></i></router-link>
						<router-link class="side-menu__item" data-toggle="slide" to="/attribute_family"><span class="side-menu__label">{{ $t('messages.attribute_families') }}</span><i class="angle fe fe-chevron-down"></i></router-link>
						<router-link class="side-menu__item" data-toggle="slide" to="/category"><span class="side-menu__label">{{ $t('messages.categories') }}</span><i class="angle fe fe-chevron-down"></i></router-link>
						<!-- <router-link class="side-menu__item" data-toggle="slide" to="/country/country"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/></svg><span class="side-menu__label">Country</span><i class="angle fe fe-chevron-down"></i></router-link> -->
						<!-- <router-link class="side-menu__item" data-toggle="slide" to="/size/size"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/></svg><span class="side-menu__label">Size</span><i class="angle fe fe-chevron-down"></i></router-link> -->
						<router-link class="side-menu__item" data-toggle="slide" to="/product"><span class="side-menu__label">{{ $t('messages.products') }}</span><i class="angle fe fe-chevron-down"></i></router-link>


						<router-link class="side-menu__item" data-toggle="slide" to="/order"><span class="side-menu__label">{{ $t('messages.orders') }}</span><i class="angle fe fe-chevron-down"></i></router-link>
						<router-link class="side-menu__item" data-toggle="slide" to="/user"><span class="side-menu__label">{{ $t('messages.users') }}</span><i class="angle fe fe-chevron-down"></i></router-link>
						<!-- <router-link class="side-menu__item" data-toggle="slide" to="order"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/></svg><span class="side-menu__label">Authorize</span><i class="angle fe fe-chevron-down"></i></router-link> -->


					</li>


				</ul>
			</div>
		</aside>
    </div>
<!-- main-sidebar -->

</template>
