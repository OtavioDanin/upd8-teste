<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cors</title>
</head>
<body>
    <output id="api"></output>
    <script>
        fetch('http://localhost:8001/api/clientes')
            .then(res => res.json())
            .then(res => document.getElementById('api').textContent = res.message)
            .catch(error => document.getElementById('api').textContent = error.message);
    </script>
</body>
</html>
{{-- <h1>{{$client}}</h1> --}}
