<?php
namespace Hup234design\Cms\Database\Seeders;

use Hup234design\Cms\Models\IndexPage;
use Illuminate\Database\Seeder;

class IndexPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IndexPage::firstOrCreate([
            'for' => 'home',
            'title' => 'Home',
            'visible' => true,
        ]);

        IndexPage::firstOrCreate([
            'for' => 'posts',
            'title' => 'Posts',
            'visible' => true,
        ]);

        IndexPage::firstOrCreate([
            'for' => 'events',
            'title' => 'Events',
            'visible' => true,
        ]);
    }
}
