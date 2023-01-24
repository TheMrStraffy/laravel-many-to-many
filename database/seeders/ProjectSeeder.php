<?php

namespace Database\Seeders;

use App\Models\Project;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 50; $i++){
            $new_project = new Project();
            $new_project->name = $faker->words(4, true);;
            $new_project->slug = Project::slugGenerator($new_project->name);
            $new_project->client_name = $faker->name();
            $new_project->summary = $faker->paragraph();
            $new_project->cover_image = 'not_available.jpg';
            $new_project->save();
            // dump($new_project);
        }

    }


}
