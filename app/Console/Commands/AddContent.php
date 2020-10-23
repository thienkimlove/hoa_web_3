<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AddContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:content';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::table('categories')->truncate();
        DB::table('posts')->truncate();
        DB::table('tags')->truncate();
        DB::table('videos')->truncate();

        for ($i = 1; $i< 5; $i++) {
            Category::create([
                'name' => 'Chuyên mục '.$i,
                'desc' => 'Mô tả chi tiết cho Chuyên mục '.$i,
                'parent_id' => null,
            ]);
        }

        for ($i = 1; $i< 6; $i++) {
            Tag::create([
                'name' => 'Từ khóa '.$i
            ]);
        }

        $categories = Category::pluck('id')->all();

        foreach ($categories as $categoryId) {
            for ($i = 1; $i< 3; $i++) {
                Category::create([
                    'name' => 'Chuyên mục con '.$i.' của '.$categoryId,
                    'parent_id' => $categoryId,
                    'desc' => 'Mô tả Chuyên mục con '.$i.' của '.$categoryId,
                ]);
            }
        }
        foreach (Category::whereNotNull('parent_id')->get() as $childCate)
        {
            for ($i = 1; $i< 16; $i++) {
               $post =  Post::create([
                    'name' => 'Bài viết '.$i.' của '.$childCate->id,
                    'category_id' => $childCate->id,
                    'desc' => 'Mô tả bài viết '.$i.' của '.$childCate->id,
                    'content' => 'Đặc biệt khả năng cân đối, bố trí nguồn vốn ngân sách cho đầu tư kết cấu hạ tầng giao thông mới chỉ đáp ứng được khoảng 20% so với nhu cầu thực tế, 80% là huy động từ các nguồn xã hội hoá (PPP), ODA...

Có thể nói một trong những khó khăn lớn nhất hiện nay là việc huy động và sử dụng hiệu quả vốn đầu tư cho hạ tầng giao thông. Thiếu vốn hay sử dụng vốn không linh hoạt, hợp lý là những nguyên nhân chủ yếu làm chậm bước phát triển kết cấu hạ tầng giao thông thủ đô.

-Trong giai đoạn tới, Hà Nội sẽ tập trung phát triển hạ tầng như thế nào?

- Để tạo nền tảng cho phát triển kinh tế xã hội thì kết cấu hạ tầng giao thông vận tải phải đi trước một bước. Trong 5 năm tới, kết cấu hạ tầng giao thông mà Hà Nội tập trung đầu tư các tuyến đường, công trình giao thông khung kết nối khu vực đô thị trung tâm với năm đô thị vệ tinh.',
                    'image' => 'uploads/1.png',
                   'is_focus_index' => true,
                   'is_highlight_index' => true,

                ]);

              DB::table('post_tag')->insert([
                  'post_id' => $post->id,
                  'tag_id' => rand(1, 2)
              ]);
                DB::table('post_tag')->insert([
                    'post_id' => $post->id,
                    'tag_id' => rand(3, 5)
                ]);
            }
        }

        Video::create([
            'name' => 'Video Song gio',
            'desc' => 'Video Song gio',
            'link' => 'https://www.youtube.com/watch?v=j8U06veqxdU'
        ]);

        Video::create([
            'name' => 'Video Bac phan',
            'desc' => 'Video Bac phan',
            'link' => 'https://www.youtube.com/watch?v=WX7dUj14Z00'
        ]);

        Video::create([
            'name' => 'Video Hong Nhan',
            'desc' => 'Video Hong Nhan',
            'link' => 'https://www.youtube.com/watch?v=8x2NjwwHUbQ'
        ]);


    }
}
