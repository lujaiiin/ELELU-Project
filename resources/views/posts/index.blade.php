@extends('layouts.app')

@section('content')
<head>
    
    <link rel="stylesheet" href="{{ asset('css/posts1.css') }}"> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
  <div id="container">
    <div id="banner">
      <h1>EL EL U</h1>
    </div>
  <div id="navcontainer">
    <ul id="navlist">
      <li id="active"><a href="#" id="current">Home</a></li>
      <li><a href="/" class="button-86">Back </a></li>
    </ul>
  </div>
  <div class="search-box">
    <form id="searchForm" action="{{ route('search') }}" method="GET" class="d-flex align-items-center">
        <input type="text" class="form-control mr-sm-2" placeholder="Type to Search..." name="search">
        <button class="btn-search" type="submit"><i class="fas fa-search"></i></button>
    </form>
  </div>

  <div id="content">
    <h1>Welcome to <span style="font-weight:bold; color:#C4DA64;">EL EL U</span> Share Storys</h1>
    <div class="rbroundbox">
      <div class="rbcontent">
      <div class="container">
        <div class="rbcontent">
          @foreach($posts as $post)
            <h2>{{ $post->title }}</h2>
            <img class="imgleft" src="images/img/flower.jpg" alt="flower" />
            <blockquote><p>{{ $post->content }}</p></blockquote>
            <blockquote><img src="{{ $post->image }}"></img></blockquote>
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
              @csrf
              @method('DELETE')
                <button type="submit" class="btn">Delete</button>
            </form>
                <hr>
                <br>
                <br>
                <br>
          @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

<script>
  /**load js */
  window.addEventListener('load', function() {
      var banner = document.getElementById('banner');
      if (banner) {
          banner.classList.add('sticky');
      }
  });

  /**close js */
  document.getElementById('closeModal').addEventListener('click', function() {
      $('#modal').modal('close');
  });

  /** search*/
  document.querySelector('.btn-search').addEventListener('click', function(event) {
      event.preventDefault(); // Prevent the default action
      document.getElementById('searchForm').submit(); // Submit the search form
  });

  /**delete fun */
  $(document).ready(function() {
      $('.delete-post-btn').on('click', function(e) {
          e.preventDefault();
          var postId = $(this).data('id');
          $.ajax({
              url: '/posts/' + postId,
              type: 'DELETE',
              success: function(result) {
                  
              },
              error: function(error) {
                  // Handle error
              }
          });
      });
  });

</script>
</body>




