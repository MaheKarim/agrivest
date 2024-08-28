@php
    $brandContent = getContent('brand.element', orderById: true);
@endphp
<section class="brands py-60 bg--white">
    <div class="container">
        <div class="brands-slider">
            @foreach ($brandContent as $element)
                <div class="brands-slider__item">
                    <img src="{{ frontendImage('brand', $element->data_values->image, '140x40') }}"
                         alt="@lang('Brand Image')">
                </div>
            @endforeach
        </div>
    </div>
</section>
