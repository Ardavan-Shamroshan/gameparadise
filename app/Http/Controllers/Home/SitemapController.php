<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Spatie\Sitemap\SitemapGenerator;

class SitemapController extends Controller
{
    public function index()
    {
        $file = public_path("sitemap.xml");
        $url = config("app.url");

        SitemapGenerator::create($url)->configureCrawler(function ($crawler) {
            $crawler->ignoreRobots();
        })->writeToFile($file);

        return redirect('/sitemap.xml');
    }

    public function show()
    {
        return redirect('/sitemap.xml');
    }
}
