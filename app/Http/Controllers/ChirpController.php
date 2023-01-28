<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Termwind\Components\Dd;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return "hello world";
        return Inertia::render('Chirps/Index', [
            'chirps' => Chirp::all(),
            'chirps' => Chirp::with('user:id,name')->latest()->get(),
            // 'title' => 'Chirps',
            'name' => 'Rony Wahyu'
        ]);
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
        //
        // dd($request->all());
        // validate
        $validated = $request->validate([
            'message' => 'required|max:255'
        ]);

        // dd($request);

        // store
        $request->user()->chirps()->create($validated);

        // store without auth
        // Chirp::create($validated);

        // redirect
        return redirect()->route('chirps.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chirp  $chirp
     * @return \Illuminate\Http\Response
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chirp  $chirp
     * @return \Illuminate\Http\Response
     */
    public function edit(Chirp $chirp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chirp  $chirp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chirp $chirp)
    {
        //update
        $this->authorize('update', $chirp);
        $validated = $request->validate([
            'message' => 'required|max:255'
        ]);
        $chirp->update($validated);
        return redirect()->route('chirps.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chirp  $chirp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chirp $chirp)
    {
        //
        $this->authorize('delete', $chirp);

        $chirp->delete();

        return redirect()->route('chirps.index');
    }
}
