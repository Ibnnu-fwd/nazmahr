<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\AnnouncementInterface;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    private $announcement;

    public function __construct(AnnouncementInterface $announcement)
    {
        $this->announcement = $announcement;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->announcement->getAll())
                ->addColumn('code', function ($data) {
                    return $data->code;
                })
                ->addColumn('subject', function ($data) {
                    return $data->subject;
                })
                ->addColumn('attachment', function ($data) {
                    return view('admin.announcement.column.attachment', compact('data'));
                })
                ->addColumn('is_send_email', function ($data) {
                    return $data->is_send_email ? 'Ya' : 'Tidak';
                })
                ->addColumn('is_active', function ($data) {
                    return $data->is_active ? 'Aktif' : 'Non Aktif';
                })
                ->addColumn('created_at', function ($data) {
                    return $data->created_at->format('d-m-Y H:i') . ' WIB';
                })
                ->addColumn('action', function ($data) {
                    return view('admin.announcement.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.announcement.index');
    }

    public function create()
    {
        return view('admin.announcement.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject'       => 'required',
            'content'       => 'nullable',
            'attachment'    => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
            'is_send_email' => 'nullable',
            'is_active'     => 'required',
        ]);

        try {
            $this->announcement->store($request->all());
            return redirect()->route('admin.announcement.index')->with('success', 'Berhasil menambahkan data pengumuman');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('admin.announcement.index')->with('error', 'Gagal menambahkan data pengumuman');
        }
    }

    public function edit($id)
    {
        $announcement = $this->announcement->getById($id);
        return view('admin.announcement.edit', compact('announcement'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'subject'       => 'required',
            'content'       => 'nullable',
            'attachment'    => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
            'is_send_email' => 'nullable',
            'is_active'     => 'required',
        ]);

        try {
            $this->announcement->update($id, $request->all());
            return redirect()->route('admin.announcement.index')->with('success', 'Berhasil mengubah data pengumuman');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('admin.announcement.index')->with('error', 'Gagal mengubah data pengumuman');
        }
    }

    public function destroy($id)
    {
        $this->announcement->destroy($id);
        return response()->json(true);
    }
}
