<?php

namespace App\Http\Controllers;


use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;


class ApiUserController extends Controller
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository, Request $request)
    {
        $this->model    =   $userRepository->makeModel();
        $this->request  =   $request;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return $this->model->get();
    }

    public function create()
    {
        $inputs = json_decode($this->request->getContent(), true);
        return $this->model->create($inputs);
    }

    public function show($id=0)
    {
        return $this->model->find($id);
    }

    public function update()
    {
        $inputs = json_decode($this->request->getContent(), true);
        $id = $inputs['id'];
        unset($inputs['id']);
        $rtn = $this->model->find($id)->update($inputs);
        return response()->json( ['status'=>$rtn] );
    }

    public function destroy($id = 0)
    {
        $rtn = $this->model->find($id)->delete();
        return response()->json( ['status'=>$rtn] );
    }

    public function store($id)
    {}

    public function edit($id = 0)
    {}
}