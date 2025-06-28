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
                @yield('content')

            </div>
        </div>
    </div>
  
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
