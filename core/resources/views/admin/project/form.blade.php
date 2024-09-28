<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <div class="image-upload">
                <div class="thumb">
                    <div class="avatar-preview">
                        <x-image-uploader image="{{ @$project->image }}" class="w-100" type="project" :required=false />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <label>@lang('Title')</label>
            <a href="javascript:void(0)" class="float-end buildSlug"><i class="las la-link"></i> @lang('Make Slug')</a>

            <input type="text" class="form-control" name="title" value="{{ old('title', @$project->title) }}"
                placeholder="@lang('Title')" required>
        </div>
        <div class="form-group">
            <div class="d-flex justify-content-between">
                <label> @lang('Slug')</label>
                <div class="slug-verification d-none"></div>
            </div>
            <input type="text" class="form-control" name="slug" value="{{ old('slug', @$project->slug) }}"
                required>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        @lang('Project Goal')
                        <i class="las la-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="The total amount of funding the project aims to raise. This is the target amount needed to achieve the project's objectives."></i>
                    </label>
                    <div class="input-group">
                        <input type="number" class="form-control goal" name="goal" step="0"
                            value="{{ old('goal', getAmount(@$project->goal)) }}" placeholder="@lang('10000')"
                            required>
                        <span class="input-group-text">{{ gs('cur_text') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        @lang('Featured')
                        <i class="las la-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Highlighted or special investment opportunities."></i>
                    </label>
                    <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                        data-bs-toggle="toggle" data-on="@lang('Yes')" data-off="@lang('No')" name="featured"
                        value="1" @if (old('featured', @$project->featured)) checked @endif>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>
                @lang('Share Count')
                <i class="las la-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="The total number of shares available for investment in this project. This represents how many shares are needed to reach the project goal."></i>
            </label>
            <input type="number" class="form-control share_count" name="share_count"
                value="{{ isset($project) ? getAmount($project->share_count) : old('share_count') }}"
                {{ isset($project) ? 'disabled' : '' }} placeholder="@lang('Share Count')" step="0" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>
                @lang('Share Amount')
                <i class="las la-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="The cost of each share in the project. The total project goal is calculated by multiplying the Share Count by the Share Amount."></i>
            </label>
            <div class="input-group">
                <input type="number" class="form-control share_amount" name="share_amount"
                    value="{{ old('share_amount', getAmount(@$project->share_amount)) }}" step="0"
                    placeholder="@lang('Share Amount')" required>
                <span class="input-group-text">{{ gs('cur_text') }}</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>
                @lang('ROI (in %) ')
                <i class="las la-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="The expected percentage return on investment."></i>
            </label>
            <div class="input-group">
                <input type="number" class="form-control roi_percentage" name="roi_percentage"
                    value="{{ old('roi_percentage', getAmount(@$project->roi_percentage)) }}"
                    placeholder="@lang('ROI percentage')" step="0" required>
                <span class="input-group-text">@lang('%')</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>
                @lang('ROI (in Amount)')
                <i class="las la-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="The projected monetary return from the investment."></i>
            </label>
            <div class="input-group">
                <input type="number" class="form-control roi_amount" name="roi_amount"
                    value="{{ old('roi_amount', getAmount(@$project->roi_amount)) }}" step="0"
                    placeholder="@lang('ROI Amount')" required>
                <span class="input-group-text">{{ gs('cur_text') }}</span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>
                @lang('Start Date')
                <i class="las la-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="The date when the investment project begins."></i>
            </label>
            <input type="text" class="form-control start_date" name="start_date"
                value="{{ old('start_date', @$project->start_date ?? '') }}" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>
                @lang('End Date')
                <i class="las la-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="The date when the investment project concludes."></i>
            </label>
            <input type="text" class="form-control end_date" name="end_date"
                value="{{ old('end_date', isset($project) ? $project->end_date : '') }}" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>
                @lang('Maturity Time')
                <i class="las la-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Users will begin to receive their investment returns after the maturity period. The maturity time is calculated from the project's end date. It is the total duration from the end date plus the specified maturity time."></i>
            </label>
            <div class="input-group">
                <input type="number" class="form-control maturity_time" name="maturity_time"
                    value="{{ old('maturity_time', @$project->maturity_time) }}" step="0" required>
                <span class="input-group-text">@lang('Months')</span>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-4 return-type-wrapper">
        <label>
            @lang('Return Type')
            <i class="las la-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                title="The form in which the returns are provided."></i>
        </label>
        <select class="form-control select2" name="return_type" data-search="false" required>
            <option value="" selected disabled>@lang('Select Return Type')</option>
            <option value="-1" @selected(old('return_type', @$project->return_type) == -1 ? 'selected' : '')>@lang('Lifetime')</option>
            <option value="2" @selected(old('return_type', @$project->return_type) == 2 ? 'selected' : '')>@lang('Repeat')</option>
        </select>
    </div>
    <div class="col-md-4 time-settings-wrapper">
        <div class="form-group">
            <label>
                @lang('Time')
                <i class="las la-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="The specific timeframe for receiving returns."></i>
            </label>
            <select class="form-control select2" name="time_id" data-search="false" required>
                <option value="" selected disabled>@lang('Select Time')</option>
                @foreach ($times as $time)
                    <option value="{{ $time->id }}" @selected(old('time_id', $project->time_id ?? null) == $time->id)>
                        {{ $time->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4 project_duration">
        <div class="form-group">
            <label>
                @lang('Project Duration')
                <i class="las la-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="For a lifetime return, how many months will the interest be paid"></i>
            </label>
            <div class="input-group">
                <input type="number" class="form-control project_duration" name="project_duration"
                    value="{{ old('project_duration', @$project->project_duration) }}" step="0" required>
                <span class="input-group-text">@lang('Months')</span>

            </div>
        </div>
    </div>
    <div class="col-md-4 return_timespan">
        <div class="form-group">
            <label>
                @lang('Return Repeat Times')
                <i class="las la-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="The number of times returns will be repeated."></i>
            </label>
            <div class="input-group">
                <input type="number" class="form-control return_timespan" id="repeat_times" name="repeat_times"
                    value="{{ old('repeat_times', @$project->repeat_times) }}" step="0">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>@lang('Category')</label>
            <select class="form-control select2" name="category_id" data-search="true" required>
                <option value="" selected disabled>@lang('Select Category')</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $project->category_id ?? null) == $category->id)>
                        {{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>
                @lang('Google Map Embed URL')
                <i class="las la-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="URL for embedding the project's location on Google Maps."></i>
            </label>
            <input type="url" class="form-control" name="map_url"
                value="{{ old('map_url', @$project->map_url) }}" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>
                @lang('Capital Back')
                <i class="las la-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Indicates if the invested capital is returned after maturity."></i>
            </label>
            <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                data-bs-toggle="toggle" data-on="@lang('Yes')" data-off="@lang('No')"
                name="capital_back" value="1" @if (old('capital_back', @$project->capital_back)) checked @endif>
        </div>
    </div>
</div>
<div class="form-group">
    <label>@lang('Description')</label>
    <textarea rows="5" class="form-control nicEdit" name="description">{{ old('description', @$project->description) }}</textarea>
</div>
<div class="form-group">
    <div class="image-uploader-wrapper">
        <div class="gallery-uploader">
            <label class="form-label required">@lang('Gallery Image :') </label>
            <div class="input-field">
                <div class="input-images"></div>
                <small class="form-text text-muted">
                    <label><i class="las la-info-circle"></i> @lang('You can upload up to 4 images. For the best design result, it\'s recommended to upload all 4 images').</label>
                    @lang('Supported Files:')
                    <b>@lang('.png, .jpg, .jpeg')</b>
                    @lang('Image will be resized into') <b>{{ getFileSize('project') }}</b>@lang('px')
                </small>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
