<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MediaLink;
use App\Models\AboutImage;
use App\Models\Blog;


class MediaPageController extends Controller
{
public function index(){

 $mediaLinks=MediaLink::all();
 $images=AboutImage::first();

 return view('media.videos',compact('images','mediaLinks'));
}
public function pressRelease(){
    $blogs = Blog::latest()->get();
    $categories = Blog::select('category')->distinct()->get();
    return view ('media.press-releases',compact('blogs','categories'));
}
public function showDetails($slug)
{

    $blog = Blog::where('slug', $slug)->firstOrFail();

 if (is_string($blog->content_images)) {
    $blog->content_images = json_decode($blog->content_images, true);
}
    return view('media.press-release-details', compact('blog'));
}

}
