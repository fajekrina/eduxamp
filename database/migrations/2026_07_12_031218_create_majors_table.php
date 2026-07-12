<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMajorsTable extends Migration
{
    public function up()
    {
        Schema::create('majors', function (Blueprint $table) {

            $table->id();

            $table->uuid('uuid')->unique();

            $table->string('major_code')->unique();

            $table->string('major_name');

            $table->string('faculty');

            $table->text('description')->nullable();

            $table->json('config')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('majors');
    }
}