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
        Schema::create('dia_diems', function (Blueprint $table) {
            $table->id();
            $table->string('ten_tour');
            $table->string('thoi_gian');
            $table->string('dia_diem_chinh');
            $table->integer('gia_goc');
            $table->integer('gia_khuyen_mai');
            $table->string('hoat_dong_chinh');
            $table->string('mo_ta');
            $table->string('hinh_anh');
            $table->integer('slot');
            $table->string('ticket');
            $table->date('ngay_khoi_hanh')->format('d/m/Y');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dia_diems');
    }
};
