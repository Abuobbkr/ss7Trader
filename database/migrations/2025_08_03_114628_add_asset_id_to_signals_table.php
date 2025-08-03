<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('signals', function (Blueprint $table) {
            $table->dropColumn('pair_name');
            $table->foreignId('asset_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null')
                ->after('id'); // Assuming 'id' is the last column before this addition
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('signals', function (Blueprint $table) {
            $table->dropForeign(['asset_id']);
            $table->dropColumn('asset_id');
        });
    }
};
