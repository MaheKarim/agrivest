<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <div class="image-upload">
                <div class="thumb">
                    <div class="avatar-preview">
                        <x-image-uploader image="{{ @$project->image }}" class="w-100" type="project" :required=false/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <label>@lang('Title')</label>
            <a href="javascript:void(0)" class="float-end buildSlug"><i class="las la-link"></i> @lang('Make Slug')</a>

            <input type="text" class="form-control" name="title" value="{{ old('title', @$project->title) }}" placeholder="@lang('Title')"
                   required>
        </div>
        <div class="form-group">
            <div class="d-flex justify-content-between">
                <label> @lang('Slug')</label>
                <div class="slug-verification d-none"></div>
            </div>
            <input type="text" class="form-control" name="slug" value="{{ old('slug', @$project->slug) }}" required>
        </div>
        <div class="form-group">
            <label>@lang('Project Goal')</label>
            <div class="input-group">
                <input type="number" class="form-control goal" name="goal" step="0" value="{{ old('goal', getAmount(@$project->goal)) }}"
                       placeholder="@lang('10000')" required>
                <span class="input-group-text">{{ gs('cur_text') }}</span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('Share Count')</label>
            <input type="number" class="form-control share_count" name="share_count" value="{{ old('share_count', getAmount(@$project->share_count)) }}"
                   placeholder="@lang('Share Count')" step="0" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('Share Amount')</label>
            <input type="number" class="form-control share_amount" name="share_amount"
                   value="{{ old('share_amount', getAmount(@$project->share_amount)) }}" step="0" placeholder="@lang('Share Amount')" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang("ROI (in %) ")</label>
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
            <label>@lang("ROI (in Amount)")</label>
            <div class="input-group">
                <input type="number" class="form-control roi_amount" name="roi_amount"
                       value="{{ old('roi_amount', getAmount(@$project->roi_amount)) }}" step="0" placeholder="@lang('ROI Amount')" required>
                <span class="input-group-text">{{ gs('cur_text') }}</span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>@lang('Start Date')</label>
            <input type="date" class="form-control start_date" name="start_date"
                   value="{{ old('start_date', @$project->start_date ?? '') }}" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>@lang('End Date')</label>
            <input type="date" class="form-control end_date" name="end_date"
                   value="{{ old('end_date', isset($project) ? $project->end_date : '') }}" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>@lang("Maturity Time")</label>
            <div class="input-group">
                <input type="number" class="form-control maturity_time" name="maturity_time"
                       value="{{ old('maturity_time', @$project->maturity_time) }}"
                       step="0" required>
                <span class="input-group-text">@lang('Months')</span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>@lang('Time')</label>
            <select class="form-control select2" name="time_id" data-search="false">
                <option value="" selected disabled>@lang('Select Time')</option>
                @foreach ($times as $time)
                    <option value="{{ $time->id }}" @selected(old('time_id', $project->time_id ?? null) == $time->id)>
                        {{ $time->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>@lang('Return Interval')</label>
            <div class="input-group">
                <input type="number" class="form-control return_interval" name="return_interval"
                       value="{{ old('return_interval', @$project->return_interval) }}" step="0" required>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>@lang('Return Timespan')</label>
            <div class="input-group">
                <input type="number" class="form-control return_timespan" name="return_timespan"
                       value="{{ old('return_timespan', @$project->return_timespan) }}" step="0" required>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('Google Map URL')</label>
            <input type="text" class="form-control" name="map_url" value="{{ old('map_url', @$project->map_url) }}" required>
        </div>
    </div>
   <div class="col-md-6">
       <div class="form-group">
           <label>@lang('Capital Back')</label>
           <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                  data-bs-toggle="toggle" data-on="@lang('Yes')" data-off="@lang('No')" name="capital_back"
                  value="1" @if(old('capital_back', @$project->capital_back)) checked @endif>
       </div>
   </div>
</div>
<div class="form-group">
    <label>@lang('Description')</label>
    <textarea rows="5" class="form-control nicEdit" name="description">{{ old('description', @$project->description) }}</textarea>
</div>
