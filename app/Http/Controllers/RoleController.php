<?php
/**
 * Created by PhpStorm.
 * User: anthonyrodrigues
 * Date: 4/2/20
 * Time: 8:29 PM
 */

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    protected $successStatus = 200;
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
            $userLevel = null;
            $user = Auth::user();
            foreach ($user->getRoles() as $role) {
                $userLevel = max($role->level, $userLevel);
            }
            return response()->json(['code' => 200, 'data' => (new Role())->where('level', '<=', $userLevel)->get()], $this->successStatus);
        } catch (\Exception $exception) {
            return response()->json(['code' => 500, 'message' => 'Ocorreu um erro na requisição'], $this->successStatus);
        }
    }

}