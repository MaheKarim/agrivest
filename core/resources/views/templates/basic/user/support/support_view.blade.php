<div class="row">
    <div class="col-md-12">
        <div class="card custom--card">
            <div class="card-header card-header-bg d-flex flex-wrap justify-content-between align-items-center">
                <h6 class="text-black mb-0">
                    @php echo $myTicket->statusBadge; @endphp
                    [@lang('Ticket')#{{ $myTicket->ticket }}] {{ $myTicket->subject }}
                </h6>
                @if ($myTicket->status != Status::TICKET_CLOSE && $myTicket->user)
                    <button class="confirmationBtn border-0" type="button" data-question="@lang('Are you sure to close this ticket?')"
                        data-action="{{ route('ticket.close', $myTicket->id) }}" style="font-size: 1.2rem;">
                        <i class="fas fa-lg fa-times-circle text-danger"></i>
                    </button>
                @endif
            </div>
            <div class="card-body">
                <form method="post" class="disableSubmission" action="{{ route('ticket.reply', $myTicket->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row justify-content-between">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea name="message" class="form-control form--control" rows="4" required>{{ old('message') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <button type="button" class="btn btn-dark btn-sm addAttachment my-2"><i
                                    class="fas fa-plus"></i> @lang('Add Attachment') </button>
                            <p class="mb-2"><span class="text--base">@lang('Max 5 files can be uploaded | Maximum upload size is ' . convertToReadableSize(ini_get('upload_max_filesize')) . ' | Allowed File Extensions: .jpg, .jpeg, .png, .pdf, .doc, .docx')</span>
                            </p>
                            <div class="row fileUploadsContainer">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn--base w-100 my-2" type="submit"><i
                                    class="la la-fw la-lg la-reply"></i> @lang('Reply')
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        <div class="mt-4">
            @forelse($messages as $message)
                @if ($message->admin_id == 0)
                    <div class="message-container user-message">
                        <div class="message-header d-flex justify-content-between align-items-center">
                            <h6 class="user-name">{{ $message->ticket->name }}</h6>
                            <p class="message-time mb-0">
                                @lang('Posted on') {{ showDateTime($message->created_at, 'l, dS F Y @ h:i a') }}
                            </p>
                        </div>
                        <div class="message-content">
                            <p>{{ $message->message }}</p>
                            @if ($message->attachments->count() > 0)
                                <div class="attachments">
                                    @foreach ($message->attachments as $k => $image)
                                        <a href="{{ route('ticket.download', encrypt($image->id)) }}"
                                            class="attachment-link text--base">
                                            <i class="fa-regular fa-file"></i> @lang('Attachment') {{ ++$k }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="message-container staff-message">
                        <div class="message-header d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="staff-name">{{ $message->admin->name }}</h6>
                            </div>
                            <p class="message-time mb-0">
                                @lang('Posted on') {{ showDateTime($message->created_at, 'l, dS F Y @ h:i a') }}
                            </p>
                        </div>
                        <div class="message-content">
                            <p>{{ $message->message }}</p>
                            @if ($message->attachments->count() > 0)
                                <div class="attachments">
                                    @foreach ($message->attachments as $k => $image)
                                        <a href="{{ route('ticket.download', encrypt($image->id)) }}"
                                            class="attachment-link text--base">
                                            <i class="fa-regular fa-file"></i> @lang('Attachment')
                                            {{ ++$k }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            @empty
                <div class="empty-message">
                    <img src="{{ asset('assets/images/empty_list.png') }}" alt="empty">
                    <h5>@lang('No replies found here!')</h5>
                </div>
            @endforelse
        </div>

        <style>
            .message-container {
                margin-bottom: 20px;
                padding: 15px;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .user-message {
                background-color: #f0f8ff;
                border-left: 4px solid #007bff;
                margin-right: auto;
                margin-left: 0;
                width: 80%;
            }

            .staff-message {
                background-color: #fff5e6;
                border-right: 4px solid #ffa500;
                margin-left: auto;
                margin-right: 0;
                width: 80%;
            }

            .message-header {
                margin-bottom: 10px;
            }

            .user-name,
            .staff-name {
                margin: 0;
                color: #333;
                font-size: 0.9em;
            }

            .staff-title {
                margin: 0;
                color: #666;
                font-style: italic;
            }

            .message-time {
                font-size: 0.8em;
                color: #777;
            }

            .message-content p {
                margin-bottom: 10px;
            }

            .attachments {
                margin-top: 10px;
            }

            .attachment-link {
                display: inline-block;
                margin-right: 10px;
                color: #007bff;
                text-decoration: none;
            }

            .attachment-link:hover {
                text-decoration: underline;
            }

            .empty-message {
                text-align: center;
                padding: 20px;
            }

            .empty-message img {
                max-width: 200px;
                margin-bottom: 15px;
            }

            .empty-message h5 {
                color: #777;
            }
        </style>


    </div>
</div>
