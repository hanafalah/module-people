<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Hanafalah\LaravelSupport\Concerns\NowYouSeeMe;
use Hanafalah\ModulePatient\Models\{
    Patient\Patient
};
use Hanafalah\ModulePeople\Enums\FamilyRelationship\Flag;
use Hanafalah\ModulePeople\Models\FamilyRelationship\FamilyRelationship;
use Hanafalah\ModulePeople\Models\FamilyRole;
use Hanafalah\ModulePeople\Models\People\People;

return new class extends Migration
{
    use NowYouSeeMe;

    private $__table,$__table_patient,$__table_people;

    public function __construct(){
        $this->__table = app(config('database.models.FamilyRelationship', FamilyRelationship::class));
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
                $people = app(config('database.models.People', People::class));
                $family_role = app(config('database.models.FamilyRole', FamilyRole::class));

                $table->ulid('id')->primary();
                $table->foreignIdFor($people::class,'people_id')
                      ->index()->constrained()->cascadeOnUpdate()->restrictOnDelete();
                $table->string('name',50)->nullable(true);
                $table->string('phone',50)->nullable(true);
                $table->foreignIdFor($family_role::class)
                        ->index()->constrained()
                        ->cascadeOnUpdate()->restrictOnDelete();
                $table->string('reference_type',50)->nullable(true);
                $table->string('reference_id',36)->nullable(true);
                $table->json('props')->nullable();
                $table->timestamps();
                $table->softDeletes();
                
                $table->index(['reference_type','reference_id']);
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
