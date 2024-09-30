@extends($activeTemplate.'layouts.frontend')
@section('content')
    @include($activeTemplate.'partials.breadcrumb')
    <section class="blogs py-60 bg--white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="random-card">
                        <div class="dashboard-card__body">
                            @php
                                echo $cookie->data_values->description
                            @endphp
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
