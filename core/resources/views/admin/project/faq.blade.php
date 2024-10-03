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
                                    <th>@lang('Question')</th>
                                    <th>@lang('Answer')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Created At')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($faqs as $faq)
                                    <tr>
                                        <td>{{ __($faq->question) }}</td>
                                        <td>{{ __(Str::limit($faq->answer, 35)) }}</td>
                                        <td>@php echo $faq->statusBadge @endphp</td>
                                        <td>{{ showDateTime($faq->created_at) }}</td>
                                        <td>
                                            <div class="button-group">
                                                <button class="btn btn-outline--primary cuModalBtn btn-sm editBtn"
                                                    data-modal_title="@lang('Edit FAQ')" data-resource="{{ $faq }}">
                                                    <i class="las la-pen"></i>@lang('Edit')
                                                </button>

                                                @if ($faq->status == Status::ENABLE)
                                                    <button class="btn btn-sm btn-outline--danger ms-1 confirmationBtn"
                                                        data-question="@lang('Are you sure to disable this faqs?')"
                                                        data-action="{{ route('admin.project.faq.status', $faq->id) }}">
                                                        <i class="la la-eye-slash"></i> @lang('Disable')
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm btn-outline--success ms-1 confirmationBtn"
                                                        data-question="@lang('Are you sure to enable this faqs?')"
                                                        data-action="{{ route('admin.project.faq.status', $faq->id) }}">
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
                @if ($faqs->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($faqs) }}
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
                    <h5 class="modal-title"><span class="type"></span> <span>@lang('Add FAQ')</span></h5>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>

                <form method="POST" action="{{ route('admin.project.faq.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="project_id" id="formMethod" value="{{ $project->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Question')</label>
                            <input name="question" type="text" class="form-control bg--white pe-2"
                                placeholder="@lang('Question')" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label>@lang('Answer')</label>
                            <textarea name="answer" type="text" class="form-control bg--white pe-2" placeholder="@lang('Answer')"
                                autocomplete="off" required>
                            </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn--primary h-45 w-100" type="submit">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-confirmation-modal />
@endsection
@push('breadcrumb-plugins')
    <x-search-form placeholder="Search here..." />
    <button class="btn btn-sm btn-outline--primary float-sm-end cuModalBtn addBtn" data-modal_title="@lang('Create Faq')"
        type="button">
        <i class="las la-plus"></i>@lang('Add New')</button>
    <x-back route="{{ route('admin.project.index') }}" />
@endpush
@push('script-lib')
    <script src="{{ asset('assets/global/js/cu-modal.js') }}"></script>
@endpush
