<?php

namespace App\Http\Controllers;

use App\Role;
use App\Telephone;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Crypt;


class UserController extends Controller
{
    protected $successStatus = 200;

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        try {
            if (Auth::attempt(
                [
                    'application' => request('application'),
                    'password' => request('password'),
                    'deleted_at' => null,
                    'status' => 1
                ])
            ) {
                $user = Auth::user();
                foreach ($user->getRoles() as $roles) {
                    if ($roles->level < 2) {
                        return response()->json(['message' => 'Alunos ainda não podem fazer o login'], $this->successStatus);
                    }
                }
                $success['token'] = $user->createToken('MyApp')->accessToken;
                return response()->json(['data' => $success, 'code' => $this->successStatus], $this->successStatus);
            }
            return response()->json(['message' => 'Login inválido.'], $this->successStatus);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Ocorreu um erro na requisição'], $this->successStatus);
        }
    }

    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        try {
            $request->user()->token()->revoke();
            return response()->json(['code' => 200, 'data' => true], $this->successStatus);
        } catch (\Exception $exception) {
            return response()->json(['code' => 500, 'message' => 'Ocorreu um erro na requisição'], $this->successStatus);
        }
    }

    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        try {
            $usersRoles = [];
            $user = Auth::user();
            foreach ($user->getRoles() as $role) {
                array_push($usersRoles, $role->slug);
            }
            $user['roles'] = $usersRoles;
            return response()->json(['code' => 200, 'data' => $user], $this->successStatus);
        } catch (\Exception $exception) {
            return response()->json(['code' => 500, 'message' => 'Ocorreu um erro na requisição'], $this->successStatus);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            if (!Auth::check()) {
                Throw new \Exception('Você não tem permissão para acessar essa página.');
            }
            $users = (new User)->getUsersList();
            foreach ($users as $index => $user) {
                foreach (User::$encrypted as $item) {
                    $users[$index][$item] = Crypt::decryptString($user[$item]);
                }
            }
            return response()->json(['code' => 200, 'data' => $users], $this->successStatus);
        } catch (\Exception $exception) {
            return response()->json(['code' => 500, 'message' => 'Ocorreu um erro na requisição'], $this->successStatus);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $input = $request->except('id');
            $input['password'] = bcrypt($input['cpf']);
            foreach (User::$encrypted as $item) {
                $input[$item] = Crypt::encryptString($input[$item]);
            }
            $input['application'] = (date_create())->format('YmdHisv');
            $input['university_campus_id'] = $input['university_campus']['id'];
            $user = User::create($input);
            $user->attachRole($request->only(['type']));
            if ($request->has('telephones')) {
                $telephones = $request->only(['telephones'])['telephones'];
                foreach ($telephones as $telephone) {
                    if (!is_null($telephone['telephone_number'])) {
                        Telephone::create(['user_id' => $user->id, 'telephone_number' => $telephone['telephone_number']]);
                    }
                }
            }
            $programs = $request->only(['programs'])['programs'];
            foreach ($programs as $program) {
                if (!is_null($program['id'])) {
                    $user->programs()->attach($program['id'], ['start_date' => '2020-01-01']);
                }
            }

            return response()->json(['data' => ['key' => $user->id, 'user_type' => $user->user_type], 'code' => 200], $this->successStatus);
        } catch (\Exception $exception) {
            return response()->json(['code' => 500, 'message' => 'Ocorreu um erro na requisição'], $this->successStatus);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        try {
            if (!Auth::check() || $user->hasOneRole('admin|administrativecoordinator')) {
                response()->json(['code' => 403, 'message' => 'Você não tem acesso a essa função'], $this->successStatus);
            }

            if ($this->validateItens($request)) {
                return response()->json(['code' => 401, 'message' => 'Os dados estão incorretos.'], $this->successStatus);
            }
            $programItems = [];
            $userData = $request->all();
            foreach (User::$encrypted as $item) {
                $userData[$item] = Crypt::encryptString($userData[$item]);
            }
            $userData['university_campus_id'] = $userData['university_campus']['id'];
            $user->update($userData);
            $user->syncRoles($userData['type']);

            $programs = $request->only(['programs'])['programs'];

            foreach ($programs as $program) {
                if (!is_null($program['id'])) {
                    $programItems[$program['id']] = $program['id'];
                    $programItems[$program['id']] = [ 'start_date' => '2020-01-01'];
                }
            }
            $user->programs()->sync($programItems);

            $user->telephones()->forceDelete();
            if ($request->has('telephones')) {
                $telephones = $request->only(['telephones'])['telephones'];
                foreach ($telephones as $telephone) {
                    if (!is_null($telephone['telephone_number'])) {
                        Telephone::create(['user_id' => $user->id, 'telephone_number' => $telephone['telephone_number']]);
                    }
                }
            }
            return response()->json(['data' => ['status' => $user, 'user_type' => $user->user_type], 'code' => 200], $this->successStatus);

        } catch (\Exception $exception) {
            return response()->json(['code' => 500, 'message' => 'Ocorreu um erro na requisição'], $this->successStatus);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
        } catch (\Exception $exception) {
            return response()->json(['code' => 500, 'message' => 'Ocorreu um erro na requisição'], $this->successStatus);
        }
        return response();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listProfessor()
    {
        try {
            if (!Auth::check()) {
                Throw new \Exception('Você não tem permissão para acessar essa página.');
            }
            $users = (new User)->getUsersList();
            foreach ($users as $index => $user) {
                if (!$user->hasRole(["campuscoordinator", "administrativecoordinator"])) {
                    unset($users[$index]);
                    continue;
                }
            }
            return response()->json(['code' => 200, 'data' => $users], $this->successStatus);
        } catch (\Exception $exception) {
            return response()->json(['code' => 500, 'message' => 'Ocorreu um erro na requisição'], $this->successStatus);
        }
    }


    public function validateItens(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email'
        ]);
        return $validator->fails();
    }

    /**
     * Display a listing of the resource.
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function listPrograms(User $user)
    {
        try {
            if (!Auth::check()) {
                Throw new \Exception('Você não tem permissão para acessar essa página.');
            }
            return response()->json(['code' => 200, 'data' => $user->programs()->get()], $this->successStatus);
        } catch (\Exception $exception) {
            return response()->json(['code' => 500, 'message' => 'Ocorreu um erro na requisição'], $this->successStatus);
        }
    }
}