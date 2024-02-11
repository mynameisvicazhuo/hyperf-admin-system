<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateSystemAppTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('system_app', function (Blueprint $table) {
            $table->string('logo',100)->comment('应用logo');
            $table->string('components_host',100)->comment('component domain');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('system_app', function (Blueprint $table) {
            //
        });
    }
}
