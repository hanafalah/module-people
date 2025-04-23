<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Hanafalah\ModulePeople\Enums\People\BloodType;
use Hanafalah\ModulePeople\Enums\People\MaritalStatus;
use Hanafalah\ModulePeople\Enums\People\Sex;
use Hanafalah\ModulePeople\Models\Identity\Tribe;
use Hanafalah\ModulePeople\Models\People\{
    People
};
use Hanafalah\ModuleRegional\Models\Citizenship\Country;

return new class extends Migration
{
    use Hanafalah\LaravelSupport\Concerns\NowYouSeeMe;

    private $__table;

    public function __construct()
    {
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
        if (!$this->isTableExists()) {
            Schema::create($table_name, function (Blueprint $table) {
                $country = app(config('database.models.Country', Country::class));

                $table->ulid('id')->primary();
                $table->string('uuid', 36)->nullable();
                $table->string('name', 100)->nullable(false);
                $table->string('first_name', 50)->nullable();
                $table->string('last_name', 50)->nullable();
                $table->date('dob')->nullable();
                $table->string('pob', 150)->nullable();
                $table->enum('sex', array_column(Sex::cases(), 'value'))->nullable();
                $table->enum('marital_status', MaritalStatus::cases())->nullable();
                $table->enum('blood_type', array_column(BloodType::cases(), 'value'))->nullable();
                $table->string('mother_name', 50)->nullable();
                $table->string('father_name', 50)->nullable();
                $table->string('last_education', 150)->nullable();
                $table->unsignedTinyInteger('total_children')->nullable();

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
