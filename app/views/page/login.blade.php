<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>JMG Login</title>
        <!-- Bootstrap core CSS -->
        <link href="{{URL::to('css/yeti.css')}}" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="{{URL::to('css/signin.css');}}" rel="stylesheet">
        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <form class="form-signin" action="{{URL::to('/login')}}" method="POST" role="form">
                <h2 class="form-signin-heading">Please sign in</h2>
                <input type="text" class="form-control" placeholder="Email Address" name="email" required autofocus value="{{Input::old('email')}}" />
                <input type="password" class="form-control" placeholder="Password" name="password" value="{{Input::old('password')}}" required />
                <label class="checkbox">
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            </form>
        </div> <!-- /container -->
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="{{URL::to('js/ie10-viewport-bug-workaround.js');}}"></script>
    </body>
</html>
