<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'company_name')) {
                $table->string('company_name')->nullable()->after('name');
            }

            if (!Schema::hasColumn('users', 'owner_name')) {
                $table->string('owner_name')->nullable()->after('company_name');
            }

            if (!Schema::hasColumn('users', 'status')) {
                $table->enum('status', ['Pemilik', 'Pengelola'])->nullable()->after('owner_name');
            }

            if (!Schema::hasColumn('users', 'office_address')) {
                $table->text('office_address')->nullable()->after('status');
            }

            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone', 25)->nullable()->unique()->after('office_address');
            }

            if (!Schema::hasColumn('users', 'jabatan')) {
                $table->string('jabatan')->nullable()->after('phone');
            }

            if (!Schema::hasColumn('users', 'wilayah')) {
                $table->string('wilayah')->nullable()->after('jabatan');
            }

            if (!Schema::hasColumn('users', 'loket_samsat')) {
                $table->string('loket_samsat')->nullable()->after('wilayah');
            }

            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['operator', 'internal', 'super_admin'])->default('operator')->after('loket_samsat');
            }
        });

        // ubah kolom lama di luar blok atas
        // email: cukup nullable, jangan unique lagi
        if (Schema::hasColumn('users', 'email')) {
            DB::statement('ALTER TABLE users MODIFY email VARCHAR(255) NULL');
        }

        if (Schema::hasColumn('users', 'name')) {
            DB::statement('ALTER TABLE users MODIFY name VARCHAR(255) NULL');
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = [
                'company_name',
                'owner_name',
                'status',
                'office_address',
                'phone',
                'jabatan',
                'wilayah',
                'loket_samsat',
                'role',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        if (Schema::hasColumn('users', 'email')) {
            DB::statement('ALTER TABLE users MODIFY email VARCHAR(255) NOT NULL');
        }

        if (Schema::hasColumn('users', 'name')) {
            DB::statement('ALTER TABLE users MODIFY name VARCHAR(255) NOT NULL');
        }
    }
};