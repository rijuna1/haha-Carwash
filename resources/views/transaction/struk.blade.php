<!DOCTYPE html>
<head>
    <title>{{$title}}</title>
</head>
<body>
    <div style="text-align: center; margin-bottom: 10px">
        <h1> =====&gt; HaHa CarWash &lt;===== </h1>
        <img src="data:image/png;base64,{{ base64_encode($qrcode) }}" alt="QR Code">
    </div>
    <table style="margin-left:auto;margin-right:auto">
        <tr style="font-size: 35px">
            <td>Name</td> <td>:</td> <td>{{$name}}</td>
        </tr>
        <tr style="font-size: 35px">
            <td>No Plat</td> <td>:</td> <td>{{$plat}}</td>
        </tr>
        <tr style="font-size: 35px">
            <td>Total Price</td> <td>:</td> <td>Rp. {{ number_format($total_price, 0, ',', '.') }}</td>
        </tr>
    </table>
    
    <h1 style="font-style: italic; text-align: center">Struk ini Wajib di bawa <br/> saat pengambilan kendaraan</h1>

    
    
</body>
</html>