<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('despesas', function (Blueprint $table) {
            if (!Schema::hasColumn('despesas', 'categoria')) {
                $table->string('categoria')->after('valor_total');
            }

            if (!Schema::hasColumn('despesas', 'em_aberto')) {
                $table->boolean('em_aberto')->default(true)->after('categoria');
            }
        });
    }

    public function down(): void
    {
        Schema::table('despesas', function (Blueprint $table) {
            if (Schema::hasColumn('despesas', 'categoria')) {
                $table->dropColumn('categoria');
            }
            if (Schema::hasColumn('despesas', 'em_aberto')) {
                $table->dropColumn('em_aberto');
            }
        });
    }
};