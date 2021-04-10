<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('created_at','desc')->get();
       return view('tasks.browse', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->email = $request->email;
        $task->contact = $request->contact;
        if($files=$request->file('images')){
            foreach($files as $file){
                $name = Str::random(20).'.'.$file->getClientOriginalExtension();
                $file->move('image',$name);
                $images[]=$name;
            }
        }
        if(isset($images)){
            $task->images = json_encode($images);
        }
        $task->save();
        return redirect(route('tasks.index'))->with('success','Done');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        return view('tasks.edit',compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task->title  = $request->title;
        $task->email = $request->email;
        $task->contact = $request->contact;
        $images = $task->images ? json_decode($task->images) : [];
        if($files=$request->file('images')){
            foreach($files as $file){
                $name = Str::random(20).'.'.$file->getClientOriginalExtension();
                $file->move('image',$name);
                $images[]=$name;
            }
        }
        if(isset($images)){
            $task->images = json_encode($images);
        }
        $task->update();
        return redirect(route('tasks.index'))->with('success','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        // this will delete images from storage
        if($task->image){
            foreach(json_decode($task->images) as $item){
                if(file_exists(public_path().'/image'.'/'.$item)){
                    unlink(public_path().'/image'.'/'.$item);
                }
            }
        }
        $task->delete();
        return 'done';
    }
}
