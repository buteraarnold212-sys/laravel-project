<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>page to view all students</h2>

    <table border="1">
        <tr>
            <td>name</td>
            <td>adress</td>
            <td>trade</td>
            <td>level</td>
        </tr>
        @foreach ($students as $student)
        <tr>
            
            <td>
               {{$student->name}}
            </td>
            <td>
                {{$student->adress}}
            </td>
            <td>
              {{$student->trade}}
            </td>
            <td>
               {{$student->level}}
            </td>
            @endforeach
        </tr>
        
    </table>
</body>
</html>