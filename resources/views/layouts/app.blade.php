<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Моє Резюме</title>
    <!-- Підключення Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css') }}">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    

    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css')}}">
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom bg-light">Мої резюме
                <a class="btn btn-light btn-sm" href="{{url("/contacts/edit")}}"> <i class="fa-solid fa-pen-to-square"></i> </a>
            </div>
            <div class="list-group list-group-flush">

                @if (!empty($titles))
                    @foreach ($titles as $item)
                    <div class="list-group-item-action list-group-item-light list-group-item p-3">
                        <a class="text-decoration-none text-dark"  href="/show/{{ $item->id }}">{{ $item->name }}
                        </a>
                        <a class="btn btn-outline-light text-dark float-end btn-sm"  href="/delete/{{ $item->id }}"><i class="fa fa-trash"></i></a>
                    </div>
                    @endforeach
                @endif

                <a class="list-group-item list-group-item-action list-group-item-light p-3"
                    href="/new">Створити</a>
            </div>
        </div>
        <div class="px-5" id="page-content-wrapper">

            @yield('content')

            <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('js/scripts.js') }}"></script>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script src="https://kit.fontawesome.com/8f4e9e6d65.js" crossorigin="anonymous"></script>
       
        </div>

    </div>

</body>

</html>
