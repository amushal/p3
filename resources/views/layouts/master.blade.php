<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Calculate product cost based on user input">
    <meta name="author" content="Ala Mushal">
    <title>Cost Calculator</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body class="bg-light">

<div class="container">

    <div class="py-5 text-center">
        <h2>Cost Calculator</h2>
        <p class="lead">Calculate the total cost and monthly payments.</p>
    </div>
    <div class="row">
        @yield('content')
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2018 Mushal.me</p>
    </footer>

</div>


</body>

</html>
