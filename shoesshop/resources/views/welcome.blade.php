<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
{{-- 
    <link rel="stylesheet" href="{{asset('public/frontend/css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/animate.css')}}">
    
    <link rel="stylesheet" href="{{asset('public/frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('public/frontend/css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('public/frontend/css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('public/frontend/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/jquery.timepicker.css')}}">

    
    <link rel="stylesheet" href="{{asset('public/frontend/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/style.css')}}"> --}}

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Dropdown </h2>
            <div class="form-group">
                <label for="size">Select size</label>
                <select name="size" id="size" class="form-control">
                    <option value="">Size</option>
                    @foreach($sizes as $key => $value)
                        <option value="{{$value->ctsp_kichCo}}">{{$value->ctsp_kichCo}}</option>
                    @endforeach
                </select>
                
            </div>
             <div class="form-group">
                <label for="size">Select stock number</label>
                <select name="stock" id="stock" class="form-control">
                    <option value="">Stock</option>
                   {{--  @foreach($stocks as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                    @endforeach --}}
                </select>
                
            </div>
        </div>
       
        

    <script src="http://www.codermen.com/js/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('select[name="size"]').on('change',function(){
                var size_id = $(this).val();
                console.log(size_id);

                if(size_id){

                    $.ajax({

                        url: "{{url('getStock')}}?size_id="+size_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data){
                            console.log(data);
                             $('select[name="stock"]').empty();
                             $.each(data, function(name,stock){
                                $('select[name="stock"]').append('<option value="'+stock+'">'+stock+'</option>');
                             });
                        }
                    });
                }else{
                     $('select[name="stock"]').empty();
                }
            });
        });
    </script>
    </body>
</html>
