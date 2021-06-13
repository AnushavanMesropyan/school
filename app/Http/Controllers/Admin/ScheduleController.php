<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Schedule::with(['teacher', 'classRoom'])->get();
        return view('admin.schedule.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = User::where('is_admin', '=', null)->get();
        $classRooms = ClassRoom::get();
        return view('admin.schedule.form', compact('teachers', 'classRooms'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'start' => 'required|before:end',
            'end' => 'required',
            'teacher_id' => 'required|exists:users,id',
            'class_room_id' => 'required|exists:class_rooms,id',
        ]);
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);
        if ($start->isWeekend() || $end->isWeekend()) {
            return redirect()->route('schedule.create')
                ->with('success', 'You have chosen a non-working day');
        }
        $already = Schedule::
        where(function ($query) use ($start, $end) {
            $query->where('start', '>=', $start)
                ->orWhere('end', '<=', $end);
        })
            ->where('end', '>=', $start)
            ->where(function ($query) use ($request) {
                $query->where('teacher_id', '=', $request->teacher_id)
                    ->orWhere('class_room_id', '=', $request->class_room_id);
            })
            ->first();
        if ($already) {
            return redirect()->route('schedule.create')
                ->with('success', 'Teacher busy.');
        }
        Schedule::create([
            'start' => $start,
            'end' => $end,
            'teacher_id' => $request->teacher_id,
            'class_room_id' => $request->class_room_id,
        ]);
        return redirect()->route('schedule.index')
            ->with('success', 'Teacher created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teachers = User::where('is_admin', '=', null)->get();
        $classRooms = ClassRoom::get();
        $item = Schedule::find($id);
        return view('admin.schedule.form', compact('item', 'teachers', 'classRooms'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'start' => 'required|before:end',
            'end' => 'required',
            'teacher_id' => 'required|exists:users,id',
            'class_room_id' => 'required|exists:class_rooms,id',
        ]);
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);
        if ($start->isWeekend() || $end->isWeekend()) {
            return redirect()->route('schedule.edit', ['schedule' => $id])
                ->with('success', 'You have chosen a non-working day');
        }
        $already = Schedule::
        where(function ($query) use ($start, $end) {
            $query->where('start', '>=', $start)
                ->orWhere('end', '<=', $end);
        })
            ->where('end', '>=', $start)
            ->where('id', '!=', $id)
            ->where(function ($query) use ($request) {
                $query->where('teacher_id', '=', $request->teacher_id)
                    ->orWhere('class_room_id', '=', $request->class_room_id);
            })
            ->first();
        if ($already) {
            return redirect()->route('schedule.edit', ['schedule' => $id])
                ->with('success', 'Teacher busy.');
        }
        $schedule = Schedule::find($id);

        $schedule->update($request->all());

        return redirect()->route('schedule.index')
            ->with('success', 'Schedule updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = Schedule::find($id);
        $schedule->delete();
        return redirect()->route('schedule.index')
            ->with('success', 'Schedule deleted successfully');
    }
}
