<?php

namespace Database\Factories;

use App\Models\DataFile;
use App\Models\Device;
use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\Factory;

class DataFileFactory extends Factory
{
    protected $model = DataFile::class;

    public function definition()
    {
        return [
            'file_name' => $this->faker->word . '.txt',
            'file_path' => $this->faker->filePath(),
            'device_id' => Device::inRandomOrder()->first()->id,
            'site_id' => Site::inRandomOrder()->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
