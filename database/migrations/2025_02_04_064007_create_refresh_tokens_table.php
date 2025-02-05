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
        Schema::create('refresh_tokens', function (Blueprint $table) {
            $table->id();  // معرف فريد للتوكن
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // ربط مع المستخدم (مع حذف الـ refresh_token عند حذف المستخدم)
            $table->string('refresh_token');  // التوكن نفسه
            $table->timestamp('expires_at');  // تاريخ انتهاء صلاحية التوكن
            $table->timestamps();  // تاريخ الإنشاء والتحديث
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refresh_tokens');
    }
};
