<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap CRUD Data Table for Database with Modal Form</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
    .multiple-images{
        display: flex;
    }
    .multiple-images span{
        height: 100px;
        width: 100px;
        margin-right: 4px;
        border: 2px #d41812 solid;
        position: relative;
    }
    .image{
        height: 100%;
        width: 100%;
    }
    .multiple-images span .delete{
        position: absolute;
        right: -1px;
    }
</style>
<body>
    <div class="container">
        <h3>Add Details</h3>
        <form action="{{ route('tasks.update',$task->id) }}"  enctype="multipart/form-data" method="post">
            @csrf
            @method('put')
            <label for="title">Title</label>
            <input class="form-control" type="text" value="{{ $task->title }}" name="title">
            <label for="email">Email</label>
            <input class="form-control" type="text" value="{{ $task->email }}" name="email">
            <label for="contact">Contact</label>
            <input class="form-control" type="number" value="{{ $task->contact }}" name="contact">
            <label for="images">Images</label>
            @if($task->images)
            <div class="multiple-images">
                @foreach (json_decode($task->images,true) as $item)
                    <span>
                        <img class="image" src="/image/{{ $item }}" alt="">
                        <a onclick="deleteImage({{ $loop->iteration }},{{ $task->id }});" class="delete btn btn-danger"><i class="material-icons" data-toggle="tooltip" title="" data-original-title="Delete" aria-describedby="tooltip290885"></i></a>
                    </span>
                @endforeach
            </div>
            @endif
            <input class="form-control" type="file" name="images[]" multiple>
            <br>
            <button type="submit" class="btn btn-success">Submit</button>

        </form>
    </div>
</body>
<script>
    function deleteImage(arrayID,taskID){
        console.log(`${arrayID}, ${taskID}`);
        if (confirm("Are you sure?")) {
            $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: "{{ route('images.destroy') }}",
                    type: "POST",
                    data: {
                        arrayID: arrayID,
                        taskID: taskID
                    },
                    beforeSend: function () {
                    },
                    success: function(data){
                        window.location.replace("{{ route('tasks.edit',$task->id) }}");
                        console.log(data);
                    }
                });
        }
        return false;
    }
</script>
</html>
