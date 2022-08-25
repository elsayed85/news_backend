<?php

namespace Database\Seeders;

use App\Models\Device;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Stephenjude\FilamentBlog\Models\Author;
use Stephenjude\FilamentBlog\Models\Category;
use Stephenjude\FilamentBlog\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(2)->create();
        dd('');
        // $device = Device::factory()->count(1)->create([
        //     'public_key' => "1",
        //     'private_key' =>  Hash::make("1")
        // ]);

        // Device::factory()->count(3)->create();

        // super_admin and normal user already created with filament install command
        Role::create([
            'name' => 'normal_user',
            'guard_name' => config('filament.auth.guard')
        ]);


        User::factory()->count(2)->create()->each(function ($user) {
            $user->assignRole('writer');
        });

        // users
        User::factory()->count(3)->create()->each(function ($user) {
            $user->assignRole('normal_user');
        });

        // categories
        Category::create([
            'name' => 'أخبار عاجله',
            'slug' => 'akhbar-ajalah',
            'description' => 'This is the first category',
            'is_visible' => true,
        ]);
        Category::create([
            'name' => 'سياسة',
            'slug' => 'siyasa',
            'description' => 'This is the first category',
            'is_visible' => true,
        ]);
        Category::create([
            'name' => 'حوادث',
            'slug' => 'category-3',
            'description' => 'This is the first category',
            'is_visible' => true,
        ]);
        Category::create([
            'name' => 'أخبار عامه',
            'slug' => 'category-4',
            'description' => 'This is the first category',
            'is_visible' => true,
        ]);


        // authors
        $author = Author::create([
            'name' => 'مركز المعلومات 1',
            'username' => 'markez1',
            'photo' => 'blog/ktB14YiZe5aszwt63v2K9qjHBdcPUg-metaaW1hZ2VzLnBuZw==-.png',
            'bio' => '<p dir="rtl"><strong>الاسم : السيد كمال<br>عدد سنوات الخبره 5</strong></p><p dir="rtl"><strong>مجال العمل: برمجه المواقع</strong></p><p><br></p><pre dir="rtl">يجب على الانسان البحث عن نفسه عندما يلهو ويلعب ويلهو ويلعب&nbsp;</pre>',
        ]);



        $author = Author::create([
            'name' => 'مركز المعلومات 2',
            'username' => 'markez2',
            'photo' => 'blog/ktB14YiZe5aszwt63v2K9qjHBdcPUg-metaaW1hZ2VzLnBuZw==-.png',
            'bio' => '<p dir="rtl"><strong>الاسم : السيد كمال<br>عدد سنوات الخبره 5</strong></p><p dir="rtl"><strong>مجال العمل: برمجه المواقع</strong></p><p><br></p><pre dir="rtl">يجب على الانسان البحث عن نفسه عندما يلهو ويلعب ويلهو ويلعب&nbsp;</pre>',
        ]);




        $author = Author::create([
            'name' => 'مركز المعلومات 3',
            'username' => 'markez3',
            'photo' => 'blog/ktB14YiZe5aszwt63v2K9qjHBdcPUg-metaaW1hZ2VzLnBuZw==-.png',
            'bio' => '<p dir="rtl"><strong>الاسم : السيد كمال<br>عدد سنوات الخبره 5</strong></p><p dir="rtl"><strong>مجال العمل: برمجه المواقع</strong></p><p><br></p><pre dir="rtl">يجب على الانسان البحث عن نفسه عندما يلهو ويلعب ويلهو ويلعب&nbsp;</pre>',
        ]);




        $author = Author::create([
            'name' => 'مركز المعلومات 4',
            'username' => 'markez4',
            'photo' => 'blog/ktB14YiZe5aszwt63v2K9qjHBdcPUg-metaaW1hZ2VzLnBuZw==-.png',
            'bio' => '<p dir="rtl"><strong>الاسم : السيد كمال<br>عدد سنوات الخبره 5</strong></p><p dir="rtl"><strong>مجال العمل: برمجه المواقع</strong></p><p><br></p><pre dir="rtl">يجب على الانسان البحث عن نفسه عندما يلهو ويلعب ويلهو ويلعب&nbsp;</pre>',
        ]);
    }

}
