<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">

    <title>Ethical Form</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style>
        .page-break {
            page-break-after: always;
        }
        .text-right {
            text-align: right;
        }

        li{
            margin-bottom: 5px;
        }
        .container {
            margin-top: 1cm;
        }
    </style>

</head>
<body class="login-page" style="background: white">
<div class="container">
    <div class="text-center">
        <h1>{{ auth()->user()->name }}</h1>
    </div>
    <div class="text-center">
        <h4>Major project student's agenda records</h4>
    </div>

    <div style="margin: 20px; padding: 30px 70px ">
        <div class="row">
            <div class="col-xs-6 text-center">
                <h4><strong>COURSE:</strong></h4>
            </div>
            <div class="col-xs-6 text-center">
                <h4><strong>{{ auth()->user()->fields()->first()->name }}</strong></h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6 text-center">
                <h4><strong>MODULE:</strong></h4>
            </div>
            <div class="col-xs-6 text-center">
                <h4><strong> Dissertation (Major Project) </strong></h4>
            </div>
        </div>
    </div>

    <table class="table"  style="border-collapse:separate; border-spacing: 0 5px;">
    @forelse($diaries as $diary)

            <tbody>
            <tr style="background: #F5F5F5;">
                <td><strong>RECORD OF</strong></td>
                <td class="text-right"> <strong>{{ $diary->created_at->format('Y-M-d') }}</strong> </td>
            </tr>
            <tr>
                <td><div>TITLE:</div>
                <td style="border: 1px solid black" class="text-left">{{ ucfirst($diary->title) }}</td>
            </tr>
            <tr>
                <td><div>COMPLETED:</div>
                <td style="border: 1px solid black" class="text-left">{{ $diary->completed }}</td>
            </tr>
            <tr>
                <td><div>TO DO:</div>
                </td>
                <td style="border: 1px solid black; " class="text-left">{{ $diary->todo }}</td>
            </tr>
            <tr>
                <td><div>NOTES:</div>
                </td>
                <td style="border: 1px solid black; " class="text-left">{{ $diary->notes }}</td>
            </tr>
            </tbody>
            <br>
            <hr>
            <br>
    @empty
        <div>
            <h4 class="text-center">No diary records found.</h4>
        </div>
    @endforelse

    </table>
</div>

</body>
</html>
