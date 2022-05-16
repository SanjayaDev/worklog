<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("project_id")->references("id")->on("projects")->onDelete("restrict")->onUpdate("cascade");
            $table->foreignId("assign_status_id")->references("id")->on("assign_status")->onDelete("restrict")->onUpdate("cascade");
            $table->foreignId("assign_user")->references("id")->on("users")->onDelete("restrict")->onUpdate("cascade");
            $table->foreignId("assign_priority_id")->references("id")->on("assign_priorities")->onDelete("restrict")->onUpdate("cascade");
            $table->string("assign_title", 150);
            $table->text("assign_description");
            $table->date("assign_deadline");
            $table->date("assign_show_date");
            $table->dateTime("assign_finish_date")->nullable();
            $table->tinyInteger("is_late")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments');
    }
};
