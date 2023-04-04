<?php

namespace Database\Factories\Designers;

use App\Models\Designers\DesignerModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class DesignerModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DesignerModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Faker::create('id_ID');
        return [
            'id_user'           => $faker->unique()->numberBetween(3,80),
            'nama_designer'     => $faker->name(15),
            'alamat_designer'   => $faker->address(20),
            'no_telp'           => $faker->numerify('031-####-####'),
            'kota'              => $faker->city(20),
            'deskripsi'         => $faker->paragraph(100),
            'status'            => $faker->unique(true)->numberBetween(1,2),
            'img'               => $faker->imageUrl($width = 800, $height = 500, 'pramesty')
        ];
    }
}
