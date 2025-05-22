<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Weather API</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: #f4f7f9;
            padding: 40px 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
            width: 100%;
            max-width: 400px;
            border: 1px solid #ccc;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background: #fff;
            margin-bottom: 30px;
        }

        form input {
            margin-bottom: 12px;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #bbb;
            border-radius: 6px;
        }

        form button {
            padding: 10px;
            font-size: 1em;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #0056b3;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            background: #fff;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            overflow: hidden;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        pre {
            margin: 0;
            font-family: inherit;
        }
    </style>
</head>

<body>
    <form action="{{ url('/weather') }}">
        <input type="text" name="city1" placeholder="Enter City 1">
        <input type="text" name="city2" placeholder="Enter City 2">
        <input type="text" name="city3" placeholder="Enter City 3">
        <button type="submit">Get Weather</button>
    </form>

    <table>
        <tr>
            <th>City 1</th>
            <th>City 2</th>
            <th>City 3</th>
        </tr>
        <tr>
            <td>
                <pre>{{ $city1 }}</pre>
            </td>
            <td>
                <pre>{{ $city2 }}</pre>
            </td>
            <td>
                <pre>{{ $city3 }}</pre>
            </td>
        </tr>
    </table>
</body>

</html>