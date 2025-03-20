<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Hanafalah\ModulePeople\Models\Identity\Tribe;
use Hanafalah\ModulePeople\ModulePeople;
use Hanafalah\ModulePeople\Schemas\Tribe as SchemasTribe;

return new class extends Migration
{
    use Hanafalah\LaravelSupport\Concerns\NowYouSeeMe;

    private $__table;

    public function __construct()
    {
        $this->__table = app(config('database.models.Tribe', Tribe::class));
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
                $table->id();
                $table->string('name', 100)->nullable(false);
            });

            Schema::table($table_name, function (Blueprint $table) {
                $table->foreignIdFor($this->__table, 'parent_id')->nullable()->index()->constrained()->restrictOnDelete()->cascadeOnUpdate();
            });

            $tribes = require_once __DIR__ . '/data/tribes.php';
            ModulePeople::useTribe()->adds($tribes);
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
