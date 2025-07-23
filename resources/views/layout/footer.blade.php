<footer class="ftco-footer ftco-bg-dark ftco-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-5">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">@setting('footer_title')</h2>
                    <p style="    width: 75%;">
                        @setting('footer_text')
                    </p>

                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
                        <li class="ftco-animate"><a href="@setting('url_general')"><span class="icon-link2"></span></a></li>

                        <li class="ftco-animate"><a href="@setting('linkedIn_link')"><span class="icon-linkedin"></span></a></li>
                        <li class="ftco-animate"><a href="@setting('telegram_link')"><span class="icon-telegram"></span></a></li>
                        <li class="ftco-animate"><a href="@setting('general_mail')"><span class="icon-mail-forward"></span></a></li>
                        <li class="ftco-animate"><a href="@setting('X_url')"><span class="icon-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="@setting('facebook_url')"><span class="icon-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="@setting('instagram')"><span class="icon-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Pages</h2>
                    <ul class="list-unstyled">
                        <li ><a href="{{ route('home') }}" class="pb-1 d-block">@setting('home.nav.item_1')</a></li>
                        <li ><a href="{{route('specializations')}}" class="pb-1 d-block">@setting('home.nav.item_2')</a></li>
                        <li ><a href="{{route('getJobSeeker.index')}}" class="pb-1 d-block">@setting('home.nav.item_3')</a></li>
                        <li ><a href="{{route('experts.index')}}" class="pb-1 d-block">@setting('home.nav.item_4')</a></li>
                        <li ><a href="{{route('blog')}}" class="pb-1 d-block">@setting('home.nav.item_5')</a></li>
                        <li ><a href="{{route('contact')}}" class="pb-1 d-block">@setting('home.nav.item_6')</a></li>


                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Have a Questions?</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li>
                                <span class="icon icon-map-marker"></span>
                                <span class="text">
                                    <a href="https://maps.app.goo.gl/QGQknRJM7h6yke796" target="_blank" rel="noopener">
                                        @setting('location')
                                    </a></span>
                            </li>

                            <li><a href="#"><span class="icon icon-phone"></span><span class="">@setting('phone 1')</span></a></li>
                            <li><a href="#"><span class="icon icon-phone"></span><span class="">@setting('phone 2')</span></a></li>


                            <li><a href="#"><span class="icon icon-fax"></span><span class="">@setting('fax_number')</span></a></li>

                            <li><a href="@setting('general_mail')"><span class="icon icon-envelope"></span><span class="text">@setting('general_mail')</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">

                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This website is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="@setting('url_general')" target="_blank">@setting('made_by_footer')</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
            </div>
        </div>
    </div>
</footer>



<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

