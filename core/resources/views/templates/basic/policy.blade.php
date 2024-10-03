@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="blogs py-60 bg--white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="custom">
                        <div class="body offer-details-desc">
                            @php
                                echo $policy->data_values->details;
                            @endphp
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
