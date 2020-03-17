<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class CourseController extends Controller
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
            return response()->json(['code' => 200, 'data' => (new Course())->getCourseList()], $this->successStatus);
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

            if ((new Course())->checkCourseExists($request->name)) {
                return response()->json(['code' => 400, 'message' => 'Já existe um curso com esse nome.'], $this->successStatus);
            }

            $course = $request->only(['name', 'code', 'status', 'credit', 'period']);
            $programs = $request->only(['programsItens'])['programsItens'];
            $course['code'] = $course['name'] . date_create()->format('Ym');
            $course = Course::create($course);
            foreach ($programs as $program) {
                $course->program()->attach($program['program_id']);
            }
            return response()->json(['data' => ['key' => $course->id, 'code' => $course->code], 'code' => 200], $this->successStatus);

        } catch (\Exception $exception) {
            return response()->json(['code' => 500, 'message' => 'Ocorreu um erro na requisição'], $this->successStatus);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }

    public function validateItens(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required'
        ]);
        return $validator->fails();
    }
}
