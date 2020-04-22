<?php

namespace App\Http\Controllers;

use App\Clazz;
use App\ClazzTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ClazzController extends Controller
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
            $clazzList = (new Clazz())->getClazzList();
            return response()->json(['code' => 200, 'data' => $clazzList], $this->successStatus);
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
            $input = $request->except('id');
            $input['name'] = $input['course']['name'] . (date_create())->format('Ym');
            $input['course_id'] = $input['course']['id'];
            $input['master_id'] = $input['master']['id'];
            $filterDate = $request->only(['filterDate'])['filterDate'];
            $input['initial_date'] = $filterDate[0];
            $input['end_date'] = $filterDate[1];
            $clazz = Clazz::create($input);
            if ($request->has('weekdays') && $request->has('filterDate')) {
                $weekdays = $request->only(['weekdays'])['weekdays'];
                foreach ($weekdays as $weekday) {
                    $dates = $this->getMondaysInRange($filterDate[0], $filterDate[1], $weekday['id']);
                    foreach ($dates as $date) {
                        ClazzTime::create(
                            [
                                'clazz_id' => $clazz->id,
                                'weekday' => $weekday['id'],
                                'initial_time' => $input['initialTime'],
                                'end_time' => $input['endTime'],
                                'clazz_day' => $date
                            ]
                        );
                    }
                }
            }

            return response()->json(['data' => ['key' => $clazz->id, 'name' => $clazz->name], 'code' => 200], $this->successStatus);
        } catch (\Exception $exception) {
            return response()->json(['code' => 500, 'message' => 'Ocorreu um erro na requisição'], $this->successStatus);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clazz  $clazz
     * @return \Illuminate\Http\Response
     */
    public function show(Clazz $clazz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clazz  $clazz
     * @return \Illuminate\Http\Response
     */
    public function edit(Clazz $clazz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clazz  $clazz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clazz $clazz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clazz  $clazz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clazz $clazz)
    {
        //
    }

    public function getMondaysInRange($dateFromString, $dateToString, $weekday)
    {
        $dateFrom = new \DateTime($dateFromString);
        $dateTo = new \DateTime($dateToString);
        $dates = [];

        if ($dateFrom > $dateTo) {
            return $dates;
        }

        if (ClazzTime::$weekdays[$weekday] != $dateFrom->format('N')) {
            $dateFrom->modify('NEXT '. $weekday);
        }

        while ($dateFrom <= $dateTo) {
            $dates[] = $dateFrom->format('Y-m-d');
            $dateFrom->modify('+1 week');
        }

        return $dates;
    }
}
