@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th>@lang('Title')</th>
                                <th>@lang('Goal')</th>
                                <th>@lang('Start Date - End Date')</th>
                                <th>@lang('Share Count - Share Amount')</th>
                                <th>@lang('ROI % - ROI Amount')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($projects as $project)
                                <tr>
                                    <td>
                                        <div class="user">
                                            <div class="thumb"><img src="{{ getImage(getFilePath('project') .'/'. $project->image,getFileSize('project')) }}" alt="{{ __($project->title) }}" class="plugin_bg"></div>
                                            <span class="name">{{ __(Str::limit($project->title, 20)) }}</span>
                                        </div>
                                    </td>

                                    <td>
                                        {{ showAmount($project->goal) }}
                                    </td>
                                    <td>
                                        {{ showDateTime($project->start_date) }}
                                        <br>
                                        {{ showDateTime($project->end_date) }}
                                    </td>
                                    <td>
                                        {{ getAmount($project->share_count) }}
                                        <br>
                                        {{ showAmount($project->share_amount) }}
                                    </td>
                                    <td>
                                        {{ showAmount($project->roi_percentage) }} %
                                        <br>
                                        {{ showAmount($project->roi_amount) }}
                                    </td>
                                    <td>
                                        @php echo $project->statusBadge @endphp
                                    </td>
                                    <td>
                                        <div class="button--group">
                                            <a href="{{ route('admin.project.edit', $project->id) }}" class="btn btn-sm btn-outline--primary">
                                                <i class="las la-pen"></i> @lang('Edit')
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
                @if ($projects->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($projects) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Title" />
    <a class="btn btn-sm btn-outline--primary"  href="{{ route('admin.project.create') }}" type="button"><i
                class="las la-plus"></i> @lang('Add New')</a>
@endpush
