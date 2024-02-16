<x-app-layout>
    <style>
        .mws-main-wrapper{
            border:none;
        }
        .mws-main-body{
            padding: 0;
            margin:0;
        }
        h2.leading-tight{
            text-align: center !important;
            /*padding-top: 60px;*/
            line-height: 1.5;
            color: white;
            font-weight: 300;
            font-size: 32px;
        }
        p.p1.leading-tight{
            text-align: left !important;
            color: #010101;
            font-size: 20px;
            font-weight: 300;
            margin: 15px 0 0 0;
            width: 100%;
            display: inline-block;
        }
        p.p2.leading-tight{
            text-align: left !important;
            color: black;
            font-size: 12px;
            padding: 10px 0 10px;
        }
        .btns-block{
            /*text-align: left !important;*/
        }
        .btn-warning {
            float: right;
            padding: 1px 3px;
            font-size: 11px;
        }

        hr{
            border-top: 2px solid;
            opacity: 0.55;
            width: 50px;
            text-align: center;
            margin: 0 auto;
            color: white;
        }
        .row.cbo-row {
            position: absolute;
            top: 95%;
            left: 53%;
            transform: translate(-50%, -50%);
            width: 80%;
        }
        .row.cbo-row .btn-primary{
            padding: 8px 10px;
            border-radius: 1px;
            font-size: 12px;
            line-height: 1.3;
            letter-spacing: 0.2px;
            font-weight: 400;
        }
        .cbo{
            background: #DFF3EA;
            padding: 0px 0 20px 10px;
            border-radius: 3px;
            border: 8px solid #8080802b;
            width: 30%;
            margin: 0 10px;
        }
        .btn-warning{
            border-radius: 0;
            text-align: right;
        }
        .icon-div {
            width: 100%;
            display: inline-block;
        }
        .icon-div img{
            width: 45px;
            display: inline-block;
        }
        .art{
            background: #F1F4F4;
        }
        .acp{
            background: #EDEFD3;
        }
    </style>

        <div class="inner-dive">
            <div style="position: relative;">
                <img src="{{ asset('images/ins.png') }}" alt="Example Image" style="width: 100%; height: auto;">
                <div style="position: absolute; top: 35%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: white;">
                    <h2 class="font-semibold text-xl leading-tight">
                        <strong>All the Customized <br> Categories </strong>
                    </h2>
                    <hr>
                </div>
            </div>
        </div>
        <div class="row cbo-row">
        <div class="col-md-4 btns-block cbo">
            <a class="btn btn-warning ">  15+ CBOS    </a>
            <div class="icon-div">
                <img  src="{{ asset('images/cbo.png') }}" alt="cbo icon">
            </div>
            <p class="p1 font-semibold text-xl  leading-tight">
                <strong>CBOs </strong>
            </p>
            <p class="p2 font-semibold text-xl  leading-tight">
                Explore all the CBOs data by clicking button bellow
            </p>
            <a class="btn btn-primary " href="{!! route('cbo.index') !!}">  EXPLORE   > </a>
        </div>

        <div class="col-md-4 btns-block cbo art">
            <a class="btn btn-warning ">  13+ ART CENTERS </a>
            <div class="icon-div">
                <img  src="{{ asset('images/art.png') }}" alt="cbo icon" style="width:55px;vertical-align: baseline">
            </div>
            <p class="p1 font-semibold text-xl  leading-tight">
                <strong>ART Centers </strong>
            </p>
            <p class="p2 font-semibold text-xl  leading-tight">
                Explore all the ART Centers data by clicking button below
            </p>
            <a class="btn btn-primary " url="{!! route('city.index') !!}">  EXPLORE   > </a>
        </div>
        <div class="col-md-4 btns-block cbo acp">
            <a class="btn btn-warning ">  10+ ACPS    </a>
            <div class="icon-div">
                <img  src="{{ asset('images/acp.png') }}" alt="cbo icon">
            </div>
            <p class="p1 font-semibold text-xl  leading-tight">
                <strong>ACPs </strong>
            </p>
            <p class="p2 font-semibold text-xl  leading-tight">
                Explore all the ACPs data by clicking button below
            </p>
            <a class="btn btn-primary " url="{!! route('city.index') !!}">  EXPLORE   > </a>
        </div>
    </div>


</x-app-layout>
