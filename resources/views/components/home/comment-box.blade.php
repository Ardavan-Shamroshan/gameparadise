@props([
    'comment',
    'pending' => false
])

<li {{ $attributes->class(['comment-box border-gray']) }}>
    @if($comment->user->profile_photo_path)
        <img src="{{ asset($comment->user->profile_photo_path) }}" alt="{{ $comment->user->name ?? '' }}">
    @endif

    <div class="comment-right w-100">
        <div class="top flex justify-between items-center">
            <div class="info">
                <h2>{{ $comment->user->name ?? '' }}</h2>
            </div>
            <span>{{ jalaliDate($comment->created_at) }} </span>
        </div>
        <p>{!! $comment->body ?? '' !!}</p>

        @if($pending)
            <span class="text text-warning" class="border-gray-light rounded-5 tf-btn"> <i class="fa fa-clock"></i> در انتظار بررسی </span>
        @else
            <a href="#" data-toggle="modal" data-target="#reply-to-comment-{{ $comment->id }}" class="border-gray-light rounded-5 tf-btn tf-btn-fill"><span>پاسخ</span></a>
        @endif
    </div>
</li>

<div class="modal fade popup" id="reply-to-comment-{{ $comment->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <form action="{{ route('content.comment.reply', $comment) }}" method="POST">
                @csrf
                <div class="modal-body border-gray">
                    <h2> پاسخ به دیدگاه {{ $comment->user->name ?? '' }}</h2>
                    <p>{{ $comment->body }}</p>
                    <fieldset class="message mx-0">
                        <textarea id="message-replay" name="body" rows="4" placeholder="پاسخ شما*" class="style-1 m-0 border-gray" tabindex="4" aria-required="true" required></textarea>
                    </fieldset>
                    <button type="submit" class="bg-primary border-gray h-25 text-white tf-btn tf-button w-100">پاسخ</button>
                </div>
            </form>
        </div>
    </div>
</div>