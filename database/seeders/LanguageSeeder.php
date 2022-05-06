<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Date::now();
        $data = collect(json_decode(file_get_contents(storage_path('app/languages.json'))))
        ->map(function($row) use ($date){
            return [
                'name' => $row->name,
                'created_at' => $date,
                'updated_at' => $date
            ];
        })->chunk(50);

        foreach ($data as $d){
            try {
                Language::insert($d->toArray());
            }catch (QueryException $e){
                Log::info($e->getMessage());
            }
        }
    }
}
