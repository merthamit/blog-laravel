<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = ['Hakkımızda', 'Kariyer', 'Vizyon', 'Misyon'];
        foreach ($pages as $id => $page) {
            DB::table('pages')->insert([
                'title' => $page,
                'slug'=> str_slug($page),
                'content' => '
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                    Tenetur optio commodi, doloremque id sunt earum
                    quisquam necessitatibus iure harum, quibusdam architecto
                    laudantium quaerat labore, velit consequatur ex quos?
                    Repellendus, temporibus?',
                'order' => $id,
                'images' => 'https://online.hbs.edu/Style%20Library/api/resize.aspx?imgpath=/PublishingImages/overhead-view-of-business-strategy-meeting.jpg&w=1200&h=630',
                'created_at' => now(),
                'updated_at' => now()]);
        }
    }
}
