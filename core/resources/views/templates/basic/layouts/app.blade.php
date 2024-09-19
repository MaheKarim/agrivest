<!doctype html>
<html lang="{{ config('app.locale') }}" itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> {{ gs()->siteName(__($pageTitle)) }}</title>

    @include('partials.seo')

    <link href="{{ asset('assets/global/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/global/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/global/css/line-awesome.min.css') }}">

    @stack('style-lib')

    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/main.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/custom.css') }}">

    @stack('style')

    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/color.php') }}?color={{ gs('base_color') }}">
</head>

@php echo loadExtension('google-analytics') @endphp

<body>
<div class="preloader">
    <div class="loader-p"></div>
</div>
<div class="body-overlay"></div>
<div class="sidebar-overlay"></div>
<a class="scroll-top"><i class="fas fa-angle-double-up"></i></a>

@yield('panel')

@include($activeTemplate . 'partials.cookie_card')

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{ asset('assets/global/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/global/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset($activeTemplateTrue . 'js/viewport.jquery.js') }}"></script>

@stack('script-lib')

<script src="{{ asset($activeTemplateTrue . 'js/main.js') }}"></script>

@php echo loadExtension('tawk-chat') @endphp

@include('partials.notify')

@if (gs('pn'))
    @include('partials.push_script')
@endif

@stack('script')

<script>
    (function ($) {
        "use strict";
        $(".langSel").on("change", function () {
            window.location.href = "{{ route('home') }}/change/" + $(this).val();
        });

        $('.policy').on('click', function () {
            $.get('{{ route('cookie.accept') }}', function (response) {
                $('.cookies-card').addClass('d-none');
            });
        });

        setTimeout(function () {
            $('.cookies-card').removeClass('hide')
        }, 2000);

        var inputElements = $('[type=text],select,textarea');
        $.each(inputElements, function (index, element) {
            element = $(element);
            element.closest('.form-group').find('label').attr('for', element.attr('name'));
            element.attr('id', element.attr('name'))
        });

        $.each($('input, select, textarea'), function (i, element) {
            var elementType = $(element);
            if (elementType.attr('type') != 'checkbox') {
                if (element.hasAttribute('required')) {
                    $(element).closest('.form-group').find('label').addClass('required');
                }
            }

        });

        let disableSubmission = false;
        $('.disableSubmission').on('submit', function (e) {
            if (disableSubmission) {
                e.preventDefault()
            } else {
                disableSubmission = true;
            }
        });

    })(jQuery);
</script>
</body>

</html>
