<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        $now = now();
        DB::table('roles')->insert([
            ['name' => 'Admin', 'slug' => 'admin', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Buyer', 'slug' => 'buyer', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Business Owner', 'slug' => 'business_owner', 'created_at' => $now, 'updated_at' => $now],
        ]);

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->after('id')->constrained('roles')->restrictOnDelete();
        });

        $buyerId = DB::table('roles')->where('slug', 'buyer')->value('id');
        $businessOwnerId = DB::table('roles')->where('slug', 'business_owner')->value('id');

        if ($buyerId && $businessOwnerId) {
            DB::table('users')->where('account_type', 'business')->update(['role_id' => $businessOwnerId]);
            DB::table('users')->where('account_type', 'buyer')->update(['role_id' => $buyerId]);
            DB::table('users')->whereNull('role_id')->update(['role_id' => $buyerId]);
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });

        Schema::dropIfExists('roles');
    }
};
