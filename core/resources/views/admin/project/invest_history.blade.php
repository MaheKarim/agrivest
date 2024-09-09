@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th>@lang('Project Name')</th>
                                <th>@lang('User')</th>
                                <th>@lang('Quantity')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Recurring Pay x Repeat Times')</th>
                                <th>@lang('Paid')</th>
                                <th>@lang('Status')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($invests as $invest)
                                <tr>
                                    <td>{{ __($invest->project->title) }}</td>
                                    <td>
                                        <span class="fw-bold">{{ $invest->user->fullname }}</span>
                                        <br>
                                        <span class="small"> <a
                                                href="{{ route('admin.users.detail', $invest->user->id) }}"><span>@</span>{{ $invest->user->username }}</a>
                                            </span>
                                    </td>
                                    <td>{{ $invest->quantity }} @lang('Pcs')</td>
                                    <td>{{ showAmount($invest->total_earning) }}</td>
                                    <td>{{ $invest->return_type != -1 ? showAmount($invest->recuring_pay ) . ' x ' . ($invest->repeat_times) : '**' }}</td>
                                    <td>{{ showAmount($invest->paid) }}</td>
                                    <td>
                                        @php echo $invest->statusBadge @endphp
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($invests->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($invests) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.project.index') }}"/>
@endpush
