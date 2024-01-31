<?php

namespace App\Livewire;

use App\Models\Content\Category\Category;
use App\Models\Content\Post\Post;
use App\Models\Media\Video\Video;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Livewire\Component;

class PostsFilter extends Component
{
    public $posts;
    public $perLoad = 18;
    public $selectedCategories = [];
    public $selectedVideos = [];

    /**
     * Runs once, immediately after the component is instantiated,
     * but before render() is called.
     * This is only called once on initial page load and never called again, even on component refreshes
     * @return void
     */
    public function mount()
    {
        // get products records
        $this->posts = Post::with('categories', 'videos')
            ->latest()
            ->take($this->perLoad)
            ->get();
    }


    public function updatedSelectedCategories()
    {
        $this->selectedCategories = Arr::where($this->selectedCategories, function ($value, $key) {
            return $value == true;
        });
    }

    public function updatedSelectedVideos()
    {
        $this->selectedVideos = Arr::where($this->selectedVideos, function ($value, $key) {
            return $value == true;
        });
    }

    public function filter()
    {
        $postsQuery = Post::with('categories', 'videos')
            ->when($this->selectedCategories, function (Builder $query) {
                $selectedCategories = array_keys($this->selectedCategories);
                $query->whereHas('categories', function ($query) use ($selectedCategories) {
                    $query->whereIn('categories.id', $selectedCategories);
                });
            })
            ->when($this->selectedVideos, function (Builder $query) {
                $selectedVideos = array_keys($this->selectedVideos);
                $query->whereHas('videos', function ($query) use ($selectedVideos) {
                    $query
                        ->where('videos.videoable_type', Post::class)
                        ->whereIn('videos.videoable_id', $selectedVideos);
                });
            });

        $this->posts = $postsQuery
            ->take($this->perLoad)
            ->get();

        return $postsQuery;
    }

    public function loadMore()
    {
        $morePosts = ($this->filter() ?? Post::with('categories', 'videos'))
            ->skip(count($this->posts))
            ->take($this->perLoad)
            ->get();

        $this->posts = $this->posts->concat($morePosts);
    }

    public function render()
    {
        $postCategories = Category::with('posts')
            ->whereHas('posts')
            ->get();
        
        $videos = Video::with('videoable')
            ->where('videoable_type', Post::class)
            ->get();

        return view('livewire.posts-filter', compact('postCategories', 'videos'));
    }
}
