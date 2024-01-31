<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Butschster\Head\Facades\Meta;

class PostController extends Controller
{
    public function index()
    {
        Meta::setTitle('مقالات');

        return view('home.content.post.index');
    }
}
