<?php

namespace App\Http\Controllers;

use App\Material;
use App\Content;
use App\Professor;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
    }

    public function index()
    {
        //index
        //teste
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
        return view('materials.share', [
            'contents' => $contents,
            'professors' => $professors
            ]);
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

        if( isset($_FILES['file']) and $_FILES['file'] != "" )
        {
            $file = $_FILES['file'];

            $file_explode = explode('.',$_FILES['file']['name']);
            $file_name = $file_explode[0];
            $extent = strtolower(end($file_explode));
            
            $material->file = $file_name.'-seumerito-'.md5(time()).'.'.$extent;

            if(move_uploaded_file(
                $file['tmp_name'], 
                $_SERVER['DOCUMENT_ROOT'] .
                "\storage" .
                "\materials" .
                '/'.
                basename($material->file)
            ))
            {

                if( Content::find($request->content) == null ){
                    $content = new Content();

                    $var = $request->content;
                    $var = str_replace(" VII" , " 7", $var);
                    $var = str_replace(" VI"  , " 6", $var);
                    $var = str_replace(" V"   , " 5", $var);
                    $var = str_replace(" IV"  , " 4", $var);
                    $var = str_replace(" III" , " 3", $var);
                    $var = str_replace(" II"  , " 2", $var);
                    $var = str_replace(" I"   , " 1", $var);

                    $content->name = $var;

                    $content->area = $request->area;
                    $content->save();
                }
                if( Professor::find($request->professor) == null){
                    $professor = new Professor();

                    $var = $request->professor;

                    $professor->name = $var;
                    $professor->area = $request->area;
                    $professor->save();
                }

                if( $material->save() ){
                    echo "material salvo";
                    return redirect('/materials/share')->with('status', 'Arquivo enviado com sucesso!');
                }

            } else {
                echo "Não moveu o arquivo";
                return redirect('/materials/share')->with('status', 'Não moveu o arquivo');
            }
        } else {
            echo "Não recebeu o arquivo";
            return redirect('/materials/share')->with('status', 'Não recebeu o arquivo');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        $user = Auth::user() ? Auth::user() : null;

        $material =  Material::find($material);

        $comments = DB::select('SELECT * FROM comments WHERE material_id = '.$material->id);

        return view('materials.show', [
            'material' => $material,
            'comments' => $comments,
            'user'     => $user
            ]);
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
