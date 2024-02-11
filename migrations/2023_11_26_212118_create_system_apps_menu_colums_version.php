<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateSystemAppsMenuColumsVersion extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::table('system_app_menu', function (Blueprint $table) {
            $table->char('version',10)->default('1.0')->comment('version of the component');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sqcloud_system_apps_menu');
    }
}
