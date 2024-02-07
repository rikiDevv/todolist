<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index', [
            "TodoItem" => Todo::with('user')->where('user_id',Auth::id())->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule_validasi = [
            'kegiatan' => 'required',
        ];

        $pesan_validasi = [
            'name.required' => 'Kegiatan harus di isi',
        ];

        $validatedData = $request->validate($rule_validasi, $pesan_validasi);
        $validatedData['user_id'] = Auth::id();

        Todo::create($validatedData);

        return redirect()->intended('/dashboard')->with('messageSuccess', 'Berhasil di buat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        return redirect('/dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $dashboard)
    {
        return view('form', [
            "todo" => $dashboard
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $dashboard)
    {
        $rule_validasi = [
            'kegiatan' => 'required',
        ];

        $pesan_validasi = [
            'name.required' => 'Kegiatan harus di isi',
        ];

        $validatedData = $request->validate($rule_validasi, $pesan_validasi);


        $dashboard->update($validatedData);

        return back()->with('messageSuccess', 'Berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $dashboard)
    {
        $dashboard->delete();

        return back()->with('messageSuccess', 'Berhasil dihapus');
    }
}
