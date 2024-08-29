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
                                <th>@lang('Name')</th>
                                <th>@lang('Hours')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Created At')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($times as $time)
                                <tr>
                                    <td>{{ __($time->name) }}</td>
                                    <td>{{ __($time->hours) }}</td>
                                    <td>@php echo $time->statusBadge @endphp</td>
                                    <td>{{ showDateTime($time->created_at) }}</td>
                                    <td>
                                        <div class="button-group">
                                            <button class="btn btn-outline--primary cuModalBtn btn-sm editBtn"
                                                    data-modal_title="@lang('Edit time')"
                                                    data-resource="{{ $time }}"
                                            >
                                                <i class="las la-pen"></i>@lang('Edit')
                                            </button>

                                            @if ($time->status == Status::ENABLE)
                                                <button
                                                    class="btn btn-sm btn-outline--danger ms-1 confirmationBtn"
                                                    data-question="@lang('Are you sure to disable this time?')"
                                                    data-action="{{ route('admin.time.status',$time->id) }}">
                                                    <i class="la la-eye-slash"></i> @lang('Disable')
                                                </button>
                                            @else
                                                <button
                                                    class="btn btn-sm btn-outline--success ms-1 confirmationBtn"
                                                    data-question="@lang('Are you sure to enable this time?')"
                                                    data-action="{{ route('admin.time.status',$time->id) }}">
                                                    <i class="la la-eye"></i> @lang('Enable')
                                                </button>
                                            @endif
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
                @if ($times->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($times) }}
                    </div>
                @endif
            </div>
        </div>
    </div>


    <!-- Confirmation Modal Start -->
    <div class="modal fade" id="cuModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span class="type"></span> <span>@lang('Add Time')</span></h5>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>

                <form method="POST" action="{{ route('admin.time.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang(' Name')</label>
                            <input name="name" type="text" class="form-control bg--white pe-2"
                                   placeholder="@lang(' Name')" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label>@lang('Time in Hours')</label>
                            <div class="input-group">
                            <input name="hours" type="text" class="form-control bg--white pe-2"
                                   placeholder="@lang('Hours')" autocomplete="off" required>
                                <span class="input-group-text">@lang('Hours')</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn--primary h-45 w-100" type="submit">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-confirmation-modal/>
@endsection
@push('breadcrumb-plugins')
    <x-search-form placeholder="Search here..." />
    <button class="btn btn-sm btn-outline--primary float-sm-end cuModalBtn addBtn"
            data-modal_title="@lang('Create New Time')" type="button">
        <i class="las la-plus"></i>@lang('Add New')</button>
@endpush
@push('script-lib')
    <script src="{{ asset('assets/global/js/cu-modal.js') }}"></script>
@endpush
