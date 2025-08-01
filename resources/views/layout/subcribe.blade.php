<section class="ftco-section-parallax">
    <div class="parallax-img d-flex align-items-center">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                    <h2>Subcribe to our Newsletter</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                        there live the blind texts. Separated they live in</p>
                    <div class="row d-flex justify-content-center mt-4 mb-4">
                        <div class="col-md-12">

                            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="subscribe-form">
                                @csrf
                                <div class="form-group d-flex">
                                    <input type="email" name="email" class="form-control" placeholder="Enter email address" required>
                                    <input type="submit" value="Subscribe" class="submit px-3">
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
