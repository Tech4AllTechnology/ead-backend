<?php

namespace App\Http\Controllers;

use App\Program;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;


class ProgramController extends Controller
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
            return response()->json(['code' => 200, 'data' => (new Program())->getProgramList()], $this->successStatus);
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

            if ((new Program())->checkProgramExists($request->name)) {
                return response()->json(['code' => 400, 'message' => 'Já existe um curso com esse nome.'], $this->successStatus);
            }
            $program = $request->only(['name', 'code', 'status', 'program_type', 'recognized_by_mec', 'responsible_id']);
            $program['code'] = $program['name'] . date_create()->format('Ym');
            $program = Program::create($program);
            if ($request->has('automatic') && $request->input('automatic') == 1 ) {
                for ($index = 1; $index <= $request->input('quantity_courses'); $index++) {
                    $course = [];
                    $course['name'] = $program->name . $index;
                    $course['code'] = $program->code . $index;
                    $course['status'] = $program->status;
                    $course['credit'] = 1;
                    $course['period'] = 1;

                    $course = Course::create($course);
                    $programId['id'] = $program->id;
                    $course->programItems()->attach($programId);
                }
            }

            return response()->json(['data' => ['key' => $program->id, 'code' => $program->code], 'code' => 200], $this->successStatus);

        } catch (\Exception $exception) {
            return response()->json(['code' => 500, 'message' => 'Ocorreu um erro na requisição' . $exception->getMessage()], $this->successStatus);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        try {
            if (!Auth::check()) {
                response()->json(['code' => 403, 'message' => 'Você não tem acesso a essa função'], $this->successStatus);
            }

            if ($this->validateItens($request)) {
                return response()->json(['code' => 401, 'message' => 'Os dados estão incorretos.'], $this->successStatus);
            }

            $newProgram = $request->all();
            $program = $program->update($newProgram);
            return response()->json(['data' => ['status' => $program], 'code' => 200], $this->successStatus);

        } catch (\Exception $exception) {
            return response()->json(['code' => 500, 'message' => 'Ocorreu um erro na requisição'], $this->successStatus);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        try {
            if (!Auth::check()) {
                response()->json(['code' => 403, 'message' => 'Você não tem acesso a essa função'], $this->successStatus);
            }
            $program = $program->delete();
            return response()->json(['data' => ['status' => $program], 'code' => 200], $this->successStatus);
        } catch (\Exception $exception) {
            return response()->json(['code' => 500, 'message' => 'Ocorreu um erro na requisição'], $this->successStatus);
        }
    }

    public function validateItens(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
            'responsible_id' => 'exists:users,id'
        ]);
        return $validator->fails();
    }
}
