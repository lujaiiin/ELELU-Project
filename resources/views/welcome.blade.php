<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>elelu</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
</head>
<body>

<header>
<div class="logo" style="background-image: url('{{ asset('images/Capture.PNG') }}');">
<button class="button-82-pushable" role="button">
  <span class="button-82-shadow"></span>
  <span class="button-82-edge"></span>
  <span class="button-82-front text">
  
   <a href="/sign" class="bt">Sign In</a> 
  </span>
</button>
</header>

<div class="container"> 
    <!-- First Row -->
    <div class="row"> 
        <!-- Button for Todo Route -->
        <a href="/tasks" class="button2">To_Do</a>

        <!-- Button for Blog Route -->
        <a href="/" class="button1">Blog</a>
    </div>

    <!-- Second Row -->
    <div class="row"> 
        <!-- Button for Todo Route -->
        <a href="/dailay" class="button">Daily</a>

        <!-- Button for Blog Route -->
        <a href="/posts" class="button3">View</a>
    </div>
</div>
</div>
</body>
</html>
