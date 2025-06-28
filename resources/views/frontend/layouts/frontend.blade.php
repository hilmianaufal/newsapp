<!doctype html>
<html class="no-js" lang="zxx">

@include('frontend.includes.header')

   <body>


@include('frontend.includes.navbar')

    <main>
    <!-- Trending Area Start -->
    <div class="trending-area fix">
        <div class="container">
            <div class="trending-main">
                <!-- Trending Tittle -->

@include('frontend.includes.trending')

@include('frontend.includes.trandingtop')
            </div>
        </div>
    </div>
    <!-- Trending Area End -->
    <!--   Weekly-News start -->
@include('frontend.includes.weekly')
    <!-- End Weekly-News -->
   <!-- Whats New Start -->
@include('frontend.includes.whatnews')
    <!-- Whats New End -->
    <!--   Weekly2-News start -->
@include('frontend.includes.weekly2')
    <!-- End Weekly-News -->
    <!-- Start Youtube -->
@include('frontend.includes.video')
    <!-- End Start youtube -->
    <!--  Recent Articles start -->
@include('frontend.includes.recent')
    <!--Recent Articles End -->
    <!--Start pagination -->
    <!-- End pagination  -->
    </main>

    @include('frontend.includes.footer')
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    once: true, // animasi hanya sekali saat scroll
    duration: 800, // durasi animasi
  });
</script>

    </body>
</html>
