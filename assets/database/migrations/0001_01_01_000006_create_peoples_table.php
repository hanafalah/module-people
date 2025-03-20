<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Zahzah\ModulePeople\Enums\People\BloodType;
use Zahzah\ModulePeople\Models\Identity\Tribe;
use Zahzah\ModulePeople\Models\People\{
    People
};
use Zahzah\ModuleRegional\Models\Citizenship\Country;

return new class extends Migration
{
   use Zahzah\LaravelSupport\Concerns\NowYouSeeMe;

    private $__table;

    public function __construct(){
        $this->__table = app(config('database.models.People', People::class));
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $table_name = $this->__table->getTable();
        if (!$this->isTableExists()){
            Schema::create($table_name, function (Blueprint $table) {
                $tribe   = app(config('database.models.Tribe', Tribe::class));
                $country = app(config('database.models.Country', Country::class));

                $table->ulid('id')->primary();
                $table->string('name',100)->nullable(false);
                $table->string('first_name',50)->nullable();
                $table->string('last_name',50)->nullable();
                $table->enum('sex',['1','0'])->nullable(false);
                $table->string('mother_name',50)->nullable();
                $table->string('father_name',50)->nullable();
                $table->date('dob')->nullable();
                $table->string('pob',150)->nullable();
                $table->string('last_education',150)->nullable();
                $table->enum('blood_type',array_column(BloodType::cases(),'value'))->nullable();

                $table->foreignIdFor($tribe::class)->nullable()
                      ->index()->constrained()->cascadeOnUpdate()
                      ->nullOnDelete();

                $table->foreignIdFor($country::class)->nullable()
                      ->index()->constrained()->cascadeOnUpdate()
                      ->nullOnDelete();

                $table->json('props')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->__table->getTable());
    }
};
