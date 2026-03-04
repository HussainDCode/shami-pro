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
            $table->string('username')->nullable()->unique()->after('name');
            $table->string('phone')->nullable()->after('email');
            $table->string('website')->nullable()->after('phone');
            $table->string('gender')->nullable()->after('website');
            $table->date('date_of_birth')->nullable()->after('gender');
            $table->string('nationality')->nullable()->after('date_of_birth');
            $table->string('profile_picture')->nullable()->after('nationality');
            $table->string('country')->nullable()->after('profile_picture');
            $table->string('city')->nullable()->after('country');
            $table->string('postal_code')->nullable()->after('city');
            $table->string('landmark')->nullable()->after('postal_code');
            $table->text('address')->nullable()->after('landmark');
            $table->string('account_type')->nullable()->after('address'); // business | buyer
            $table->string('id_front')->nullable()->after('account_type');
            $table->string('id_back')->nullable()->after('id_front');
            $table->string('biz_proof')->nullable()->after('id_back');
            $table->string('payment_slip')->nullable()->after('biz_proof');
            $table->string('payment_method')->nullable()->after('payment_slip');
            $table->string('transaction_ref')->nullable()->after('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'username', 'phone', 'website', 'gender', 'date_of_birth', 'nationality',
                'profile_picture', 'country', 'city', 'postal_code', 'landmark', 'address',
                'account_type', 'id_front', 'id_back', 'biz_proof', 'payment_slip',
                'payment_method', 'transaction_ref'
            ]);
        });
    }
};
