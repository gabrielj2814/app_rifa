<?php

namespace Database\Seeders;

use App\Data\CreateUserData;
use App\Repository\UserRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRootSeeder extends Seeder
{
    public function __construct(
        protected UserRepository $userRepository
    ){}
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $user=$this->userRepository->consultUserByEmail("root@gmail.com");
        if(!$user){
            $datos=CreateUserData::from([
                "name" => "root",
                "last_name" => "uwu",
                "email" => "root@gmail.com",
                "pin" => null,
                "password" => (string)env("PASWORD_ADMIN_DEFAULT")
            ]);
            $rootDB=$this->userRepository->createUser($datos);
            $rootDB->assignRole("Web-Master");
        }

    }
}
