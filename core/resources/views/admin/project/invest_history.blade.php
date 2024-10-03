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
                                    <th>@lang('Recurring Pay x Repeat Times')</th>
                                    <th>@lang('Paid')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($invests as $invest)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.project.edit', $invest->project->id) }}">
                                                {{ __($invest->project->title) }}
                                            </a>
                                        </td>
                                        <td>
                                            <span class="fw-bold">{{ $invest->user->fullname }}</span>
                                            <br>
                                            <span class="small"> <a
                                                    href="{{ route('admin.users.detail', $invest->user->id) }}"><span>@</span>{{ $invest->user->username }}</a>
                                            </span>
                                        </td>
                                        <td>{{ $invest->quantity }} @lang('Pcs')</td>
                                        <td>{{ $invest->project->return_type != Status::LIFETIME ? showAmount($invest->recurring_pay) . ' x ' . $invest->repeat_times : '---' }}
                                        </td>
                                        <td>{{ showAmount($invest->paid) }}</td>
                                        <td>
                                            @php echo $invest->statusBadge @endphp
                                        </td>
                                        <td>
                                           <div class="button-group">
                                               <a class="btn btn-outline--primary btn-sm"
                                                  href="{{ route('admin.invest.details', $invest->id) }}">
                                                   <i class="las la-desktop"></i>
                                                   @lang('Details')
                                               </a>
                                           </div>
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
    <x-back route="{{ route('admin.project.index') }}" />
@endpush
