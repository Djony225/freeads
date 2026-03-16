<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // On vérifie avant d'ajouter chaque colonne
            if (!Schema::hasColumn('users', 'name')) {
                $table->string('name')->after('id');
            }
            if (!Schema::hasColumn('users', 'login')) {
                $table->string('login')->after('name');
            }
            if (!Schema::hasColumn('users', 'phone_number')) {
                $table->string('phone_number')->after('email');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // On supprime uniquement si elles existent
            $table->dropColumn(['name', 'login', 'phone_number']);
        });
    }
};