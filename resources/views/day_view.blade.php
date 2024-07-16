@extends('layouts.app')
@section('content')
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dai1.css') }}"> 
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container">
        
        <h1>ToDay story</h1>

        <form id="entryForm" action="/day/{{ $day_id }}" method="POST">
            @csrf

            <textarea id="new_entry" name="updated_entry" class="form-control" rows="5" placeholder="Write something...">@if(isset($latestEntry)){{ $latestEntry->content }}@endif</textarea>

                <button type="submit" class="btn btn-primary mt-3" id="save" value="update">{{ isset($latestEntry)? 'Update Entry' : 'Save Entry' }}</button>
                
        </form>


        <a href="/dailay" class="btn btn-primary mt-3">Back </a>

        <button id="publishBtn" class="btn btn-primary mt-3">Publish</button>

        <form id="publishForm" style="display:none;" action="/save-post" method="POST">
            @csrf
            <h2>Add Title:</h2>
            <input type="text" id="titleInput" name="title" placeholder="Title..." required>
            <textarea id="publishEntry" name="publish_entry" class="form-control" rows="5" placeholder="Your content here..." required></textarea>
            <button type="submit" id="publishSubmit" class="btn btn-primary">Publish</button>
            <button type="reset" id="cancelBtn" class="btn btn-secondary">Cancel</button>
        </form>
    </div>


<script>

/**publish js code  */

// Get the form element
var formElement = document.querySelector('form');

// Add an event listener for the form's submit event
formElement.addEventListener('submit', function(event) {
    // Prevent the default form submission behavior
    event.preventDefault();

    // Check if the Publish button was clicked
    if (event.submitter.id === 'publishSubmit') {
        // Logic for publishing
        // For example, show the publish form or send a publish request
        var publishForm = document.getElementById('publishForm');
        publishForm.classList.add('active');
        const entryContent = document.getElementById('new_entry').value;
        document.getElementById('publishEntry').value = entryContent;
        document.getElementById('titleInput').value = ''; // Optional: clear title input
    } else {
        formElement.submit();
    }
});

// Get the cancel button element
var cancelButton = document.getElementById('cancelBtn');

// Add an event listener for the cancel button's click event
cancelButton.addEventListener('click', function() {
    // Clear the form fields
    document.getElementById('titleInput').value = ''; // Clear title input
    document.getElementById('publishEntry').value = ''; // Clear content area

    // Hide the publish form
    var publishForm = document.getElementById('publishForm');
    publishForm.classList.remove('active'); // Removes the 'active' class to hide the form
});

// Additional logic for the Publish button
document.getElementById('publishBtn').addEventListener('click', function(event) {
    // Prevent the default action (which would be navigating away)
    event.preventDefault();

    // Show the publish form
    var publishForm = document.getElementById('publishForm');
    publishForm.classList.add('active');
    const entryContent = document.getElementById('new_entry').value;
    document.getElementById('publishEntry').value = entryContent;
    document.getElementById('titleInput').value = ''; // Optional: clear title input
});


</script>
</body>
@endsection
