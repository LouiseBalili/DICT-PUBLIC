<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'username' => 'rossensei',
                'password' => 'password123',
                'employeeInfo' => [
                    'id_no' => '883765',
                    'fname' => 'Rosalino Jr.',
                    'mname' => 'Tumabang',
                    'lname' => 'Flores',
                    'emp_type' => 'Plantilla',
                    'address' => 'Pinayagan Sur, Tubigon, Bohol.',
                    'status' => 1,
                ],
            ],
            [
                'username' => 'enzoeyy',
                'password' => 'password123',
                'employeeInfo' => [
                    'id_no' => '238475',
                    'fname' => 'John Lorrence',
                    'mname' => 'Jumamoy',
                    'lname' => 'Estillore',
                    'emp_type' => 'Plantilla',
                    'address' => 'Cogon, Inabanga, Bohol.',
                    'status' => 1,
                ],
            ],
            [
                'username' => 'louisedemean',
                'password' => 'password123',
                'employeeInfo' => [
                    'id_no' => '987475',
                    'fname' => 'Louise Demean',
                    'mname' => 'Villanueva',
                    'lname' => 'Balili',
                    'emp_type' => 'Plantilla',
                    'address' => 'Ilijan Norte, Tubigon, Bohol.',
                    'status' => 1,
                ],
            ],
            [
                'username' => 'calunialester',
                'password' => 'password123',
                'employeeInfo' => [
                    'id_no' => '239567',
                    'fname' => 'Lester Sr.',
                    'mname' => 'Cosinero',
                    'lname' => 'Calunia',
                    'emp_type' => 'Plantilla',
                    'address' => 'Guiwanon, Tubigon, Bohol.',
                    'status' => 1,
                ],
            ],
            [
                'username' => 'john_838650',
                'password' => 'password123',
                'employeeInfo' => [
                    'id_no' => '838650',
                    'fname' => 'John',
                    'mname' => 'Villa',
                    'lname' => 'Doe',
                    'emp_type' => 'Contract of Service',
                    'address' => 'Los Angeles, California',
                    'status' => 0,
                ],
            ],
        ];

        foreach($users as $u) {
            $user = User::create([
                'username' => $u['username'],
                'password' => bcrypt($u['password']),
            ]);

            $user->employee()->create($u['employeeInfo']);
        }
    }
}
