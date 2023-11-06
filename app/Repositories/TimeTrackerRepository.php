<?php

namespace App\Repositories;

use App\Interfaces\TimeTrackerInterface;
use App\Models\TimeTracker;
use Carbon\Carbon;

class TimeTrackerRepository implements TimeTrackerInterface
{
    private $timeTracker;

    public function __construct(TimeTracker $timeTracker)
    {
        $this->timeTracker = $timeTracker;
    }

    public function getAll()
    {
        return $this->timeTracker->with('user')->get();
    }

    public function getById($id)
    {
        return $this->timeTracker->with('user')->find($id);
    }

    public function store($data)
    {
        return $this->timeTracker->create($data);
    }

    public function update($id, $data)
    {
        $data['total_time'] = Carbon::parse($data['start_time'])->diffInMinutes(Carbon::parse($data['end_time']));
        return $this->timeTracker->find($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->timeTracker->find($id)->delete();
    }

    public function start($id)
    {
        $timeTracker = $this->timeTracker->find($id);
        return $timeTracker->update([
            'start_time' => Carbon::now('Asia/Jakarta'),
        ]);
    }

    public function stop($id)
    {
        $timeTracker = $this->timeTracker->find($id);
        $start_time  = $timeTracker->start_time;
        $end_time    = Carbon::now('Asia/Jakarta');
        return $timeTracker->update([
            'end_time'   => $end_time,
            'total_time' => Carbon::parse($start_time)->diffInMinutes($end_time),
        ]);
    }

    public function continue($id)
    {
        return $this->timeTracker->find($id)->update([
            'end_time'   => null,
            'total_time' => null,
        ]);
    }
}
