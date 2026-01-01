<template>
    <footer class="footer-area section_gap">
    <div class="container">
      <div class="row">
        <div class="col-lg-2 col-md-6 single-footer-widget">
          <h4>{{ $t('messages.top_products') }}</h4>
          <ul>
            <li><a href="#">{{ $t('messages.managed_website') }}</a></li>
            <li><a href="#">{{ $t('messages.manage_reputation') }}</a></li>
            <li><a href="#">{{ $t('messages.power_tools') }}</a></li>
            <li><a href="#">{{ $t('messages.marketing_service') }}</a></li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-6 single-footer-widget">
          <h4>{{ $t('messages.quick_links') }}</h4>
          <ul>
            <li><a href="#">{{ $t('messages.jobs') }}</a></li>
            <li><a href="#">{{ $t('messages.brand_assets') }}</a></li>
            <li><a href="#">{{ $t('messages.investor_relations') }}</a></li>
            <li><a href="#">{{ $t('messages.terms_of_service') }}</a></li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-6 single-footer-widget">
          <h4>{{ $t('messages.features') }}</h4>
          <ul>
            <li><a href="#">{{ $t('messages.jobs') }}</a></li>
            <li><a href="#">{{ $t('messages.brand_assets') }}</a></li>
            <li><a href="#">{{ $t('messages.investor_relations') }}</a></li>
            <li><a href="#">{{ $t('messages.terms_of_service') }}</a></li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-6 single-footer-widget">
          <h4>{{ $t('messages.resources') }}</h4>
          <ul>
            <li><a href="#">{{ $t('messages.guides') }}</a></li>
            <li><a href="#">{{ $t('messages.research') }}</a></li>
            <li><a href="#">{{ $t('messages.experts') }}</a></li>
            <li><a href="#">{{ $t('messages.agencies') }}</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-6 single-footer-widget">
          <h4>{{ $t('messages.newsletter') }}</h4>
          <p>{{ $t('messages.newsletter_desc') }}</p>
          <div class="form-wrap" id="mc_embed_signup">
            <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
              method="get" class="form-inline">
              <input class="form-control" name="EMAIL" :placeholder="$t('messages.email_address')" onfocus="this.placeholder = ''"
                :onblur="'this.placeholder = \'' + $t('messages.email_address') + '\''" required="" type="email">
              <button class="click-btn btn btn-default">{{ $t('messages.subscribe') }}</button>
              <div style="position: absolute; left: -5000px;">
                <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
              </div>

              <div class="info"></div>
            </form>
          </div>
        </div>
      </div>
      <div class="footer-bottom row align-items-center">
        <p class="footer-text m-0 col-lg-8 col-md-12"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy; 2019 {{ $t('messages.all_rights_reserved') }} | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
        <div class="col-lg-4 col-md-12 footer-social">
          <a href="#"><i class="fa fa-facebook"></i></a>
          <a href="#"><i class="fa fa-twitter"></i></a>
          <a href="#"><i class="fa fa-dribbble"></i></a>
          <a href="#"><i class="fa fa-behance"></i></a>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
    export default {
        mounted() {
            //console.log('Footer Section Mounted.')
        }
    }
</script>
