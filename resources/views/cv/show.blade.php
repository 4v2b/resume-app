@extends('layouts.app')


@section('content')

    <div class="container mt-5 position-relative">

        <header class="text-center">
            @if ($contacts !== null && !empty($contacts->full_name))
                <h2>{{ $contacts->full_name }}</h2>
            @endif
            <p class="lead">{{ $cv['name'] }}</p>
        </header>

        <section class="contact mt-4">
            <h2>Контактна інформація</h2>
            @if ($contacts != null)
                <ul class="list-unstyled">
                    <li>Адреса: {{ $contacts->address }}</li>
                    <li>Email: {{ $contacts->email }}</li>
                    <li>Телефон: {{ $contacts->phone_number }}</li>
                    @if (!empty($contacts->link))
                        <li>LinkedIn: <a target="_blank" href=" https://{{ $contacts->link }}">{{ $contacts->link }}</a></li>
                    @endif
                </ul>
            @else
                <p>Контактна інформація відсутня. <a href="{{ url('/contacts/edit') }}">Обновити інформацію</a> </p>
            @endif
        </section>

        <section class="education mt-4">
            <h2>Освіта</h2>

            <ul class="list-unstyled">

                @foreach ($cv['info']['education'] as $eduItem)
                    <li>
                        <div class="row border rounded p-1">
                            <div class="col">
                                <strong>{{ $eduItem['institution'] }}</strong>
                                <p class="text-muted">{{ $eduItem['description'] }}</p>
    
                            </div>
                            <div class="col">
                                <p class="text-muted">{{ $eduItem['start'] }} &#8212;
                                @if (!isset($eduItem['end']))
                                Теперішній час
                                @else
                                {{ $eduItem['end'] }}
                                @endif
                               </p>
                            </div>

                        </div>
                    </li>
                @endforeach

                <!-- Додайте інші записи про освіту, якщо потрібно -->
            </ul>
        </section>

        <section class="experience mt-4">
            <h2>Досвід роботи</h2>
            <ul class="list-unstyled">

                @foreach ($cv['info']['experience'] as $expItem)
                    <li>
                        <div class="row border rounded p-1">
                            <div class="col"> 
                                <strong>{{ $expItem['workplace'] }}</strong>

                                <ul class="list-group">
                                @foreach ($expItem["achievements"] as $achievement)
                                    <li class="list-group-item">{{$achievement}}</li>
                                @endforeach
                                </ul>
                            </div>
                            <div class="col"> 
                                <p class="text-muted"> {{ $expItem['start'] }} &#8212; {{ $expItem['end'] }}</p>

                            </div>
  
                        </div>
                    </li>
                @endforeach
            </ul>
        </section>

        <section class="skills mt-4 col-1-2">
            <h2>Навички</h2>

            <div class="d-flex flex-row flex-wrap bd-highlight" id="skills">

                @foreach ($cv['info']['skills'] as $skill)
                    <div class="border border-dark rounded p-2 m-2" class="skill">
                        <span class='h6'>{{ $skill }}</span>
                    </div>
                @endforeach

            </div>

        </section>

        <span class=" mt-3 float-right"> <a href="/edit/{{ $cv['id'] }}" class='btn btn-info'>Редагувати</a> </span>

    </div>

@endsection
