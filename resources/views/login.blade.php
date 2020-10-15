<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{config('app.name')}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
        body {
            color: #fff;
            background: #333333;

            overflow: hidden;
        }
        .btn {
            color: #fff;
            border: 1px solid #fff;
            background-color: none !important;
        }
        .btn:hover {
            color: #ccc;
        }
    </style>

</head>
<body>

    <br /><br /><br />
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <form action="{{url('authenticate')}}" method="POST" class="form-signin">
                @csrf
                <div class="text-center mb-4">
                    <!-- <img class="mb-4" src="/docs/4.5/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
                    <!-- <h1 class="h3 mb-3 font-weight-normal">Login - {{config('app.name')}}</h1> -->
                    <!-- <p><img  width= "300px" src="{{url('/images/logo-nova-white.png')}}" alt="" /></p> -->
                    <br>
                </div>

                <div class="form-group">
                    <input type="email" value="" name="email" id="inputEmail" class="form-control" placeholder="Login" required autofocus>
                </div>
                <div class="form-group">
                    <input type="password"  value="" name="password" id="inputPassword" class="form-control" placeholder="Senha" required>
                </div>
                <div class="checkbox mb-3">
                    <!-- <label>
                        <input type="checkbox" value="remember-me"> Esqueceu sua senha?
                    </label> -->
                </div>
                <div class="col-md-4 offset-md-4">
                    <button class="btn btn-lg btn-block" type="submit">Acessar</button>
                </div>
                <p class="mt-5 mb-3 text-muted text-center">&copy; 2020</p>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>