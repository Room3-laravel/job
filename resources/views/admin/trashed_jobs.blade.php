<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>All trashed jobs</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
    rel="stylesheet">
  <style>
    * {
      font-family: "Lato", sans-serif;
    }
  </style>
</head>

<body>
  <main>
    <div class="container my-5">
        <a href="{{ route('jobs.index') }}">jobs</a>
      <div class="bg-light p-5 rounded">
        <h2 class="fw-bold fs-2 mb-5 pb-2">All trashed jobs</h2>
        <table class="table table-hover">
          <thead>
            <tr class="table-dark">
              <th scope="col">title</th>
              <th scope="col">job Nature</th>
              <th scope="col">location</th>
              <th scope="col">date line</th>
              <th scope="col">Published</th>
              <th scope="col">category name</th>
              <th scope="col">Restore</th>
              <th scope="col">Permenant delete</th>


            </tr>
          </thead>
          <tbody>
            @foreach($jobs as $job )
            <tr>
              <td scope="row">{{$job['title']}}</td>
              <td scope="row">{{$job['job_nature']}}</td>
              <td scope="row">{{$job['location']}}</td>
              <td scope="row">{{$job['date_line']}}</td>
              <td>{{($job['published'] == 1) ? "yes" : "no"}}</td>
              <td>{{$job->category->category_name}}</td>
                <td>
                    <form action="{{route('jobs.restore',$job->id)}}" method="post">
                        @csrf
                        @method('patch')
                        <button>Restore</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('jobs.forcedelete', $job->id)}}" method="post">
                      @csrf
                      @method('delete')
                      <button>Delete</button>
                     </form>
                </td>




            </tr>

            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </main>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>
