@php
    $socialLinks = getContent('social_icon.element',false, orderById:true);
    $topbarContents = getContent('top_bar.element',null, orderById:true);
@endphp
<header class="header" id="header">
    <div class="header-top d-none d-lg-block">
        <div class="container">
            <div class="header-top-wrapper">
                <div class="header-top__item one">
                    <ul class="social-list">
                        @foreach ($socialLinks as $socialLink)
                            <li class="social-list__item">
                                <a href="{{ @$socialLink->data_values->url }}" class="social-list__link"
                                   target="_blank">
                                    @php echo @$socialLink->data_values->social_icon @endphp
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="header-top__item two">
                    @foreach ($topbarContents as $item)
                        <p class="header-top__text" data-s-break="1" data-s-length="1">
                            {{ __($item->data_values->text) }}
                        </p>
                    @endforeach
                </div>

                <div class="header-top__item three">
                    @if (gs('multi_language'))
                        @php
                            $languages = App\Models\Language::all();
                            $selectedLang = $languages->where('code', session('lang'))->first();
                        @endphp
                        <div class="dropdown dropdown--lang">
                            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                <img class="dropdown-flag"
                                     src="{{ getImage(getFilePath('language') . '/' . $selectedLang->image, getFileSize('language')) }}"
                                     alt="@lang('Language Flag')">
                                <span>{{ __($selectedLang->name) }}</span>
                            </button>

                            <div class="dropdown-menu">
                                @foreach ($languages as $lang)
                                    <a class="dropdown-item" href="{{ route('lang', $lang->code) }}">
                                        <img class="dropdown-flag"
                                             src="{{ getImage(getFilePath('language') . '/' . @$lang->image, getFileSize('language')) }}"
                                             alt="@lang('Language Flag')">
                                        <span>{{ __($lang->name) }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include($activeTemplate.'partials.header_responsive')
</header>
@push('script')
    <script>
        $(document).ready(function () {
            $('.header-top__text').each(function () {
                var $heading = $(this);
                var text = $heading.text().trim();
                var words = text.split(' ');

                var sBreakValue = parseInt($heading.data('s-break')) || 0;
                var sLengthValue = parseInt($heading.data('s-length')) || 1;


                var breakIndex = sBreakValue < 0 ? words.length + sBreakValue : sBreakValue;
                breakIndex = Math.max(0, Math.min(words.length, breakIndex));

                var endIndex = Math.min(words.length, breakIndex + sLengthValue);

                var coloredText = words.map(function (word, index) {
                    if (index >= breakIndex && index < endIndex) {
                        return '<span class="text--base">' + word + '</span>';
                    }
                    return word;
                }).join(' ');

                $heading.html(coloredText);
            });
        });
    </script>
@endpush

