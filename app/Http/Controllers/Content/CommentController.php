<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Content\ReplyCommentRequest;
use App\Http\Requests\Content\StoreCommentRequest;
use App\Models\Content\Comment\Comment;
use App\Models\User;
use App\Nova\Content\CommentNovaResource;
use Laravel\Nova\Notifications\NovaNotification;
use Laravel\Nova\URL;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        $validated['approved'] = 'pending';
        $validated['status'] = false;
        $validated['seen'] = false;

        $comment = Comment::create($validated);

        $message = ' کاربر ' . auth()->user()->name . ' یک دیدگاه ثبت کرده است. ';
        $adminUsers = User::query()->admin()->get();
        foreach ($adminUsers as $admin) {
            $admin->notify(
                NovaNotification::make()
                    ->message($message)
                    ->action('نمایش', URL::remote(url(sprintf(config('nova.path') . '/resources/%s/%d', CommentNovaResource::uriKey(), $comment->id))))
                    ->icon('check-circle')
                    ->type('info')
            );
        }

        alert()->success('دیدگاه شما با موفقیت ثبت شد.', 'پس از تایید توسط سردبیر، دیدگاه شما نمایش داده خواهد شد.');
        return back();
    }

    public function reply(ReplyCommentRequest $request, Comment $comment)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        $validated['parent_id'] = $comment->id;
        $validated['commentable_type'] = $comment->commentable_type;
        $validated['commentable_id'] = $comment->commentable_id;
        $validated['approved'] = 'pending';
        $validated['status'] = false;
        $validated['seen'] = false;

        $comment = Comment::create($validated);

        $message = ' کاربر ' . auth()->user()->name . ' به یک دیدگاه پاسخ داده است. ';
        $adminUsers = User::query()->admin()->get();
        foreach ($adminUsers as $admin) {
            $admin->notify(
                NovaNotification::make()
                    ->message($message)
                    ->action('نمایش', URL::remote(url(sprintf(config('nova.path') . '/resources/%s/%d', CommentNovaResource::uriKey(), $comment->id))))
                    ->icon('check-circle')
                    ->type('info')
            );
        }

        alert()->success('پاسخ شما با موفقیت ثبت شد.', 'پس از تایید توسط سردبیر، پاسخ شما نمایش داده خواهد شد.');
        return back();
    }
}
