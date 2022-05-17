<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaoCaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bao_caos', function (Blueprint $table) {
            $table->id();
            $table->text('moTa')->nullable();
            $table->text('diemManh')->nullable();
            $table->text('diemTonTai')->nullable();
            $table->text('keHoachHanhDong')->nullable();
            $table->integer('diemTDG')->nullable();
            $table->integer('trangThai')->nullable();
            $table->integer('nganh_id');
            $table->integer('tieuChi_id');
            $table->softDeletes();
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
        Schema::dropIfExists('bao_caos');
    }
}
