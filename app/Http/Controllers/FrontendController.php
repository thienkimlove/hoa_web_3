<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Video;
use Backpack\Settings\app\Models\Setting;
use Illuminate\Http\Request;
use Watson\Sitemap\Facades\Sitemap;

class FrontendController extends Controller
{
    public function index()
    {
        $page = 'index';

        $meta = [];
        $meta['meta_title'] = Setting::get('meta_index_title');
        $meta['meta_desc'] = Setting::get('meta_index_desc');
        $meta['meta_keywords'] = Setting::get('meta_index_keywords');
        $meta['meta_image'] = url(Setting::get('website_logo_pc'));
        $meta['meta_url'] = url('/');

        return view('frontend.index', compact('page'))->with($meta);
    }

    public function tag($value)
    {
        $page = 'tag';
        $meta = [];


        $tag = Tag::findBySlug($value);

        if ($tag) {
            $meta_title = $tag->name;
            $meta_desc = "";
            $meta_keywords = "";

            $posts = Post::publish()
                ->whereHas('tags', function ($q) use ($tag) {
                    $q->where('id', $tag->id);
                })
                ->orderBy('updated_at', 'desc')
                ->paginate(10, ['*'], 'p');


            $meta['meta_title'] = $meta_title;
            $meta['meta_desc'] = $meta_desc;
            $meta['meta_keywords'] = $meta_keywords;
            $meta['meta_image'] = url(Setting::get('website_logo_pc'));
            $meta['meta_url'] =route('frontend.tag', $value);

            return view('frontend.tag', compact('posts', 'tag', 'page'))->with($meta);
        } else {
            redirect('/');
        }
    }

    public function search(Request $request)
    {
        $page = 'search';
        if ($request->filled('q')) {

            $keyword = $request->get('q');
            $posts = Post::publish()
                ->where('name', 'LIKE', '%' . $keyword . '%')
                ->paginate(10, ['*'], 'p');
            $posts->withPath('search?q='.$keyword);

            $meta = [];
            $meta['meta_title'] = 'Tìm kiếm cho từ khóa ' . $keyword;
            $meta['meta_desc'] = 'Tìm kiếm cho từ khóa ' . $keyword;
            $meta['meta_keywords'] = $keyword;
            $meta['meta_image'] = url(Setting::get('website_logo_pc'));
            $meta['meta_url'] = route('frontend.search');

            return view('frontend.search', compact('posts', 'keyword', 'page'))->with($meta);
        } else {
            return redirect('/');
        }
    }

    public function video($value = null)
    {
        $page = 'video';

        $meta = [];

        $meta['meta_title'] = Setting::get('meta_video_title');
        $meta['meta_desc'] = Setting::get('meta_video_desc');
        $meta['meta_keywords'] = Setting::get('meta_video_keywords');
        $meta['meta_image'] = url(Setting::get('website_logo_pc'));
        $meta['meta_url'] = route('frontend.video');

        $mainVideo = null;
        $videos = Video::latest('updated_at')->paginate(12, ['*'], 'p');
        $latestVideos = Video::latest('updated_at')->limit(5)->get();
        if ($videos->count() > 0) {
            $mainVideo = $videos->first();
        }

        if ($value) {
            $mainVideo = Video::findBySlug($value);
            if ($mainVideo) {
                $meta_title = $mainVideo->name;
                $meta_desc = $mainVideo->desc;
                $meta_keywords = "";

                $meta['meta_title'] = $meta_title;
                $meta['meta_desc'] = $meta_desc;
                $meta['meta_keywords'] = $meta_keywords;
                $meta['meta_url'] = route('frontend.video', $mainVideo->slug);
            } else {
                return redirect('/');
            }
        }

        return view('frontend.video', compact('videos', 'mainVideo', 'latestVideos', 'page'))->with($meta);

    }

    public function contact()
    {
        $page = 'lien-he';
        $meta = [];

        $meta['meta_title'] = Setting::get('meta_contact_title');
        $meta['meta_desc'] = Setting::get('meta_contact_desc');
        $meta['meta_keywords'] = Setting::get('meta_contact_keywords');
        $meta['meta_image'] = url(Setting::get('website_logo_pc'));
        $meta['meta_url'] = route('frontend.contact');


        return view('frontend.contact', compact('page'))->with($meta);
    }

    public function saveContact(Request $request)
    {
        $data = $request->all();
        $redirectUrl = null;

        if (isset($data['redirect_url'])) {
            $redirectUrl = $data['redirect_url'];
            unset($data['redirect_url']);
        }

        if (!empty($data['name']) && !empty($data['email']) && !empty($data['content']) && !empty($data['phone'])) {

            Contact::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'content' => $data['content'],
                'status' => 0
            ]);
        } else {
            //\Log::info($data);
        }


        if ($redirectUrl) {
            return redirect()->to($redirectUrl.'?success=1');
        }

        return redirect('/');

    }

    public function main($value)
    {

        if (preg_match('/([a-z0-9\-]+)\.html/', $value, $matches)) {

            $post = Post::findBySlug($matches[1]);
            if ($post) {
                $post->update(['views' => (int) $post->views + 1]);

                $latestNews = Post::publish()
                    ->where('category_id', $post->category_id)
                    ->where('id', '!=', $post->id)
                    ->latest('updated_at')
                    ->limit(6)
                    ->get();

                $page = $post->category->slug;

                $meta = [];


                $meta['meta_title'] = $post->name;
                $meta['meta_desc'] = $post->desc;
                $meta['meta_keywords'] = ($post->tagList) ? implode(',', $post->tagList) : null;
                $meta['meta_image'] = url($post->image);
                $meta['meta_url'] = route('frontend.main', $post->slug.'.html');

                return view('frontend.post', compact('post', 'latestNews', 'page'))->with($meta);
            } else {
                return redirect('/');
            }
        } else {
            $category = Category::findBySlug($value);

            if ($category) {

                $cateIds = ($category->children->count() > 0) ? $category->children->pluck('id')->all() : [$category->id];

                $posts = Post::publish()
                    ->whereIn('category_id', $cateIds)
                    ->latest('updated_at')
                    ->paginate(10, ['*'], 'p');

                $page = $category->slug;

                $meta = [];

                $meta['meta_title'] = $category->name;
                $meta['meta_desc'] = $category->desc;
                $meta['meta_keywords'] = "";
                $meta['meta_image'] = url(Setting::get('website_logo_pc'));
                $meta['meta_url'] = route('frontend.main', $category->slug);

                return view('frontend.category', compact(
                    'category', 'posts', 'page'
                ))->with($meta);
            } else {
                return redirect('/');
            }
        }
    }

    #Sitemap
    public function sitemap()
    {
        Sitemap::addSitemap(route('frontend.site_maps_posts'));
        Sitemap::addSitemap(route('frontend.site_maps_categories'));

        return Sitemap::index();

    }

    public function siteMapsPosts()
    {
        $contents = Post::all();
        foreach ($contents as $content) {
            Sitemap::addTag(url($content->slug.'.html'), $content->updated_at, 'daily', '0.8');
        }
        return Sitemap::render();
    }

    public function siteMapsCategories()
    {
        $contents = Category::where('status', true)->get();
        foreach ($contents as $content) {
            Sitemap::addTag(url($content->slug), $content->updated_at, 'weekly', '0.4');
        }
        return Sitemap::render();
    }
}
