<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = Project::all();
        $technologies = Technology::all();
        foreach($projects as $project){
            //prendo un progetto random ad ogni ciclo
            $project = Project::inRandomOrder()->first();
            //prendo l'id di technology ad ogni ciclo
            $technology_id = Technology::inRandomOrder()->first()->id;
            //uso attach per inserire tutto nel pivot
            $project->technologies()->attach($technology_id);
        }
    }
}
