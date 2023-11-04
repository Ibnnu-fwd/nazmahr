<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\PositionInterface;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    private $position;

    public function __construct(PositionInterface $position)
    {
        $this->position = $position;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->position->getAll())
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('action', function () {
                    return  '';
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.position.index');
    }
}
