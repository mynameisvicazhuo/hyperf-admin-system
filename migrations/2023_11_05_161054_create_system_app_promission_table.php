<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateSystemAppPromissionTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('system_app_promission', function (Blueprint $table) {
            $table->engine = 'Innodb';
            $table->comment('用户与角色关联表');
            $table->addColumn('bigInteger', 'user_id', ['unsigned' => true, 'comment' => '用户主键']);
            $table->addColumn('bigInteger', 'app_role_id', ['unsigned' => true, 'comment' => '角色主键']);
            $table->primary(['user_id', 'app_role_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_app_promission');
    }
}
