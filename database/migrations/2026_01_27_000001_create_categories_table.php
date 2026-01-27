<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void{
        Schema::create('categories', function(Blueprint $table){
            $table->id();

            
            // Nested Set Config
            // tọa độ trái phải , 1 câu lệnh SQL dựa vào khoảng lft rgt để truy vấn cây
            // Sinh ra 2 cột _lft, _rgt để lưu cấu trúc cây
            $table->unsignedBigInteger('_lft')->default(0);
            $table->unsignedBigInteger('_rgt')->default(0);
            $table->unsignedBigInteger('parent_id')->nullable();

            //
            $table->string('name');
            $table->string('slug')->unique()->index();

            // column SEO
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();

            // status
            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes(); // xóa mềm 

            // index
            $table->index(['parent_id','_lft','_rgt']);
        });
    }

    public function down():void
    {
        Schema::dropIfExists('categories');
    }
};