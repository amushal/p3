<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Calculate product cost based on user input">
    <meta name="author" content="Ala Mushal">
    <title>Cost Calculator</title>

    <!-- Bootstrap core CSS -->

    <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/> -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href='/css/style.css' type='text/css' rel='stylesheet'>

</head>

<body class="bg-light">

<div class="container">

    <div class="py-5 text-center">
        <header>
            <img src='/images/cost.png' id='logo' alt='Cost Calculator Logo'/>
        </header>
        <h2>Pricing calculator</h2>
        <p class="lead">Plan Ahead, how much would it really cost.</p>
    </div>

    <div class="row">
        @yield('content')
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; {{ date('Y') }} Mushal.me</p>
    </footer>

</div>


</body>

</html>
