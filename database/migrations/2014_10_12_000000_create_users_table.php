<?php

use App\Enums\Role;
use App\Models\User;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
//            $table->string('email')->unique();
            $table->string('username')->unique();
//            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->smallInteger('role', false, true);
            $table->rememberToken();
//            $table->foreignId('current_team_id')->nullable();
//            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });

        User::create(['name' => 'Admin', 'username' => 'admin', 'password' => 'password', 'role' => Role::ADMIN]);
        User::create(['name' => 'Cashier 1', 'username' => 'cashier1', 'password' => 'password', 'role' => Role::CASHIER]);
        User::create(['name' => 'Cashier 2', 'username' => 'cashier2', 'password' => 'password', 'role' => Role::CASHIER]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
