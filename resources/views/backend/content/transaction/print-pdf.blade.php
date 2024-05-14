<!doctype html>
<html lang="en">
<head>
    <title>Invoice {{$row->code}}</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 14pt;
    }

    .header {
        text-align: center;
    }

    .right {
        text-align: right;
    }

    table.data {
        border: 1px solid;
        width: 100%;
        border-collapse: collapse;
    }

    table.data > tbody > tr > td {
        border: 1px solid;
        padding: 5px;
    }

    table.data > thead > tr > th {
        border: 1px solid;
        background-color: #eaeaea;
        padding: 5px;
    }

    table.data > tbody > tr > th {
        border: 1px solid;
        background-color: #eaeaea;
        padding: 5px;
        text-align: left;
    }

</style>
<body>
<div class="header">
    <h1>Invoice Belanja</h1>
    <h2>{{$row->code}}</h2>
</div>
<hr>
<table class="data">
    <tr>
        <th>Nama Barang</th>
        <th>@</th>
        <th>Qty</th>
        <th>Total</th>
    </tr>
    @foreach($row->ItemTransaction as $item)
        <tr>
            <td>{{$item->Product->name}}</td>
            <td class="right">{{number_format($item->price)}}</td>
            <td class="right">{{$item->qty}}</td>
            <td class="right">{{number_format($item->price * $item->qty)}}</td>
        </tr>
    @endforeach
</table>
</body>
</html>
