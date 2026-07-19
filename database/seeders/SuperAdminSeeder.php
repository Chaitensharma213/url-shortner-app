<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::insert("
            INSERT INTO users
            (
                company_id,
                role_id,
                created_by,
                name,
                email,
                password,
                created_at,
                updated_at
            )
            VALUES
            (
                ?, ?, ?, ?, ?, ?, NOW(), NOW()
            )
        ", [
            null,
            1,
            null,
            'Super Admin',
            'superadmin@example.com',
            Hash::make('password123')
        ]);
    }
}
