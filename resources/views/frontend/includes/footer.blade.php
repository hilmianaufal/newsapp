<footer class="footer-area footer-padding bg-dark text-light">
    <div class="container">
        <div class="row gy-4">
            <!-- Kolom 1: Logo & Kontak -->
            <div class="col-lg-4 col-md-6">
                <div class="footer-logo mb-3">
                    {{-- <a href="/"> --}}
                        {{-- <img src="assets/img/logo/logo2_footer.png" alt="Logo" style="max-height: 50px;"> --}}
                        <h1>KebonCintaNet</h1>
                    {{-- </a> --}}
                </div>
                <p class="small mb-2 text-white">
                    Kami menyediakan artikel terbaru dan terpercaya untuk Anda. Kunjungi kami dan dapatkan informasi terbaik.
                </p>
                <ul class="list-unstyled small">
                    <li><i class="fas fa-map-marker-alt me-2 text-warning"></i> Jl. Urip Sumoharjo No.18</li>
                    <li><i class="fas fa-phone-alt me-2 text-warning"></i> 087724345243  </li>
                    <li><i class="fas fa-envelope me-2 text-warning"></i> pondokkeboncinta@gmail.com</li>
                </ul>
                <div class="footer-social mt-3">
                    <a href="#"><i class="fab fa-facebook-f text-light me-3"></i></a>
                    <a href="#"><i class="fab fa-instagram text-light me-3"></i></a>
                    <a href="#"><i class="fab fa-twitter text-light"></i></a>
                </div>
            </div>

            <!-- Kolom 2: Kategori Populer -->
            <div class="col-lg-4 col-md-6">
                <h5 class="text-white mb-3">Kategori Populer</h5>
                <ul class="list-unstyled">
                    @foreach ($kategori as $item)
                        
                    <li><a href="/kategori/{{ $item->slug }}" class="text-decoration-none text-light d-flex align-items-center mb-2">
                        <i class="fas fa-newspaper me-2 text-warning"></i>{{ $item->nama_kategori }}
                    </a></li>
                    @endforeach
                    
                </ul>
            </div>

            <!-- Kolom 3: Kategori Lain -->
            <div class="col-lg-4 col-md-6">
                <h5 class="text-white mb-3">Kategori Lainnya</h5>
                <ul class="list-unstyled">
                    @foreach ($kategori as $item)
                        
                    <li><a href="/kategori/{{ $item->slug }}" class="text-decoration-none text-light d-flex align-items-center mb-2">
                        <i class="fas fa-newspaper me-2 text-warning"></i>{{ $item->nama_kategori }}
                    </a></li>
                    @endforeach
                    
                </ul>
            </div>
        </div>

        <hr class="text-secondary my-4">

        <div class="row">
            <div class="col-md-6 small">
                <p class="mb-0">&copy; {{ now()->year }} All rights reserved. Developed by <a href="#" class="text-warning">Hilmi An Naufal</a></p>
            </div>
            <div class="col-md-6 text-md-end small">
                <a href="#" class="text-light me-3">Terms</a>
                <a href="#" class="text-light me-3">Privacy</a>
                <a href="#" class="text-light">Contact</a>
            </div>
        </div>
    </div>
</footer>


	<!-- JS here -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<!-- All JS Custom Plugins Link Here here -->
        <script src="{{ asset('back/js/vendor/modernizr-3.5.0.min.js') }}"></script>
		<!-- Jquery, Popper, Bootstrap -->
		
        <script src="{{ asset('back/js/popper.min.js') }}"></script>
        <script src="{{ asset('back/js/bootstrap.min.js') }}"></script>
	    <!-- Jquery Mobile Menu -->
        <script src="{{ asset('back/js/jquery.slicknav.min.js') }}"></script>

		<!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="{{ asset('back/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('back/js/slick.min.js') }}"></script>
        <!-- Date Picker -->
        <script src="{{ asset('back/js/gijgo.min.js') }}"></script>
		<!-- One Page, Animated-HeadLin -->
        <script src="{{ asset('back/js/wow.min.js') }}"></script>
		<script src="{{ asset('back/js/animated.headline.js') }}"></script>
        <script src="{{ asset('back/js/jquery.magnific-popup.js') }}"></script>

        <!-- Breaking New Pluging -->
        <script src="{{ asset('back/js/jquery.ticker.js') }}"></script>
        <script src="{{ asset('back/js/site.js') }}"></script>

		<!-- Scrollup, nice-select, sticky -->
        <script src="{{ asset('back/js/jquery.scrollUp.min.js') }}"></script>
        <script src="{{ asset('back/js/jquery.nice-select.min.js') }}"></script>
		<script src="{{ asset('back/js/jquery.sticky.js') }}"></script>

        <!-- contact js -->
        <script src="{{ asset('back/js/contact.js') }}"></script>
        <script src="{{ asset('back/js/jquery.form.js') }}"></script>
        <script src="{{ asset('back/js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('back/js/mail-script.js') }}"></script>
        <script src="{{ asset('back/js/jquery.ajaxchimp.min.js') }}"></script>

		<!-- Jquery Plugins, main Jquery -->
        <script src="{{ asset('back/js/plugins.js') }}"></script>
        <script src="{{ asset('back/js/main.js') }}"></script>

<script>
$(document).ready(function () {
  $('#searchInput').on('keyup', function () {
    let query = $(this).val();
    if (query.length > 2) {
      $.ajax({
        url: "{{ route('search.suggestions') }}", // Ganti sesuai route kamu
        method: "GET",
        data: { q: query },
        success: function (data) {
          let output = '';
          if (data.length > 0) {
            data.forEach(item => {
              output += `<a href="/detail/${item.slug}" class="list-group-item list-group-item-action">${item.judul}</a>`;
            });
          } else {
            output = '<div class="list-group-item text-muted">Tidak ditemukan</div>';
          }
          $('#searchResults').html(output).removeClass('d-none');
        }
      });
    } else {
      $('#searchResults').addClass('d-none');
    }
  });

  // Sembunyikan saat klik luar
  $(document).on('click', function (e) {
    if (!$(e.target).closest('#searchForm').length) {
      $('#searchResults').addClass('d-none');
    }
  });
});
</script>
<script>
  const toggle = document.getElementById('modeToggle');
  toggle.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
    toggle.textContent = document.body.classList.contains('dark-mode') ? '☀️' : '🌙';
  });
</script>
<script>
    function scrollBerita(direction) {
        const slider = document.getElementById('beritaSlider');
        const scrollAmount = 270; // lebar card + margin
        slider.scrollBy({
            left: direction * scrollAmount,
            behavior: 'smooth'
        });
    }
</script>
