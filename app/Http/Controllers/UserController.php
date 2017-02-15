<?php

namespace App\Http\Controllers;

use App\Repositories\Support\Filter;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;


class UserController extends Controller
{
    use Filter;

    protected $userRepository;

    public function __construct(UserRepository $userRepository, Request $request)
    {
        $this->model    =   $userRepository->makeModel();
        $this->request  =   $request;
        $this->userRepository = $userRepository;
        $this->columns = [
        'name'  =>   'Nome',
        'email' =>  'E-mail',
        //'posts.titulo'=>'Post titulo',
    ];
        $this->operators = [
        'equal_to'  =>  '=',
        'not_equal' =>  '<>',
        'less_than' =>  '<',
        'greater_than'  =>  '>',
        'less_than_or_equal_to' =>  '<=',
        'greater_than_or_equal_to'  =>  '>=',
        'not_in'    =>  'NOT IN',
        'like'  =>  'LIKE',
    ];
    }

    public function index()
    {
        $this->request  = $this->request->all();
        $this->perPege  =   30;
        $per_page       =   $this->perPegeRange;
        $columns        =   $this->columns;
        $operator       =   $this->operators;
        $usuarios       =   $this->buildQuery();

        return view('usuarios.index',
            [
                'usuarios' => $usuarios,
                'request'   =>  $this->request,
                'column'    =>  $columns,
                'per_page'  =>  $per_page,
                'operator'  =>  $operator
            ]);
    }

    public function create($id=0)
    {
        $request    = $this->request;

        $user       =   array();
        if($id!=0)
            $user = $this->userRepository->makeModel()->find($id);

        if ($this->request->isMethod('post')) {

            $this->validate($this->request,
                            array(  'name'=>'required',
                                    'email'=>'required|unique:users'. ($id ? ",id,$id" : '')));

            $rtn = $this->userRepository->makeModel()->find($id);

            if (is_null($rtn))
                $this->userRepository->makeModel()->create($request->all());
             else
                $rtn->update($request->all());

            return redirect()->route('user.index')
                ->with('success', 'Registro atualizado com sucesso!');

        }
        return view('usuarios.form',['user'=>$user]);
    }


    public function show($id)
    {

    }

    public function destroy($id = 0)
    {

        $rtn = $this->userRepository->makeModel()->find($id);
        if ($rtn) $rtn->delete();

        return redirect()->route('user.index')
            ->with('success', 'Registro excluido com sucesso!');

    }
}