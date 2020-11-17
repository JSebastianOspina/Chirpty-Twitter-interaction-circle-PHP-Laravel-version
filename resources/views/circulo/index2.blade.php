<!DOCTYPE html>
<!-- saved from url=(0020)https://chirpty.com/ -->
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" href="https://chirpty.com/favicon.ico">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="https://chirpty.com/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://chirpty.com/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://chirpty.com/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta name="description" content="Encuentra tus mejores amigos de Twitter">

    <title>Chirpty</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <style media="screen">
        .root,body,html{height:100%;background-color:#f5f5f5}.fh{height:100%}.btn.disabled{opacity:.2!important}.bmc-button img{height:24px!important;width:25px!important;margin-bottom:1px!important;box-shadow:none!important;border:none!important;vertical-align:middle!important}.bmc-button{line-height:25px!important;display:inline-flex!important;background-color:#5f7fff!important;border-radius:5px!important;border:1px solid transparent!important;padding:7px 15px 7px 10px!important;font-size:22px!important;letter-spacing:.6px!important;box-shadow:0 1px 2px hsla(0,0%,74.5%,.5)!important;margin:0 auto!important;box-sizing:border-box!important;white-space:nowrap}.bmc-button,.bmc-button:active,.bmc-button:focus,.bmc-button:hover{text-decoration:none!important;color:#fff!important;-webkit-box-shadow:0 1px 2px 2px hsla(0,0%,74.5%,.5)!important}.bmc-button:active,.bmc-button:focus,.bmc-button:hover{box-shadow:0 1px 2px 2px hsla(0,0%,74.5%,.5)!important;opacity:.85!important}.result{max-width:600px;min-width:300px;margin:auto}@media (max-width:420px){.result a{font-size:12px;margin-bottom:1ch}}canvas{max-width:100%}

        </style>
</head>

<body>
    <div id="root" class="root">
        <div class="text-center align-items-center d-flex justify-content-center fh flex-column ">
            <div class="flex-fill"></div>
            
            <div class="mt-5">
                <h1>Chirpty</h1>
                <p>Crea tu propio círculo de interacción en Twitter</p>
                <form action="{{route('generar')}}" method="GET">
                    <label for="color" class="mr-4" >Selecciona un color para la imagen</label>
                    <input type="color" name="color" id="color" value="#c5edce">
                            <button
                        class="btn btn-lg btn-primary btn-block mt-4 text-white" type="submit" >Generar círculo</button>
                </form>
                
            </div>
            <div class="flex-fill"></div>

            <div class="flex-fill"></div>
            <div class="pb-5 text-center"><a class="mr-4"
                    href="#">FAQ</a><a href="#" class="mr-4">Blog</a>
              <a
                    href="#">Privacy Policy</a>
            </div>
        </div>
    </div>

</body>

</html>
