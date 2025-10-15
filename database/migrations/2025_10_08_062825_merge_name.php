<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //

        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn(['firstname', 'lastname']);

            $table->string('fullname', 50)->nullable(false);
            
        });
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn(['firstname', 'lastname']);

            $table->string('fullname', 50)->nullable(false);
            
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
