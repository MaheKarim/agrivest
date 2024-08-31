@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.project.store', $project->id ?? null) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('admin.project.form')
                        <button type="submit" class="btn btn--primary w-100 h-45">
                            {{ isset($project) && $project->id ? __('Update Project') : __('Create Project') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.project.index') }}" />
@endpush
@push('style-lib')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/image-uploader.min.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/admin/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/daterangepicker.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/image-uploader.min.js') }}"></script>
@endpush

@push('script')
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                // Date ranger Start here
                $('input[name="start_date"],input[name="end_date"]').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 1950,
                    maxYear: parseInt(moment().format('YYYY'),10),
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                });
                // Image Uploader Gallery Start Here
                let preloaded = [];
                @if (!empty($galleries))
                    preloaded = @json($galleries);
                @endif
                console.log(); // Check if this logs the correct data

                $('.input-images').imageUploader({
                    preloaded: preloaded,
                    imagesInputName: 'gallery',
                    preloadedInputName: 'old',
                    maxFiles: 4
                });
                $(document).on('input', 'input[name="gallery[]"]', function() {
                    var fileUpload = $("input[type='file']");
                    if (parseInt(fileUpload.get(0).files.length) > 4) {
                        notify('error', 'You can only upload 4 images');
                    }
                });
                // TODO:: Not Less Than 0 Er Calculation No Finished
                // TODO:: Fraction Niye Kaj Korte Hbe
                // TODO:: Share Amount & Count Read Only Korte Hbe Sathe d-none Korte Hbe


                function clearIfGoalEmpty(goal) {
                    if (goal === '') {
                        $('.share_count, .share_amount').val('');
                        notify('error', 'Please enter project goal value first');
                        return true;
                    }
                    return false;
                }

                function calculateShareAmount(){
                    let goal = $('.goal').val().trim();
                    let shareCount = $('.share_count').val().trim();
                    let invalidInputPattern = /^-|\b0[0-9]/;

                    if (clearIfGoalEmpty(goal)) {
                        return;
                    }

                    if (invalidInputPattern.test(goal) || invalidInputPattern.test(shareCount)) {
                        notify('error','Please enter valid values');
                        return;
                    }

                    goal = parseFloat(goal);
                    shareCount = parseFloat(shareCount);

                    if (!isNaN(goal) && !isNaN(shareCount) && shareCount > 0) {
                        let shareAmount = Math.round(goal / shareCount);
                        if (shareAmount <= 0.00) {
                            notify('error', 'Share amount must be greater than 0');
                            $('.share_amount').val('');
                        } else {
                            $('.share_amount').val(shareAmount.toFixed(2));
                        }
                    } else {
                        $('.share_amount').val('');
                    }
                }

                $('.share_count, .goal').on('input', function(e) {
                    calculateShareAmount();
                });

                function calculateShareCount() {
                    let goal = $('.goal').val().trim();
                    let shareAmount = $('.share_amount').val().trim();
                    let invalidInputPattern = /^-|\b0[0-9]/;

                    if (clearIfGoalEmpty(goal)) {
                        return;
                    }

                    if (invalidInputPattern.test(goal) || invalidInputPattern.test(shareAmount)) {
                        notify('error','Please enter valid values');
                        return;
                    }

                    goal = parseFloat(goal);
                    shareAmount = parseFloat(shareAmount);

                    if (!isNaN(goal) && !isNaN(shareAmount) && shareAmount > 0) {
                        let shareCount = Math.round(goal / shareAmount);
                        if (shareCount <= 0.00) {
                            notify('error', 'Share count must be greater than 0');
                            $('.share_count').val('');
                        } else {
                            $('.share_count').val(shareCount.toFixed(2));
                        }
                    } else {
                        $('.share_count').val('');
                    }
                }

                $('.goal, .share_amount').on('input', function(e) {
                    calculateShareCount();
                });

                function calculateRoiAmount() {
                    let goal = $('.goal').val().trim();
                    let roi = $('.roi_percentage').val().trim();
                    let invalidInputPattern = /^-|\b0[0-9]/;


                    if (clearIfGoalEmpty(goal)) {
                        notify('error', 'Please enter project goal value first');
                    }
                    if (invalidInputPattern.test(roi)) {
                        notify('error', 'Please enter valid values');
                        return;
                    }

                    goal = parseFloat(goal);
                    roi = parseFloat(roi);
                    if (!isNaN(goal) && !isNaN(roi) && roi > 0) {
                        let roiAmount = (goal * roi) / 100;
                        if (roiAmount <= 0.00) {
                            notify('error', 'ROI amount must be greater than 0');
                            $('.roi_amount').val('');
                        } else {
                            $('.roi_amount').val(roiAmount.toFixed(2));
                        }
                    } else {
                        $('.roi_amount').val('');
                    }

                }

                $('.roi_percentage, .goal').on('input', function(e) {
                    calculateRoiAmount();
                });

                function calculateRoiPercentage() {
                    let goal = $('.goal').val().trim();
                    let roiAmount = $('.roi_amount').val().trim();
                    let invalidInputPattern = /^-|\b0[0-9]/;

                    if (clearIfGoalEmpty(goal)) {
                        notify('error', 'Please enter project goal value first');
                            return;
                    }
                    if (invalidInputPattern.test(roiAmount)) {
                        notify('error', 'Please enter valid values');
                        return;
                    }

                    goal = parseFloat(goal);
                    roiAmount = parseFloat(roiAmount);
                    if (!isNaN(goal) && !isNaN(roiAmount) && roiAmount > 0) {
                        let roiPercentage = (roiAmount * 100) / goal;
                        if (roiPercentage <= 0.00) {
                                notify('error', 'ROI percentage must be greater than 0');
                            $('.roi_percentage').val('');
                        } else {
                            $('.roi_percentage').val(roiPercentage.toFixed(2));
                        }
                    } else {
                        $('.roi_percentage').val('');
                    }
                }

                $('.roi_amount, .goal').on('input', function(e) {
                    calculateRoiPercentage();
                });

                // Slug Code
                $('.buildSlug').on('click', function() {
                    let closestForm = $(this).closest('form');
                    let title = closestForm.find('[name=title]').val();
                    closestForm.find('[name=slug]').val(title);
                    closestForm.find('[name=slug]').trigger('input');
                });

                $('[name=slug]').on('input', function() {
                    let closestForm = $(this).closest('form');
                    closestForm.find('[type=submit]').addClass('disabled')
                    let slug = $(this).val();
                    slug = slug.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                    $(this).val(slug);
                    if (slug) {
                        $('.slug-verification').removeClass('d-none');
                        $('.slug-verification').html(`
                        <small class="text--info"><i class="las la-spinner la-spin"></i> @lang('Checking')</small>
                    `);
                        $.get("{{ route('admin.project.check.slug') }}", {
                            slug: slug
                        }, function(response) {
                            if (!response.exists) {
                                $('.slug-verification').html(`
                                <small class="text--success"><i class="las la-check"></i> @lang('Available')</small>
                            `);
                                closestForm.find('[type=submit]').removeClass('disabled')
                            }
                            if (response.exists) {
                                $('.slug-verification').html(`
                                <small class="text--danger"><i class="las la-times"></i> @lang('Slug already exists')</small>
                            `);
                            }
                        });
                    } else {
                        $('.slug-verification').addClass('d-none');
                    }
                });
            });
        })(jQuery);
    </script>
@endpush

