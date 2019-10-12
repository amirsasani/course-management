<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>سوالات {{ $exam->title }} درس {{ $exam->course->title }}</title>
</head>

<style>
    .rtl {
        direction: rtl;
        text-align: right;
    }

    html, body, .container-fluid{
        background-color: #fff;
    }

    .container-fluid {
        border: 3px solid #000;
    }

    hr {
        border-top: 3px solid rgba(0, 0, 0, 1);
        margin-left: -15px;
        margin-right: -15px;
    }

    .choices-table td span{
        width: 30px;
        height: 30px;
        border: 4px solid #000;
        -webkit-border-radius: 100%;
        -moz-border-radius: 100%;
        border-radius: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .table.choices-table td, .table.choices-table th {
        padding: 3px !important;
        vertical-align: center;
    }

    @media print {
        .page-break {
            page-break-after: always;
        }

        #print {
            display: none;
        }
    }
</style>

<body>

<div class="row">
    <div class="col justify-content-center d-flex">
        <button id="print" onclick="window.print();" class="w-75 my-3 btn btn-success">چاپ سوال</button>
    </div>
</div>

<div class="container-fluid rtl">
    <div class="row">
        <div class="col text-center">
            <h3 class="pt-4">سوالات {{ $exam->title }} درس {{ $exam->course->title }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col d-flex justify-content-start">
            <div id="name">
                <span>نام و نام خانوادگی: </span>
                <span>......................................................................</span>
                <br><br><br><br>
                <span>شماره دانشجویی: </span>
                <span>........................................................................</span>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col">
            @php $question_number = 1; @endphp

            @foreach($questions as $title => $choices)
                <p><span class="font-weight-bold">{{ $question_number }}- </span> {{ $title }}</p>
                <div class="row">
                    <div class="col">
                        <table class="table w-100">
                            <tbody>
                            @foreach($choices as $index => $choice)
                                <td><span class="font-weight-bold">{{ $index+1 }}) </span> {{ $choice->title }}</td>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                @php $question_number++; @endphp
            @endforeach
        </div>
    </div>
</div>

<div class="page-break"></div>


<div class="container-fluid rtl">

    <div class="row">
        <div class="col text-center">
            <h3 class="pt-4">پاسخنامه {{ $exam->title }} درس {{ $exam->course->title }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col d-flex flex-row-reverse justify-content-between">
            <div id="qrcode">
                {!! QrCode::size(150)->generate(json_encode($correct_choices)); !!}
            </div>
            <div id="name" class="align-self-center">
                <span>نام و نام خانوادگی: </span>
                <span>......................................................................</span>
                <br><br><br><br>
                <span>شماره دانشجویی: </span>
                <span>........................................................................</span>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col">
            @foreach(range(26, 50) as $number)
                <table class="table w-100 choices-table">
                    <tbody>
                    <td style="width: 80px;"><span>4</span></td>
                    <td style="width: 80px;"><span>3</span></td>
                    <td style="width: 80px;"><span>2</span></td>
                    <td style="width: 80px;"><span>1</span></td>

                    <td style="width: 50px; font-weight: bolder;">- {{ $number }}</td>
                    </tbody>
                </table>
            @endforeach
        </div>
        <div class="col">
            @foreach(range(1, 25) as $number)
                <table class="table w-100 choices-table">
                    <tbody>
                    <td style="width: 80px;"><span>4</span></td>
                    <td style="width: 80px;"><span>3</span></td>
                    <td style="width: 80px;"><span>2</span></td>
                    <td style="width: 80px;"><span>1</span></td>

                    <td style="width: 50px; font-weight: bolder;">- {{ $number }}</td>
                    </tbody>
                </table>
            @endforeach
        </div>
    </div>

</div>

</body>
</html>
