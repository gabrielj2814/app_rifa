<?php


namespace App\Services;

use App\Contracts\Rifa;
use App\Repository\RifaRepository;

class RifaServices implements Rifa{

    public function __construct(
        protected RifaRepository $rifaRepository
    )
    {}


}


?>
