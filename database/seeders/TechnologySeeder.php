<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = [
            '1'=>'C and C++','Java','Pascal','BASIC',
            '2'=>'Scala','Erlang','Haskell','Elixir','F#',
            '3'=>'Java','Python','C++','PHP','Ruby',
            '4'=>'PHP','Ruby','Python','bash','Perl','Node.js',
            '5'=>'Prolog','Absys','Datalog','Alma-0',
        ];
        foreach($technologies as $technology){
            $new_technology = new Technology();
            $new_technology->name = $technology;
            $new_technology->slug = Str::slug($technology);
            $new_technology->save();
        }
    }
}
