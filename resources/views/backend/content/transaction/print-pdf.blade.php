<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction List</title>
    <style>
        /* Add your custom styles for the PDF here */
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h1>Transaction List</h1>
<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Kode</th>
        <th>Nama Pelanggan</th>
        <th>Tanggal</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @php
        $totalSemuaTransaksi = 0;
    @endphp
    @foreach($rows as $index => $row)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $row->code }}</td>
            <td>{{ $row->customer_name }}</td>
            <td>{{ $row->date }}</td>
            <td>Rp {{ $row->total }}</td>
        </tr>
        @php
            $totalSemuaTransaksi += $row->total;
        @endphp
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th colspan="4">Total</th>
        <th>Rp {{ $totalSemuaTransaksi }}</th>
    </tr>
    </tfoot>
</table>
</body>
</html>
