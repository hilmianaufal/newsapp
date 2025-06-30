<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Portal Artikel</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('back/img/icon.ico') }}" type="image/x-icon"/>
	 <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome 5.15.4 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
	<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


	<!-- Fonts and icons -->
	<script src="{{ asset('back/js/plugin/webfont/webfont.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['back/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<script src="https://cdn.tiny.cloud/1/75wwuqs94bhvkprn3t95ewlbzt4jr19llo2ai7cw91iic9bv/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
		<script>
			tinymce.init({
				selector: 'textarea#editor',
				plugins: 'link image code',
				toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | code'
			});
			</script>
	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('back/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('back/css/atlantis.min.css') }}">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{ asset('back/css/demo.css') }}">
	<style>
.select2-container--default .select2-selection--single {
    height: 38px !important;
    padding: 6px 12px;
    border: 1px solid #ced4da;
    border-radius: 0 4px 4px 0;
    line-height: 24px;
}
.select2-container {
    width: 100% !important;
}
body {
            font-family: 'Source Sans Pro', sans-serif !important;
        } 
	.artikel-image {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
    }

    @media (max-width: 576px) {
        .artikel-image {
            max-height: 220px;
        }
    }   
</style>

</head>
