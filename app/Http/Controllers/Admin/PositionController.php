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
                ->addColumn('action', function ($data) {
                    return view('admin.position.column.action', ['data' => $data]);
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.position.index');
    }

    public function create()
    {
        return view('admin.position.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        try {
            $this->position->store($request->all());
            return redirect()->route('admin.position.index')->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('admin.position.index')->with('error', 'Data gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        return view('admin.position.edit', [
            'position' => $this->position->getById($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        try {
            $this->position->update($id, $request->all());
            return redirect()->route('admin.position.index')->with('success', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('admin.position.index')->with('error', 'Data gagal diubah');
        }
    }

    public function destroy($id)
    {
        try {
            $this->position->destroy($id);
            return redirect()->route('admin.position.index')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('admin.position.index')->with('error', 'Data gagal dihapus');
        }
    }
}
