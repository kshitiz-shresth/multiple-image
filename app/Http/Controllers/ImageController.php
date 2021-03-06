<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function destroy(Request $request){
        $task = Task::find($request->taskID);
        $imageArray = json_decode($task->images);

        // deleting image from array $imageName stores array of only image which will be deleted but, imageArray is new array without that image
        $imageName = array_splice($imageArray, $request->arrayID-1, 1);

        // deleting image from storage
        if(file_exists(public_path().'/image'.'/'.$imageName[0]->name)){
            unlink(public_path().'/image'.'/'.$imageName[0]->name);
        }

        $task->images = json_encode($imageArray);
        $task->update();

        return 'done';
    }
}
