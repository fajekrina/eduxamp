<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {

            $table->id();

            $table->uuid('uuid')->unique();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->string('student_number')->unique();

            $table->string('full_name');

            $table->enum('gender', ['Male', 'Female']);

            $table->date('birth_date');

            $table->string('email')->unique();

            $table->string('phone', 20);

            $table->text('address')->nullable();

            $table->json('profile')->nullable();

            $table->string('transcript_file')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}