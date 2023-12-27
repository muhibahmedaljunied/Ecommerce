<template>
	<div class="row row-sm">
		<!-- <div class="body d-flex py-3">
			<div class="container-xxl">
				<div class="row align-items-center">
					<div class="border-0 mb-4">
						<div
							class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
							<h3 class="fw-bold mb-0">Products</h3>
							<div class="btn-group group-link btn-set-task w-sm-100">
								<a href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-grid"
									class="btn d-inline-flex align-items-center" aria-current="page"><i
										class="icofont-wall px-2 fs-5"></i>Grid View</a>
								<a href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-list"
									class="btn active d-inline-flex align-items-center"><i
										class="icofont-listing-box px-2 fs-5"></i> List View</a>
							</div>
						</div>
					</div>
				</div>
				<div class="row g-3 mb-3">
					<div class="col-md-12 col-lg-4 col-xl-4 col-xxl-3">
						<div class="sticky-lg-top">
							<div class="card mb-3">
								<div class="reset-block">
									<div class="filter-title">
										<h4 class="title">Filter</h4>
									</div>
									<div class="filter-btn">
										<a class="btn btn-primary" href="#">Reset</a>
									</div>
								</div>
							</div>
							<div class="card mb-3">
								<div class="categories">
									<div class="filter-title">
										<a class="title collapsed" data-bs-toggle="collapse" href="#category" role="button"
											aria-expanded="false">Categories</a>
									</div>
									<div class="collapse" id="category" style="">
										<div class="filter-search">
											<form action="#">
												<input type="text" placeholder="Search" class="form-control">
												<button><i class="lni lni-search-alt"></i></button>
											</form>
										</div>
										<div class="filter-category">
											<ul class="category-list">
												<li><a href="#" data-bs-toggle="collapse" data-bs-target="#collapseOne"
														aria-expanded="false" class="collapsed">Game accessories</a>
													<ul id="collapseOne" class="sub-category collapse"
														data-parent="#category">
														<li><a href="#">PlayStation 4</a></li>
														<li><a href="#">Oculus VR</a></li>
														<li><a href="#">Remote</a></li>
														<li><a href="#">Lighting Keyborad</a></li>
													</ul>
												</li>
												<li><a class="collapsed" href="#" data-bs-toggle="collapse"
														data-bs-target="#collapseTwo">Bags</a>
													<ul id="collapseTwo" class="sub-category collapse"
														data-parent="#category">
														<li><a href="#">School Bags</a></li>
														<li><a href="#">Traveling Bags</a></li>
													</ul>
												</li>
												<li><a class="collapsed" href="#" data-bs-toggle="collapse"
														data-bs-target="#collapseThree">Flower Port</a>
													<ul id="collapseThree" class="sub-category collapse"
														data-parent="#category">
														<li><a href="#">Woodan Port</a></li>
														<li><a href="#">Pattern Port</a></li>
													</ul>
												</li>
												<li><a class="collapsed" href="#" data-bs-toggle="collapse"
														data-bs-target="#collapseFour">Watch</a>
													<ul id="collapseFour" class="sub-category collapse"
														data-parent="#category">
														<li><a href="#">Wall Clock</a></li>
														<li><a href="#">Smart Watch</a></li>
														<li><a href="#">Rado Watch</a></li>
														<li><a href="#">Fasttrack Watch</a></li>
														<li><a href="#">Noise Watch</a></li>
													</ul>
												</li>
												<li><a class="collapsed" href="#" data-bs-toggle="collapse"
														data-bs-target="#collapseFive">Accessories</a>
													<ul id="collapseFive" class="sub-category collapse"
														data-parent="#category">
														<li><a href="#">Note Diaries</a></li>
														<li><a href="#">Fold Diaries</a></li>
													</ul>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="card mb-3">
								<div class="size-block">
									<div class="filter-title">
										<a class="title" data-bs-toggle="collapse" href="#size" role="button"
											aria-expanded="true">Select Size</a>
									</div>
									<div class="collapse show" id="size">
										<div class="filter-size" id="filter-size-1">
											<ul>
												<li>XS</li>
												<li>S</li>
												<li class="">M</li>
												<li>L</li>
												<li>XL</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="card mb-3">
								<div class="color-block">
									<div class="filter-title">
										<a class="title" data-bs-toggle="collapse" href="#color" role="button"
											aria-expanded="false">Select Color</a>
									</div>
									<div class="collapse show" id="color">
										<div class="filter-color">
											<ul>
												<li>
													<div class="color-check">
														<p><span style="background-color: #4114e4;"></span>
															<strong>Blue</strong>
														</p>

														<input type="checkbox" id="color-1">
														<label for="color-1"><span></span></label>
													</div>
												</li>
												<li>
													<div class="color-check">
														<p><span style="background-color: #E14C7B;"></span>
															<strong>Red</strong>
														</p>

														<input type="checkbox" id="color-2">
														<label for="color-2"><span></span></label>
													</div>
												</li>
												<li>
													<div class="color-check">
														<p><span style="background-color: #7CB637;"></span>
															<strong>Green</strong>
														</p>

														<input type="checkbox" id="color-3">
														<label for="color-3"><span></span></label>
													</div>
												</li>
												<li>
													<div class="color-check">
														<p><span style="background-color: #161359;"></span>
															<strong>Dark</strong>
														</p>

														<input type="checkbox" id="color-4">
														<label for="color-4"><span></span></label>
													</div>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="card mb-3">
								<div class="price-range-block">
									<div class="filter-title">
										<a class="title" data-bs-toggle="collapse" href="#pricingTwo" role="button"
											aria-expanded="false">Pricing Range</a>
									</div>
									<div class="collapse show" id="pricingTwo">
										<div class="price-range">
											<div class="price-amount flex-wrap">
												<div class="amount-input mt-1">
													<label class="fw-bold">Minimum Price</label>
													<input type="text" id="minAmount2" class="form-control">
												</div>
												<div class="amount-input mt-1">
													<label class="fw-bold">Maximum Price</label>
													<input type="text" id="maxAmount2" class="form-control">
												</div>
											</div>
											<div id="slider-range2"
												class="slider-range noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr">
												<div class="noUi-base">
													<div class="noUi-connects">
														<div class="noUi-connect"
															style="transform: translate(7.45%) scale(0.125, 1);"></div>
													</div>
													<div class="noUi-origin"
														style="transform: translate(-925.5%); z-index: 5;">
														<div class="noUi-handle noUi-handle-lower" data-handle="0"
															tabindex="0" role="slider" aria-orientation="horizontal"
															aria-valuemin="0.0" aria-valuemax="399.0" aria-valuenow="149.0"
															aria-valuetext="149.00">
															<div class="noUi-touch-area"></div>
														</div>
													</div>
													<div class="noUi-origin"
														style="transform: translate(-800.5%); z-index: 6;">
														<div class="noUi-handle noUi-handle-upper" data-handle="1"
															tabindex="0" role="slider" aria-orientation="horizontal"
															aria-valuemin="149.0" aria-valuemax="2000.0"
															aria-valuenow="399.0" aria-valuetext="399.00">
															<div class="noUi-touch-area"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="rating-block">
									<div class="filter-title">
										<a class="title" data-bs-toggle="collapse" href="#rating" role="button"
											aria-expanded="false">Select Rating</a>
									</div>
									<div class="collapse show" id="rating">
										<div class="filter-rating">
											<ul>
												<li>
													<div class="rating-check">
														<input type="checkbox" id="rating-5">
														<label for="rating-5"><span></span>

														</label>
														<p>
															<i class="icofont-star"></i>
															<i class="icofont-star"></i>
															<i class="icofont-star"></i>
															<i class="icofont-star"></i>
															<i class="icofont-star"></i>
														</p>
													</div>
												</li>
												<li>
													<div class="rating-check">
														<input type="checkbox" id="rating-4">
														<label for="rating-4"><span></span></label>
														<p>
															<i class="icofont-star"></i>
															<i class="icofont-star"></i>
															<i class="icofont-star"></i>
															<i class="icofont-star"></i>
														</p>
													</div>
												</li>
												<li>
													<div class="rating-check">
														<input type="checkbox" id="rating-3">
														<label for="rating-3"><span></span></label>
														<p>
															<i class="icofont-star"></i>
															<i class="icofont-star"></i>
															<i class="icofont-star"></i>
														</p>
													</div>
												</li>
												<li>
													<div class="rating-check">
														<input type="checkbox" id="rating-2">
														<label for="rating-2"><span></span></label>
														<p>
															<i class="icofont-star"></i>
															<i class="icofont-star"></i>
														</p>
													</div>
												</li>
												<li>
													<div class="rating-check">
														<input type="checkbox" id="rating-1">
														<label for="rating-1"><span></span></label>
														<p>
															<i class="icofont-star"></i>
														</p>
													</div>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-lg-8 col-xl-8 col-xxl-9">
						<div class="card mb-3 bg-transparent p-2">
							<div class="card border-0 mb-1">
								<div
									class="form-check form-switch position-absolute top-0 end-0 py-3 px-3 d-none d-md-block">
									<input class="form-check-input" type="checkbox" id="Eaten-switch1" checked="">
									<label class="form-check-label" for="Eaten-switch1">Add to Cart</label>
								</div>
								<div class="card-body d-flex align-items-center flex-column flex-md-row">
									<a href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
										<img class="w120 rounded img-fluid"
											src="https://pixelwibes.com/template/ebazar/laravel/public/backend/dist/assets/images/product/product-1.jpg"
											alt="">
									</a>
									<div class="ms-md-4 m-0 mt-4 mt-md-0 text-md-start text-center w-100">
										<a
											href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
											<h6 class="mb-3 fw-bold">Oculus VR <span
													class="text-muted small fw-light d-block">Reference 1204</span></h6>
										</a>
										<div
											class="d-flex flex-row flex-wrap align-items-center justify-content-center justify-content-md-start">
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Special priceends</div>
												<strong>20h:46m:30s</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Offer</div>
												<strong>Bank Offer</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Price</div>
												<strong>$149</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Ratings</div>
												<strong><i class="icofont-star text-warning"></i>4.5 <span
														class="text-muted">(145)</span></strong>
											</div>
										</div>
										<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2 d-inline-flex d-md-none">
											<button type="button" class="btn btn-primary">Add Cart</button>
										</div>
									</div>
								</div>
							</div>
							<div class="card border-0 mb-1">
								<div
									class="form-check form-switch position-absolute top-0 end-0 py-3 px-3 d-none d-md-block">
									<input class="form-check-input" type="checkbox" id="Eaten-switch2">
									<label class="form-check-label" for="Eaten-switch2">Add to Cart</label>
								</div>
								<div class="card-body d-flex align-items-center flex-column flex-md-row">
									<a href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
										<img class="w120 rounded img-fluid"
											src="https://pixelwibes.com/template/ebazar/laravel/public/backend/dist/assets/images/product/product-2.jpg"
											alt="">
									</a>
									<div class="ms-md-4 m-0 mt-4 mt-md-0 text-md-start text-center w-100">
										<a
											href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
											<h6 class="mb-3 fw-bold">Wall Clock <span
													class="text-muted small fw-light d-block">Reference 1004</span></h6>
										</a>
										<div
											class="d-flex flex-row flex-wrap align-items-center justify-content-center justify-content-md-start">
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Special priceends</div>
												<strong>20h:46m:30s</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Offer</div>
												<strong>Bank Offer</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Price</div>
												<strong>$399</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Ratings</div>
												<strong><i class="icofont-star text-warning"></i>3.5 <span
														class="text-muted">(77)</span></strong>
											</div>
										</div>
										<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2 d-inline-flex d-md-none">
											<button type="button" class="btn btn-primary">Add Cart</button>
										</div>
									</div>
								</div>
							</div>
							<div class="card border-0 mb-1">
								<div
									class="form-check form-switch position-absolute top-0 end-0 py-3 px-3 d-none d-md-block">
									<input class="form-check-input" type="checkbox" id="Eaten-switch3">
									<label class="form-check-label" for="Eaten-switch3">Add to Cart</label>
								</div>
								<div class="card-body d-flex align-items-center flex-column flex-md-row">
									<a href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
										<img class="w120 rounded img-fluid"
											src="https://pixelwibes.com/template/ebazar/laravel/public/backend/dist/assets/images/product/product-3.jpg"
											alt="">
									</a>
									<div class="ms-md-4 m-0 mt-4 mt-md-0 text-md-start text-center w-100">
										<a
											href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
											<h6 class="mb-3 fw-bold">Note Diaries <span
													class="text-muted small fw-light d-block">Reference 1224</span></h6>
										</a>
										<div
											class="d-flex flex-row flex-wrap align-items-center justify-content-center justify-content-md-start">
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Special priceends</div>
												<strong>20h:46m:30s</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Offer</div>
												<strong>Bank Offer</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Price</div>
												<strong>$49</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Ratings</div>
												<strong><i class="icofont-star text-warning"></i>3.5 <span
														class="text-muted">(98)</span></strong>
											</div>
										</div>
										<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2 d-inline-flex d-md-none">
											<button type="button" class="btn btn-primary">Add Cart</button>
										</div>
									</div>
								</div>
							</div>
							<div class="card border-0 mb-1">
								<div
									class="form-check form-switch position-absolute top-0 end-0 py-3 px-3 d-none d-md-block">
									<input class="form-check-input" type="checkbox" id="Eaten-switch4">
									<label class="form-check-label" for="Eaten-switch4">Add to Cart</label>
								</div>
								<div class="card-body d-flex align-items-center flex-column flex-md-row">
									<a href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
										<img class="w120 rounded img-fluid"
											src="https://pixelwibes.com/template/ebazar/laravel/public/backend/dist/assets/images/product/product-4.jpg"
											alt="">
									</a>
									<div class="ms-md-4 m-0 mt-4 mt-md-0 text-md-start text-center w-100">
										<a
											href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
											<h6 class="mb-3 fw-bold">Flower Port <span
													class="text-muted small fw-light d-block">Reference 1414</span></h6>
										</a>
										<div
											class="d-flex flex-row flex-wrap align-items-center justify-content-center justify-content-md-start">
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Special priceends</div>
												<strong>18h:46m:30s</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Offer</div>
												<strong>Bank Offer</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Price</div>
												<strong>$199</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Ratings</div>
												<strong><i class="icofont-star text-warning"></i>4.5 <span
														class="text-muted">(1455)</span></strong>
											</div>
										</div>
										<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2 d-inline-flex d-md-none">
											<button type="button" class="btn btn-primary">Add Cart</button>
										</div>
									</div>
								</div>
							</div>
							<div class="card border-0 mb-1">
								<div
									class="form-check form-switch position-absolute top-0 end-0 py-3 px-3 d-none d-md-block">
									<input class="form-check-input" type="checkbox" id="Eaten-switch5">
									<label class="form-check-label" for="Eaten-switch5">Add to Cart</label>
								</div>
								<div class="card-body d-flex align-items-center flex-column flex-md-row">
									<a href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
										<img class="w120 rounded img-fluid"
											src="https://pixelwibes.com/template/ebazar/laravel/public/backend/dist/assets/images/product/product-5.jpg"
											alt="">
									</a>
									<div class="ms-md-4 m-0 mt-4 mt-md-0 text-md-start text-center w-100">
										<a
											href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
											<h6 class="mb-3 fw-bold">School Bag <span
													class="text-muted small fw-light d-block">Reference 1000</span></h6>
										</a>
										<div
											class="d-flex flex-row flex-wrap align-items-center justify-content-center justify-content-md-start">
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Special priceends</div>
												<strong>03h:30m:30s</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Offer</div>
												<strong>Bank Offer</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Price</div>
												<strong>$99</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Ratings</div>
												<strong><i class="icofont-star text-warning"></i>4.5 <span
														class="text-muted">(145)</span></strong>
											</div>
										</div>
										<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2 d-inline-flex d-md-none">
											<button type="button" class="btn btn-primary">Add Cart</button>
										</div>
									</div>
								</div>
							</div>
							<div class="card border-0 mb-1">
								<div
									class="form-check form-switch position-absolute top-0 end-0 py-3 px-3 d-none d-md-block">
									<input class="form-check-input" type="checkbox" id="Eaten-switch6">
									<label class="form-check-label" for="Eaten-switch6">Add to Cart</label>
								</div>
								<div class="card-body d-flex align-items-center flex-column flex-md-row">
									<a href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
										<img class="w120 rounded img-fluid"
											src="https://pixelwibes.com/template/ebazar/laravel/public/backend/dist/assets/images/product/product-6.jpg"
											alt="">
									</a>
									<div class="ms-md-4 m-0 mt-4 mt-md-0 text-md-start text-center w-100">
										<a
											href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
											<h6 class="mb-3 fw-bold">Rado Watch <span
													class="text-muted small fw-light d-block">Reference 9204</span></h6>
										</a>
										<div
											class="d-flex flex-row flex-wrap align-items-center justify-content-center justify-content-md-start">
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Special priceends</div>
												<strong>20h:46m:30s</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Offer</div>
												<strong>Bank Offer</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Price</div>
												<strong>$594</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Ratings</div>
												<strong><i class="icofont-star text-warning"></i>4.5 <span
														class="text-muted">(1245)</span></strong>
											</div>
										</div>
										<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2 d-inline-flex d-md-none">
											<button type="button" class="btn btn-primary">Add Cart</button>
										</div>
									</div>
								</div>
							</div>
							<div class="card border-0 mb-1">
								<div
									class="form-check form-switch position-absolute top-0 end-0 py-3 px-3 d-none d-md-block">
									<input class="form-check-input" type="checkbox" id="Eaten-switch7">
									<label class="form-check-label" for="Eaten-switch7">Add to Cart</label>
								</div>
								<div class="card-body d-flex align-items-center flex-column flex-md-row">
									<a href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
										<img class="w120 rounded img-fluid"
											src="https://pixelwibes.com/template/ebazar/laravel/public/backend/dist/assets/images/product/product-7.jpg"
											alt="">
									</a>
									<div class="ms-md-4 m-0 mt-4 mt-md-0 text-md-start text-center w-100">
										<a
											href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
											<h6 class="mb-3 fw-bold">Traveling Bag <span
													class="text-muted small fw-light d-block">Reference 1155</span></h6>
										</a>
										<div
											class="d-flex flex-row flex-wrap align-items-center justify-content-center justify-content-md-start">
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Special priceends</div>
												<strong>20h:46m:30s</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Offer</div>
												<strong>Bank Offer</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Price</div>
												<strong>$49</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Ratings</div>
												<strong><i class="icofont-star text-warning"></i>4.5 <span
														class="text-muted">(1045)</span></strong>
											</div>
										</div>
										<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2 d-inline-flex d-md-none">
											<button type="button" class="btn btn-primary">Add Cart</button>
										</div>
									</div>
								</div>
							</div>
							<div class="card border-0 mb-1">
								<div
									class="form-check form-switch position-absolute top-0 end-0 py-3 px-3 d-none d-md-block">
									<input class="form-check-input" type="checkbox" id="Eaten-switch8">
									<label class="form-check-label" for="Eaten-switch8">Add to Cart</label>
								</div>
								<div class="card-body d-flex align-items-center flex-column flex-md-row">
									<a href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
										<img class="w120 rounded img-fluid"
											src="https://pixelwibes.com/template/ebazar/laravel/public/backend/dist/assets/images/product/product-4.jpg"
											alt="">
									</a>
									<div class="ms-md-4 m-0 mt-4 mt-md-0 text-md-start text-center w-100">
										<a
											href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
											<h6 class="mb-3 fw-bold">Flower Port <span
													class="text-muted small fw-light d-block">Reference 1414</span></h6>
										</a>
										<div
											class="d-flex flex-row flex-wrap align-items-center justify-content-center justify-content-md-start">
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Special priceends</div>
												<strong>18h:46m:30s</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Offer</div>
												<strong>Bank Offer</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Price</div>
												<strong>$109</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Ratings</div>
												<strong><i class="icofont-star text-warning"></i>4.5 <span
														class="text-muted">(1455)</span></strong>
											</div>
										</div>
										<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2 d-inline-flex d-md-none">
											<button type="button" class="btn btn-primary">Add Cart</button>
										</div>
									</div>
								</div>
							</div>
							<div class="card border-0 mb-1">
								<div
									class="form-check form-switch position-absolute top-0 end-0 py-3 px-3 d-none d-md-block">
									<input class="form-check-input" type="checkbox" id="Eaten-switch9">
									<label class="form-check-label" for="Eaten-switch9">Add to Cart</label>
								</div>
								<div class="card-body d-flex align-items-center flex-column flex-md-row">
									<a href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
										<img class="w120 rounded img-fluid"
											src="https://pixelwibes.com/template/ebazar/laravel/public/backend/dist/assets/images/product/product-2.jpg"
											alt="">
									</a>
									<div class="ms-md-4 m-0 mt-4 mt-md-0 text-md-start text-center w-100">
										<a
											href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
											<h6 class="mb-3 fw-bold">Wall Clock <span
													class="text-muted small fw-light d-block">Reference 1004</span></h6>
										</a>
										<div
											class="d-flex flex-row flex-wrap align-items-center justify-content-center justify-content-md-start">
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Special priceends</div>
												<strong>20h:46m:30s</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Offer</div>
												<strong>Bank Offer</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Price</div>
												<strong>$144</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Ratings</div>
												<strong><i class="icofont-star text-warning"></i>4.5 <span
														class="text-muted">(77)</span></strong>
											</div>
										</div>
										<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2 d-inline-flex d-md-none">
											<button type="button" class="btn btn-primary">Add Cart</button>
										</div>
									</div>
								</div>
							</div>
							<div class="card border-0 mb-1">
								<div
									class="form-check form-switch position-absolute top-0 end-0 py-3 px-3 d-none d-md-block">
									<input class="form-check-input" type="checkbox" id="Eaten-switch10" checked="">
									<label class="form-check-label" for="Eaten-switch10">Add to Cart</label>
								</div>
								<div class="card-body d-flex align-items-center flex-column flex-md-row">
									<a href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
										<img class="w120 rounded img-fluid"
											src="https://pixelwibes.com/template/ebazar/laravel/public/backend/dist/assets/images/product/product-1.jpg"
											alt="">
									</a>
									<div class="ms-md-4 m-0 mt-4 mt-md-0 text-md-start text-center w-100">
										<a
											href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
											<h6 class="mb-3 fw-bold">Oculus VR <span
													class="text-muted small fw-light d-block">Reference 1204</span></h6>
										</a>
										<div
											class="d-flex flex-row flex-wrap align-items-center justify-content-center justify-content-md-start">
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Special priceends</div>
												<strong>20h:46m:30s</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Offer</div>
												<strong>Bank Offer</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Price</div>
												<strong>$149</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Ratings</div>
												<strong><i class="icofont-star text-warning"></i>4.5 <span
														class="text-muted">(145)</span></strong>
											</div>
										</div>
										<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2 d-inline-flex d-md-none">
											<button type="button" class="btn btn-primary">Add Cart</button>
										</div>
									</div>
								</div>
							</div>
							<div class="card border-0 mb-1">
								<div
									class="form-check form-switch position-absolute top-0 end-0 py-3 px-3 d-none d-md-block">
									<input class="form-check-input" type="checkbox" id="Eaten-switch11">
									<label class="form-check-label" for="Eaten-switch11">Add to Cart</label>
								</div>
								<div class="card-body d-flex align-items-center flex-column flex-md-row">
									<a href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
										<img class="w120 rounded img-fluid"
											src="https://pixelwibes.com/template/ebazar/laravel/public/backend/dist/assets/images/product/product-2.jpg"
											alt="">
									</a>
									<div class="ms-md-4 m-0 mt-4 mt-md-0 text-md-start text-center w-100">
										<a
											href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
											<h6 class="mb-3 fw-bold">Wall Clock <span
													class="text-muted small fw-light d-block">Reference 1004</span></h6>
										</a>
										<div
											class="d-flex flex-row flex-wrap align-items-center justify-content-center justify-content-md-start">
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Special priceends</div>
												<strong>20h:46m:30s</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Offer</div>
												<strong>Bank Offer</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Price</div>
												<strong>$149</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Ratings</div>
												<strong><i class="icofont-star text-warning"></i>4.5 <span
														class="text-muted">(77)</span></strong>
											</div>
										</div>
										<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2 d-inline-flex d-md-none">
											<button type="button" class="btn btn-primary">Add Cart</button>
										</div>
									</div>
								</div>
							</div>
							<div class="card border-0 mb-1">
								<div
									class="form-check form-switch position-absolute top-0 end-0 py-3 px-3 d-none d-md-block">
									<input class="form-check-input" type="checkbox" id="Eaten-switch12">
									<label class="form-check-label" for="Eaten-switch12">Add to Cart</label>
								</div>
								<div class="card-body d-flex align-items-center flex-column flex-md-row">
									<a href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
										<img class="w120 rounded img-fluid"
											src="https://pixelwibes.com/template/ebazar/laravel/public/backend/dist/assets/images/product/product-3.jpg"
											alt="">
									</a>
									<div class="ms-md-4 m-0 mt-4 mt-md-0 text-md-start text-center w-100">
										<a
											href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
											<h6 class="mb-3 fw-bold">Note Diaries <span
													class="text-muted small fw-light d-block">Reference 1224</span></h6>
										</a>
										<div
											class="d-flex flex-row flex-wrap align-items-center justify-content-center justify-content-md-start">
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Special priceends</div>
												<strong>20h:46m:30s</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Offer</div>
												<strong>Bank Offer</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Price</div>
												<strong>$149</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Ratings</div>
												<strong><i class="icofont-star text-warning"></i>4.5 <span
														class="text-muted">(98)</span></strong>
											</div>
										</div>
										<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2 d-inline-flex d-md-none">
											<button type="button" class="btn btn-primary">Add Cart</button>
										</div>
									</div>
								</div>
							</div>
							<div class="card border-0">
								<div
									class="form-check form-switch position-absolute top-0 end-0 py-3 px-3 d-none d-md-block">
									<input class="form-check-input" type="checkbox" id="Eaten-switch13">
									<label class="form-check-label" for="Eaten-switch13">Add to Cart</label>
								</div>
								<div class="card-body d-flex align-items-center flex-column flex-md-row">
									<a href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
										<img class="w120 rounded img-fluid"
											src="https://pixelwibes.com/template/ebazar/laravel/public/backend/dist/assets/images/product/product-4.jpg"
											alt="">
									</a>
									<div class="ms-md-4 m-0 mt-4 mt-md-0 text-md-start text-center w-100">
										<a
											href="https://pixelwibes.com/template/ebazar/laravel/public/backend/product-detail">
											<h6 class="mb-3 fw-bold">Flower Port <span
													class="text-muted small fw-light d-block">Reference 1414</span></h6>
										</a>
										<div
											class="d-flex flex-row flex-wrap align-items-center justify-content-center justify-content-md-start">
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Special priceends</div>
												<strong>18h:46m:30s</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Offer</div>
												<strong>Bank Offer</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Price</div>
												<strong>$149</strong>
											</div>
											<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
												<div class="text-muted small">Ratings</div>
												<strong><i class="icofont-star text-warning"></i>4.5 <span
														class="text-muted">(1455)</span></strong>
											</div>
										</div>
										<div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2 d-inline-flex d-md-none">
											<button type="button" class="btn btn-primary">Add Cart</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row g-3 mb-3">
							<div class="col-md-12">
								<nav class="justify-content-end d-flex">
									<ul class="pagination">
										<li class="page-item disabled">
											<a class="page-link" href="#" tabindex="-1">Previous</a>
										</li>
										<li class="page-item"><a class="page-link" href="#">1</a></li>
										<li class="page-item active" aria-current="page">
											<a class="page-link" href="#">2</a>
										</li>
										<li class="page-item"><a class="page-link" href="#">3</a></li>
										<li class="page-item">
											<a class="page-link" href="#">Next</a>
										</li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<!-- ---------------------------------------------------------------- -->
		<div class="col-xl-12">
			<div class="card">

				<div class="card-header pb-0">
					<span class="h2">المنتجات</span>


					<div style="display: flex;float: left; margin: 5px">

						<router-link to='/product/create_product' class="tn btn-info btn-sm waves-effect btn-agregar"
							data-toggle="modal" id="agregar_productos" data-target="#addAb">
							<i class="fa fa-plus-circle"></i></router-link>

						<input type="search" autocomplete="on" name="search" data-toggle="dropdown" role="button"
							aria-haspopup="true" aria-expanded="true" placeholder="بحث" v-model="word_search"
							@input="get_search()" />

						<div></div>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table text-md-nowrap" id="example1">
							<thead>
								<tr>
									<th class="wd-15p border-bottom-0">المنتج</th>
									<th class="wd-15p border-bottom-0">الصوره</th>
									<th class="wd-15p border-bottom-0">الصنف</th>
									<th class="wd-15p border-bottom-0">الدوله</th>
									<th class="wd-15p border-bottom-0">الحجم</th>
									<th class="wd-15p border-bottom-0">العلامه التجاريه</th>
									<th class="wd-15p border-bottom-0">اللون</th>
									<th class="wd-15p border-bottom-0">العمر</th>
									<th class="wd-15p border-bottom-0">الكميه</th>
									<th class="wd-15p border-bottom-0">السعر</th>
									<th class="wd-15p border-bottom-0">الخصم</th>
									<th class="wd-15p border-bottom-0">الحاله</th>

									<th class="wd-15p border-bottom-0"> العمليات</th>



								</tr>
							</thead>
							<tbody>
								<tr v-for="products in product">
									<td>{{ products.text }}</td>
									<td>
										<img :src="`assets/upload/${products.image}`" height="50px" alt="products image">
									</td>
									<td>{{ products.category_name }}</td>
									<td>{{ products.country_name }}</td>
									<td>{{ products.size_name }}</td>
									<td>{{ products.brand_name }}</td>
									<td>{{ products.color_name }}</td>
									<td>{{ products.age_name }}</td>

									<td>{{ products.qty }}</td>
									<td>{{ products.price }}</td>
									<td>{{ products.discount }}</td>
									<td>{{ products.status }}</td>

									<td>
										<button type='button' @click="delete_product(products.id)"
											class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
										<router-link :to="{ name: 'edit_product', params: { id: products.id } }"
											class="btn btn-success btn-sm"><i class="fa fa-edit"></i></router-link>
									</td>

								</tr>

							</tbody>
						</table>
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
			product: '',
		}
	},
	mounted() {
		this.axios.post('/product').then(response => {
			this.product = response.data;
			this.$root.logo = 'Product'

		})
	},
	methods: {

		delete_product(id) {

			this.axios.post(`/delete_product/${id}`).then(response => {

				toast.fire({
					title: "Deleted!",
					text: "Your product has been deleted.",
					button: "Close", // Text on button
					icon: "success", //built in icons: success, warning, error, info
					timer: 3000, //timeOut for auto-close
					buttons: {
						confirm: {
							text: "OK",
							value: true,
							visible: true,
							className: "",
							closeModal: true
						},
						cancel: {
							text: "Cancel",
							value: false,
							visible: true,
							className: "",
							closeModal: true,
						}
					}
				})

				// this.$router.push('category')

			})
		}

	}

}


</script>

