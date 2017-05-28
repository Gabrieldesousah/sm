<?php

namespace App\Http\Controllers;

use App\Material;
use App\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 
        $keywords = Search::select('keywords', DB::raw('COUNT(keywords) AS count'))
            ->groupBy('keywords')
            ->orderBy('count', 'desc')
            ->paginate(30);

        return view('materials.searches')->with('keywords', $keywords);
    }

    public function key(Request $request)
    {

        $user_id = Auth::user() ? Auth::user()->id : null;

        $search = new Search();
        $search->keywords = $request->input("key");
        $search->user_id = $user_id;
        $search->save();

        $search = $_GET['key'];

        $materials = DB::table('materials')
            ->where("content", "like", "%$search%")
            ->orWhere("professor", "like", "%$search%")
            ->orWhere("description", "like", "%$search%")
            ->orWhere("college", "like", "%$search%")
            ->orWhere("id", "$search")
            ->get();

       /* $materials = DB::select("
        SELECT * FROM materials WHERE
            content LIKE '%$search%' OR
            professor LIKE '%$search%' OR
            description LIKE '%$search%' OR
            college LIKE '$search'    
        ");
        */

        return view('materials.search', ['search' => $search, 'materials' => $materials]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        //
    }
}
