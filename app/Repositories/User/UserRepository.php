<?php

namespace App\Repositories\User;


use App\Models\User;
use App\Repositories\Contracts\EloquentRepository;


class UserRepository implements EloquentRepository
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user     =       $user;
    }

    public function makeModel()
    {
        return $this->user;
    }

    public function create($array, $id = 0)
    {
        if($id == 0)
            $this->user->create($array);
        else {
            $rtn = $this->user->find($id);
            $rtn->update($array);
        }
    }

    public function destroy($id = 0)
    {
        $rtn = $this->user->find($id);
        if ($rtn) $rtn->delete();
    }
}
