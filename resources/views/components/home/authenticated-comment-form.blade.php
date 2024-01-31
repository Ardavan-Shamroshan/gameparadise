@props([
    'model'
])

<form action="{{ route('content.comment.store') }}" method="post" id="commentform" {{ $attributes->class(['comment-form']) }}>
    @csrf

    <input type="hidden" name="commentable_type" value="{{ $model::class }}">
    <input type="hidden" name="commentable_id" value="{{ $model->id }}">

    <div class="flex justify-between">
        <fieldset class="name">
            <input type="text" id="name" placeholder="نام و نام خانوادگی*" class="style-1 border-gray" name="name" disabled tabindex="2" value="{{ auth()->user()->name }}" aria-required="true" required="">
        </fieldset>
        <fieldset class="email">
            <input type="email" id="email" placeholder="ایمیل*" class="style-1 border-gray" name="email" disabled tabindex="2" value="{{ auth()->user()->email }}" aria-required="true" required>
        </fieldset>
    </div>
    <fieldset class="message">
        <textarea id="message" name="body" rows="4" placeholder="دیدگاه شما*" class="style-1 border-gray m-0" tabindex="4" aria-required="true" required></textarea>
    </fieldset>
    <div class="btn-submit text-center">
        <button type="submit" class=" orange-btn">ثبت دیدگاه</button>
    </div>
</form>