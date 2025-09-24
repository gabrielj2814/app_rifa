<?php


namespace App\Services;

use App\Contracts\Auth;
use App\Data\AuthCredencialesData;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthServices implements Auth{

    public function __construct(
        protected UserRepository $userRepository,
    ){}

    public function login(AuthCredencialesData $credentials): string
    {
        $user= $this->userRepository->consultUserByEmail($credentials->email);
        $token=$user->createToken($user->id, ['*'], now()->addWeek())->plainTextToken;
        return $token;

    }


    public function verify(AuthCredencialesData $credentials): bool
    {
        $user= $this->userRepository->consultUserByEmail($credentials->email);
        if(!$user){
            return false;
        }

        if(!Hash::check($credentials->password,$user->password)){
            return false;
        }

        return true;

    }

    public function logout(string $token): void
    {
        PersonalAccessToken::findToken($token)?->delete();
    }


}





?>
