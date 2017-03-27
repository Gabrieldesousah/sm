<?php

namespace App\Http\Controllers;

use App\Material;
use App\Content;
use App\Professor;
use Illuminate\Http\Request;

class MaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contents = Content::all();
        $professors = Professor::all();
        return view('materials.share', 
            ['contents' => $contents,
             'professors' => $professors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $material = new Material($request->except(['file']));

        if( ! Content::find($request->content) ){
            $content = new Content();
            $content->name = $request->content;
            $content->area = $request->area;
            $content->save();
        }
        if( ! Professor::find($request->professpr) ){
            $professor = new Professor();

            $var = $request->professor;
            $var = str_replace(" VII" , " 7", $var);
            $var = str_replace(" VI"  , " 6", $var);
            $var = str_replace(" V"   , " 5", $var);
            $var = str_replace(" IV"  , " 4", $var);
            $var = str_replace(" III" , " 3", $var);
            $var = str_replace(" II"  , " 2", $var);
            $var = str_replace(" I"   , " 1", $var);

            $professor->name = $var;
            $professor->area = $request->area;
            $professor->save();
        }

        if( isset($_FILES['file']) and $_FILES['file'] != ""){
            $file = $_FILES['file'];


            $file_explode = explode('.',$_FILES['file']['name']);
            $file_name = $file_explode[0];
            $extent = strtolower(end($file_explode));
            
            $material->file = $file_name.'-'.md5(time()).'.'.$extent;

            if(move_uploaded_file(
                $file['tmp_name'], 
                $_SERVER['DOCUMENT_ROOT'] .
                "\storage" .
                "\materials" .
                '/'.
                basename($material->file)
            )){
                $material->save();
            }
        }
        
        return redirect('/materials/share')->with('status', 'Arquivo enviado com sucesso!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        $material =  Material::find($material);
        return view('materials.show', ['material' => $material]);
    }

    public function show_file($material)
    {
        $material  =  Material::find($material);
        $file_path = 'storage' . '/' .
                     'materials' . '/' .
                      $material->file;
        return view('materials.file', [
            'material' => $material, 
            'file_path' => $file_path
        ]);
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
