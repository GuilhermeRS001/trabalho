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
    Schema::create('despesas', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('descricao');
    $table->decimal('valor_total', 10, 2);
    $table->integer('parcelas')->default(1);
    $table->integer('parcelas_pagas')->default(0);
    $table->date('data_vencimento');
    $table->enum('status', ['pendente', 'pago'])->default('pendente');
    $table->timestamps();
});
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('despesas');
    }
};
