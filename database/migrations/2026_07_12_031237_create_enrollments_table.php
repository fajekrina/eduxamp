<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentsTable extends Migration
{
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {

            $table->id();

            $table->uuid('uuid')->unique();

            $table->foreignId('student_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('major_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('enrollment_number')->unique();

            $table->dateTime('enrollment_date');

            $table->enum('status', [
                'Pending',
                'Approved',
                'Rejected'
            ])->default('Pending');

            $table->string('attachment')->nullable();

            $table->text('remarks')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Snapshot
            |--------------------------------------------------------------------------
            */

            $table->string('student_number_snapshot');

            $table->string('student_name_snapshot');

            $table->string('major_code_snapshot');

            $table->string('major_name_snapshot');

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('enrollments');
    }
}