@extends($activeTemplate.'layouts.master')
@section('content')
    <div class="dashboard-inner__block">
        <form class="register" method="post" enctype="multipart/form-data">
            @csrf
            <div class="dashboard-card">
                <div class="dashboard-card__header">
                    <div class="user-info">
                        <div class="user-info__thumb">
                            <img
                                src="{{ getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile')) }}"
                                alt="@lang('User Profile Image')">

                            <div class="user-thumb-edit">
                                <input class="d-none" type="file" name="image" accept=".png, .jpg, .jpeg"
                                       id="user-thumb-edit-input">

                                <label class="user-thumb-edit__btn" role="button" for="user-thumb-edit-input">
                                    <i class="fas fa-camera"></i>
                                </label>
                            </div>

                        </div>

                        <div class="user-info__content">
                            <h6 class="user-info__name">{{ __($user->fullName) }}</h6>
                            <span class="user-info__email">{{ $user->email }}</span>
                        </div>
                    </div>

                </div>
                <div class="dashboard-card__body">
                    <div class="row gy-3">
                        <div class="col-sm-6">
                            <label class="form-label form--label">@lang('First Name')</label>
                            <input class="form-control form--control" type="text" name="firstname"
                                   value="{{$user->firstname}}" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label form--label">@lang('Last Name')</label>
                            <input class="form-control form--control" type="text" name="lastname"
                                   value="{{$user->lastname}}" required>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label form--label">@lang('E-mail Address')</label>
                            <input class="form-control form--control" value="{{$user->email}}" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form--label">@lang('Mobile Number')</label>
                            <input class="form-control form--control" value="{{$user->mobile}}" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label form--label">@lang('Address')</label>
                            <input class="form-control form--control" type="text" name="address"
                                   value="{{@$user->address}}">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label form--label">@lang('State')</label>
                            <input class="form-control form--control" type="text" name="state"
                                   value="{{@$user->state}}">
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label form--label">@lang('Zip Code')</label>
                            <input class="form-control form--control" type="text" name="zip" value="{{@$user->zip}}">
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label form--label">@lang('City')</label>
                            <input class="form-control form--control" type="text" name="city" value="{{@$user->city}}">
                        </div>
                        <div class="col-sm-4">
                            <label class="form--label">@lang('Country')</label>
                            <input class="form-control form--control" value="{{@$user->country_name}}" disabled>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-12">
                            <button class="btn btn--lg btn--base btn--action w-100"
                                    type="submit">@lang('Submit')</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
