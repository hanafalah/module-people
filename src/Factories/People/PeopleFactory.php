<?php

namespace Hanafalah\ModulePeople\Factories\People;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PeopleFactory extends Factory
{
    // /**
    //  * Create a new factory instance.
    //  *
    //  * @param  int|null  $count
    //  * @param  \Illuminate\Database\Eloquent\Collection|null  $states
    //  * @param  \Illuminate\Database\Eloquent\Collection|null  $has
    //  * @param  \Illuminate\Database\Eloquent\Collection|null  $for
    //  * @param  \Illuminate\Database\Eloquent\Collection|null  $afterMaking
    //  * @param  \Illuminate\Database\Eloquent\Collection|null  $afterCreating
    //  * @param  string|null  $connection
    //  * @param  \Illuminate\Database\Eloquent\Collection|null  $recycle
    //  * @return void
    //  */
    // public function __construct($count = null,
    //         ?Collection $states = null,
    //         ?Collection $has = null,
    //         ?Collection $for = null,
    //         ?Collection $afterMaking = null,
    //         ?Collection $afterCreating = null,
    //         $connection = null,
    //         ?Collection $recycle = null){
    //     $this->model = app(config('database.models.People'));
    //     parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection, $recycle);
    // }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->model = app(config('database.models.People'));
        $firstName = fake()->firstName();
        $lastName  = fake()->lastName();
        return [
            'uuid'              => Str::orderedUuid(),
            'first_name'        => $firstName,
            'last_name'         => $lastName,
            'name'              => $firstName . ' ' . $lastName,
            'dob'               => fake()->date(),
            'pob'               => fake()->city()
        ];
    }
}
