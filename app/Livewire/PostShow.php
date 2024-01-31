<?php

namespace App\Livewire;

use App\Models\Content\Category\Category;
use App\Models\Content\Post\Post;
use Butschster\Head\Facades\Meta;
use Livewire\Component;

class PostShow extends Component
{
    public Post $post;
    public      $relatedPosts;
    public      $comments;
    public      $videos;
    public      $userPendingComments;
    public      $previousPost;
    public      $nextPost;

    public function mount()
    {
        Meta::setTitle($this->post->meta_title ?? $this->post->title)
            ->setDescription($this->post->meta_description);

        visitor()->visit($this->post);

        $this->post = $this->post
            ->load('categories', 'videos', 'comments')
            ->loadCount('comments');

        $this->relatedPosts = cache()->remember("post-{$this->post->slug}-related-posts", now()->addMinutes(30), function () {
            return $this->post->relatedPosts;
        });

        $this->videos = $this->post->videos()
            ->get();


        $this->comments = $this->post->comments()
            ->comment()
            ->approved()
            ->active()
            ->seen()
            ->get();

        $this->userPendingComments = $this->post->comments()
            ->where('user_id', auth()->id())
            ->pending()
            ->get();

        // get previous post
        $this->previousPost = Post::where('id', '<', $this->post->id)->first();

        // get next post
        $this->nextPost = Post::where('id', '>', $this->post->id)->first();
    }

    public function render()
    {
        $postCategories = Category::withCount('posts')
            ->whereHas('posts')
            ->get();

        return view('livewire.post-show', compact('postCategories'))
            ->layout('layouts.home.layout');
    }
}
