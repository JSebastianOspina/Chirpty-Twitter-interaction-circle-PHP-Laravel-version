<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>


<body>
    <div class="container-fluid" style="background-color: #f5f5f5">
        <div class="row pt-2">
            <div class="col"></div>
            <div class=" col-sm-5 text-right ">
                <a href="/imagenes/{{$rand}}.png" class="btn btn-primary" download="{{$rand}}">Descargar</a>
            </div>
            <div class="col"></div>
        </div>

        <div class="row mt-2">


            <div class="col-12 text-center" style="overflow: hidden">

                <img src="http://chirpty.me/imagenes/{{$rand}}.png" style="max-height: 80vh; max-width:90vw" />

            </div>


        </div>

        <div class="row mt-2">
            <div class="col"></div>

            <div class="col-12 col-md-5 ">
                <div class="row">
                    <div class="col text-left ">
                        <h4>Primer circulo</h4>
                        @foreach ($circulo_uno as $item)
                        <a class="d-block" href="https://twitter.com/{{$item['username']}}">@ {{$item['username']}}</a>

                        @endforeach
                        
                    </div>
                    <div class="col text-left">
                        <h4>Segundo circulo</h4>
                        @foreach ($circulo_dos as $item)
                        <a class="d-block" href="https://twitter.com/{{$item['username']}}">@ {{$item['username']}}</a>

                        @endforeach

                    </div>
                    <div class="col text-left ">
                        <h4>Tercer circulo</h4>
                        @foreach ($circulo_tres as $item)
                        <a class="d-block" href="https://twitter.com/{{$item['username']}}">@ {{$item['username']}}</a>

                        @endforeach
                    </div>
                </div>

            </div>

            <div class="col"></div>

        </div>



    </div>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>

</body>

</html>