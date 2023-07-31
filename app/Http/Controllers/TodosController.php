<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class TodosController extends Controller
{
    /**
     * index mustrata todo el contenido de un todo
     * store crea un todo
     * update actualiza unn todo
     * destroy para eliminar un todo
     * edit muestra el formulario del todo
     */

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|min:4|unique:todos,title'
        ]);

        Todo::create([
            'title' => $request->title,
            'category_id'=> $request->category_id
        ]);

        return redirect()->route('storeTodo')->with('success', 'Tarea creada correctamente');
    }

    public function index()
    {
        $todos = Todo::all();
        $categories = Category::all();

        return view('todos.index', ['todos' => $todos,'categories' => $categories]);
    }

    public function edit(Request $request,$id)
    {
        $request->validate([
            'title'=> 'required|string|min:4|unique:todos,title'
        ]);

        Todo::where('id',$id)
            ->update([
                'title'=>$request->title
            ]);

        return redirect()->route('storeTodo')->with('success', 'Tarea actualizada correctamente');
    }

    public function destroy($id)
    {
        try {
            $todo = Todo::find($id);
            $todo->delete();
            return redirect()->route('storeTodo')->with('success', 'Tarea eliminada correctamente');
        }catch (Throwable $e){
            return redirect()->route('storeTodo')->with('error', 'Tenemos problemas, reintente mas tarde...');
        }
    }

    public function show($id)
    {
        $todo = Todo::find($id);

        return view('todos.show',['todo'=>$todo]);
    }
}
