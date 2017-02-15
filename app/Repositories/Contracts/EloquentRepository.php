<?php

namespace App\Repositories\Contracts;


interface EloquentRepository
{

    public function makeModel();
    public function create($array, $id=0);
    public function destroy($id=0);

}