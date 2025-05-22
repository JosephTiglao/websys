<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>OpenRouteService Direction & Geocode API</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e6f4ea;
            color: #0b5d0b;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0 100px;
        }


        h1 {
            margin-bottom: 1rem;
            text-align: center;
            color: #0b5d0b;
        }

        h3 {
            text-align: center;
            color: #0b5d0b;
        }

        form {
            padding: 20px 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(11, 93, 11, 0.2);
            width: 320px;
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
        }

        input {
            box-sizing: border-box;
            width: 100%;
            padding: 8px 10px;
            border: 2px solid #0b5d0b;
            border-radius: 4px;
            font-size: 1rem;
        }

        input:focus {
            outline: none;
            border-color: #2f8f2f;
            background-color: #f0fff0;
        }

        button {
            background-color: #0b5d0b;
            color: #fff;
            font-weight: bold;
            padding: 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2f8f2f;
        }

        p {
            color: #a72b2b;
            font-size: 0.9rem;
            margin-top: 4px;
        }

        .place {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }

        table {
            margin-top: 30px;
            width: 100%;
            max-width: 800px;
            border-collapse: collapse;
            box-shadow: 0 0 15px rgba(11, 93, 11, 0.15);
        }

        th,
        td {
            border: 1px solid #147014;
            padding: 10px 15px;
            text-align: left;
        }

        thead {
            background-color: #0b5d0b;
            color: #fff;
        }

        tbody tr:nth-child(even) {
            background-color: #d0ebd6;
        }

        tbody tr:hover {
            background-color: #b5ddb0;
            transition: background-color 0.3s ease;
        }

        td:nth-child(2),
        td:nth-child(3) {
            font-family: monospace;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1>OpenRouteService</h1>
        <h3>Direction and Geocode API</h3>

        <form action="{{ url('/routes') }}" method="post">
            @csrf
            @error('route')
            <p>{{ $message }}</p>
            @enderror
            <div>
                <label for="start">Location</label>
                <input type="text" id="start" name="start" value="{{ old('start') }}">
                @error('start')
                <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="end">Destination</label>
                <input type="text" id="end" name="end" value="{{ old('end') }}">
                @error('end')
                <p>{{ $message }}</p>
                @enderror
            </div>

            <button type="submit">Get Routes</button>
        </form>
    </div>

    <div class="table-container">
        @if (!empty($steps))
        <div class="place">
            <h3>Start: {{ ucfirst(strtolower($start)) }}</h3>
            <h3>End: {{ ucfirst(strtolower($end)) }}</h3>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Instruction</th>
                    <th>Distance (m)</th>
                    <th>Duration (sec)</th>
                    <th>Road Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($steps as $step)
                <tr>
                    <td>{{ $step['instruction'] }}</td>
                    <td>{{ number_format($step['distance'], 1) }}</td>
                    <td>{{ number_format($step['duration'], 1) }}</td>
                    <td>{{ $step['name'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</body>

</html>