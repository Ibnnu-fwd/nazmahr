<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\EmployeeInterface;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $user;

    public function __construct(EmployeeInterface $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        return view('user.profile.index', [
            'user' => auth()->user()
        ]);
    }

    public function edit($id)
    {
        return view('user.profile.edit', [
            'user' => $this->user->getbyid($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name',
            'email',
            'password',
            'birth',
            'gender',
            'phone',
            'address',
            'ktp',
            'photo',
        ]);

        try {
            $this->user->update($id, $request->all());
            return redirect()->route('user.profile.index')->with('success', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('user.profile.index')->with('error', 'Data gagal diubah');
        }
    }
}
