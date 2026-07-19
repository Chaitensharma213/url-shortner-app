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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('company_id')
                ->nullable()
                ->after('id')
                ->constrained('companies')
                ->nullOnDelete();

            $table->foreignId('role_id')
                ->nullable()
                ->after('company_id')
                ->constrained('roles')
                ->nullOnDelete();

            $table->foreignId('created_by')
                ->nullable()
                ->after('role_id')
                ->constrained('users')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['role_id']);
            $table->dropForeign(['created_by']);

            $table->dropColumn([
                'company_id',
                'role_id',
                'created_by'
            ]);
        });
    }
};
