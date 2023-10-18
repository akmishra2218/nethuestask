<!DOCTYPE html>
<html>
<head>
    <title>Historical Data</title>
</head>
<body>
    <h1 style="text-align: center">Historical Data</h1>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Open</th>
                <th>High</th>
                <th>Low</th>
                <th>Close</th>
                <th>Volume</th>
            </tr>
        </thead>
        <tbody>
            @isset($historicalData)
            @foreach ($historicalData as $data)
                <tr>
                    <td>{{ $data['date'] ?? 'N/A' }}</td>
                    <td>{{ $data['open'] ?? 'N/A' }}</td>
                    <td>{{ $data['high'] ?? 'N/A' }}</td>
                    <td>{{ $data['low'] ?? 'N/A'}}</td>
                    <td>{{ $data['close'] ?? 'N/A'}}</td>
                    <td>{{ $data['volume'] ?? 'N/A'}}</td>
                </tr>
            @endforeach  
            
            @else 
            <a href="{{ route('addCompany') }}">Add Company Symbol</a>

            @endisset
        </tbody>
    </table>
</body>
</html>
