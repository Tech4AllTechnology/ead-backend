<?php

namespace App\Http\Controllers;

use App\UniversityCampus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UniversityCampusController extends Controller
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
            return response()->json(
                [
                    'code' => 200, 'data' => (new UniversityCampus())->getUniversityCampusList()
                ], $this->successStatus
            );
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if (!Auth::check()) {
                response()->json(['code' => 403, 'message' => 'Você não tem acesso a essa função'], $this->successStatus);
            }

            if ($this->validateItens($request)) {
                return response()->json(['code' => 401, 'message' => 'Os dados estão incorretos.'], $this->successStatus);
            }

            if ((new UniversityCampus())->checkUniversityCampusExists($request->name)) {
                return response()->json(['code' => 400, 'message' => 'Já existe um curso com esse nome.'], $this->successStatus);
            }

            $universityCampus = $request->only(['name', 'status', 'state', 'responsible_id']);
            $universityCampus = UniversityCampus::create($universityCampus);
            return response()->json(
                [
                    'data' => [
                        'key' => $universityCampus->id, 'code' => $universityCampus->code
                    ], 'code' => 200
                ], $this->successStatus
            );

        } catch (\Exception $exception) {
            return response()->json(['code' => 500, 'message' => 'Ocorreu um erro na requisição'], $this->successStatus);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UniversityCampus  $universityCampus
     * @return \Illuminate\Http\Response
     */
    public function show(UniversityCampus $universityCampus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UniversityCampus  $universityCampus
     * @return \Illuminate\Http\Response
     */
    public function edit(UniversityCampus $universityCampus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UniversityCampus  $universityCampus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UniversityCampus $universityCampus)
    {
        try {
            if (!Auth::check()) {
                response()->json(['code' => 403, 'message' => 'Você não tem acesso a essa função'], $this->successStatus);
            }

            if ($this->validateItens($request)) {
                return response()->json(['code' => 401, 'message' => 'Os dados estão incorretos.'], $this->successStatus);
            }

            $universityCampusData = $request->except(['states', 'responsible']);
            $universityCampus = $universityCampus->update($universityCampusData);
            return response()->json(
                [
                    'data' => ['status' => $universityCampus], 'code' => 200], $this->successStatus
            );

        } catch (\Exception $exception) {
            return response()->json(['code' => 500, 'message' => 'Ocorreu um erro na requisição'], $this->successStatus);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UniversityCampus  $universityCampus
     * @return \Illuminate\Http\Response
     */
    public function destroy(UniversityCampus $universityCampus)
    {
        try {
            if (!Auth::check()) {
                response()->json(['code' => 403, 'message' => 'Você não tem acesso a essa função'], $this->successStatus);
            }
            $universityCampus = $universityCampus->delete();
            return response()->json(['data' => ['status' => $universityCampus], 'code' => 200], $this->successStatus);
        } catch (\Exception $exception) {
            return response()->json(['code' => 500, 'message' => 'Ocorreu um erro na requisição'], $this->successStatus);
        }
    }

    public function validateItens(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
            'state' => 'exists:states,id',
            'responsible_id' => 'exists:users,id'
        ]);
        return $validator->fails();
    }
}
