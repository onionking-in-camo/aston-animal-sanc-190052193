<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Animal;

class AnimalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $firsts = ['Annie', 'Big', 'Charlie', 'Daffy', 'Edgar', 'Fat', 'Gertrude',
        'Hairy', 'Izzy', 'Jiminy', 'Knuckles', 'Lizzie', 'Money', 'Neptune', 'Ophelia',
        'Pretty', 'Quetzalcoatl', 'Rudy', 'Scar', 'Temper', 'Unicorn', 'Vicious', 'Wazzock',
        'Xia', 'Yella', 'Zapp'];

        $suffix = [' the Great', ' the Wise', ' Belly', ' Tantrum', ' Claws', ' the Cat',
        'Whiskers', ', Catnip Dealer', ', M.D.', ', Esq.', ' XII', ' III', ' Reaper',
        ' the Impaler', ' in Disguise'];

        $names = array();
        for ($i = 0; $i < 10; $i++) {
            $names [] = $faker->unique()->randomElement($firsts) . $faker->unique()->randomElement($suffix);
        }

        foreach (range(1, 10) as $i) {
            DB::table('animals')->insert([
                'name' => $faker->unique()->randomElement($names),
                'DOB' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'description' => $faker->text($maxNbChars = 256),
                'status' => $faker->randomElement($array = array('available', 'unavailable'))
            ]);
        }
    }
}
