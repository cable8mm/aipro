<html>

<head>
    <style>
        body {
            font-size: 10pt;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            background: #000;
        }

        th,
        td {
            background: #fff;
        }

        .wrap {
            width: 1024px;
            margin: 0 auto;
        }

        .box {
            display: inline-block;
            text-align: center;
            width: 30%;
            float: left;
            padding: 10px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div class="wrap">
        @foreach ($barcodeCommands as $barcodeCommand)
            <div class="box">
                <div class="title">{{ $barcodeCommand->name }}</div>
                <div>
                    <img class="mx-auto" src="{{ route('generate-barcode', ['barcode' => $barcodeCommand->barcode]) }}">
                </div>
            </div>
        @endforeach
        @foreach ($boxes as $box)
            <div class="box">
                <div class="title">{{ $box->name }}</div>
                <div>
                    <img class="mx-auto"
                        src="{{ route('generate-barcode', ['barcode' => \App\Support\Gtin::ofBox($box->id)]) }}">
                </div>
            </div>
        @endforeach
    </div>
</body>

</html>
