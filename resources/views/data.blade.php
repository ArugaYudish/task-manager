<!DOCTYPE html>
<html>

<head>
    <title>Data from External API</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Data from External API</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $data['title'] }}</h5>
                <p class="card-text">Completed: {{ $data['completed'] ? 'Yes' : 'No' }}</p>
            </div>
        </div>
    </div>
</body>

</html>
