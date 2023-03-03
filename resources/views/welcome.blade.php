<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <form class="form text-center pt-5" action="/upload" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image">
        <button type="submit">Upload</button>
    </form>
    @if($errors->any())

    @if($errors->first('img_err'))
    <div  class="alert alert-warning mt-2 text-center text-dark alert-box">
        <strong>{{$errors->first('img_err')}}</strong>
    </div>
    @endif
   
    @endif


    <script>
        const form = document.querySelector('.form');
        form.addEventListener('mouseover', () => {
            window.setTimeout(function() {
                document.querySelector('.alert-box').style.display = 'none';
            }, 1000);

        });
    </script>

</body>

</html>