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
<body>
    <div class="container">
        <h3>Add Details</h3>
        <form action="{{ route('tasks.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            <label for="title">Title</label>
            <input class="form-control" type="text" name="title">
            <label for="email">Email</label>
            <input class="form-control" type="text" name="email">
            <label for="contact">Contact</label>
            <input class="form-control" type="number" name="contact">
            <label for="images">Images</label>
            <input class="form-control" type="file" name="images[]" multiple>
            <br>
            <button class="btn btn-success">Submit</button>

        </form>
    </div>
</body>
</html>
