@extends($activeTemplate.'layouts.frontend')
@section('content')
<section class="blogs py-120 bg--white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="custom">
                    <div class="justify-align-center">
                        <h5 class="title">{{ __($pageTitle) }}</h5>
                    </div>
                    <div class="body">
                        @php
                            echo $policy->data_values->details
                        @endphp
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
