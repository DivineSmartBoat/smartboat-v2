<!DOCTYPE html>
<html>
<head>
    <title>Purchase Import</title>

    <style>
        body{
            font-family:Arial;
            margin:40px;
            background:#f5f5f5;
        }

        .card{
            width:600px;
            margin:auto;
            background:#fff;
            padding:30px;
            border-radius:8px;
            box-shadow:0 0 10px rgba(0,0,0,.15);
        }

        h2{
            text-align:center;
            margin-bottom:25px;
        }

        input[type=file]{
            width:100%;
            padding:12px;
        }

        button{
            margin-top:20px;
            width:100%;
            background:#28a745;
            color:white;
            border:none;
            padding:14px;
            cursor:pointer;
            font-size:16px;
        }

        button:hover{
            background:#218838;
        }

        .success{
            background:#d4edda;
            color:#155724;
            padding:10px;
            margin-bottom:15px;
        }
    </style>

</head>
<body>

<div class="card">

    <h2>Purchase CSV Import</h2>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('purchase.import.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <input
            type="file"
            name="file"
            accept=".csv,.xlsx,.xls"
            required>

        <button type="submit">
            Import Purchase Report
        </button>

    </form>

</div>

</body>
</html>