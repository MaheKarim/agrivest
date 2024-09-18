@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="col-md-12">
        <div class="dashboard-card">
            <div class="dashboard-card__body">
                <div class="table-responsive">
                    <table class="table table--responsive--sm">
                        <thead>
                            <tr>
                                <th>@lang('Subject')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Priority')</th>
                                <th>@lang('Last Reply')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($supports as $support)
                                <tr>
                                    <td>
                                        <div>
                                            <a href="{{ route('ticket.view', $support->ticket) }}" class="text--base fw-bold">
                                                [@lang('Ticket') #{{ $support->ticket }}] {{ __($support->subject) }}
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            @php echo $support->statusBadge; @endphp
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            @if ($support->priority == Status::PRIORITY_LOW)
                                                <span class="badge badge--dark">@lang('Low')</span>
                                            @elseif($support->priority == Status::PRIORITY_MEDIUM)
                                                <span class="badge badge--warning">@lang('Medium')</span>
                                            @elseif($support->priority == Status::PRIORITY_HIGH)
                                                <span class="badge badge--danger">@lang('High')</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            {{ diffForHumans($support->last_reply) }}
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{ route('ticket.view', $support->ticket) }}"
                                                class="btn btn--xsm btn--outline action-btn">
                                                <i class="las la-desktop"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%">
                                        <div class="text-center">{{ __($emptyMessage) }}</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{ paginateLinks($supports) }}
    </div>
@endsection
