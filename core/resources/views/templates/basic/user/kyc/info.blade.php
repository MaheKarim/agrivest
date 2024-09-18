@extends($activeTemplate . 'layouts.master')
@section('content')
    @if ($user->kyc_data)
        <ul class="list-group list-group-flush border rounded">
            @foreach ($user->kyc_data as $val)
                @continue(!$val->value)
                <li class="list-group-item flex-column p-3">
                    <small class="d-block">{{ __($val->name) }}</small>
                    <span class="fw-bold">
                        @if ($val->type == 'checkbox')
                            {{ implode(',', $val->value) }}
                        @elseif($val->type == 'file')
                            <a href="{{ route('user.download.attachment', encrypt(getFilePath('verify') . '/' . $val->value)) }}"
                                class="me-3"><i class="fa-regular fa-file"></i> @lang('Attachment') </a>
                        @else
                            {{ __($val->value) }}
                        @endif
                    </span>
                </li>
            @endforeach
        </ul>
    @else
        <h5 class="text-center">@lang('KYC data not found')</h5>
    @endif
@endsection

@push('style')
    <style>
        .list-group-item {
            border: 1px solid rgb(0 0 0 / 6%);
        }
    </style>
@endpush
