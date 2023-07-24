<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Categories</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            padding-top: 50px;
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        th {
            background-color: #333;
            color: #fff;
            text-align: left;
            padding: 10px;
            border: 1px solid #ddd;
        }

        td {
            border: 1px solid #ddd;
            padding: 10px;
        }
    </style>
</head>

<body>
    <h1>Categories</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
