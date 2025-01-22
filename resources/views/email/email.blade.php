<!DOCTYPE html>
<html>

<head>
    <title>Your Documents</title>
</head>

<body>
    <p>Hi, Sharing profile and documents of</p>
    <br>
    <p>Case No: <span>343l34JSIELSI</span> </p>
    <p> Unique ID: <span>{{$userId}}</span>
    </p>

    <ul>
         @foreach($filePaths as $file)
            <li>{{ basename($file) }}</li>
            
        @endforeach
    </ul>

</body>

</html>