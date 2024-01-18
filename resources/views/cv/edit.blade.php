@extends('layouts.app')


@section('content')
    <div class="container-fluid">

        <input id='cv-id' type="hidden" value="{{ $cv['id'] }}">

        <div class="update-cv">

            <div>
                <h2 class="mt-5 ml-2 mb-2">Назва</h2>
                <input id="name" name='name' class="form-control" value="{{$cv["name"]}}">
            </div>

            <h2  class="mt-5 ml-2 mb-2" >Освіта</h2>

            <section>
                <div id='edu-container' class="container">
                    @foreach ($cv['info']['education'] as $item)
                        <div class="border p-3 mb-3" class="edu-el">
                            <button class="btn btn-light" onclick="removeEducation(event)">
                                <i class="fa fa-trash"></i>
                            </button>

                            <div class="edu-info">

                                <div class='row'>

                                    <div class='col'>
                                        <label>Початок</label>
                                        <input class="form-control" name="start" type="month" value="{{$item["start"]}}">
                                    </div>

                                    <div class='col'>
                                        <label>Закінчення</label>
                                        <input class="form-control" name="end" type="month" value="{{$item["end"]}}">
                                    </div>

                                </div>

                                <div class='form-group'>
                                    <label>Навчальний заклад</label>
                                    <input class="form-control"  name="institution" type="text" value="{{$item["institution"]}}">    
                                </div>

                                <div class='form-group'>
                                    <label>Опис</label>
                                    <textarea class="form-control" name="description">{{$item["institution"]}}</textarea>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <button class="btn btn-success" id="addEdu">Додати ще одну освіту</button>

            </section>

            <h2 class="mt-5 ml-2 mb-2" >Досвід</h2>

            <section>
                <div id="experience-container" class="container">

                    @foreach ($cv["info"]["experience"] as $item)
                    <div class="border p-3 mb-3 exp-el" >
                        <button class="btn btn-light" onclick="removeExperience(event)"><i
                                class="fa fa-trash"></i></button>

                                <div class="exp-info">

                                    <fieldset class="form-group">
                                        <legend>Тривалість</legend>
                                        <div class="row">
                                            <div class="col">
                                                <label >Поч.:</label>
                                                <input class="form-control" type="month" name="start" value="{{$item["start"]}}">
                                            </div>
                                            <div class="col">
                                                <label >Закінчення:</label>
                                                <input class="form-control" type="month" name="end" value="{{$item["end"]}}">
                                            </div>
                                        </div>
                                    </fieldset>
    
                                    <div class="form-group">
                                        <label >Місце роботи:</label>
                                        <input class="form-control" type="text" name="workplace" value="{{$item["workplace"]}}">
                                    </div>

                                </div>

                                <div class="achiev-container">
                                    <ul class="list-group" class="achievements">
                                        @foreach ($item["achievements"] as $subItem)
                                        <li class="list-group-item">
                                            <div class="input-group">
                                            <input class="form-control" name='achievement' type='text' value="{{$subItem}}">
                                            <button class='btn btn-light' onclick="removeAchievement(event)">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            </div>
                                        </li>
                                        @endforeach
                                        <!-- Bootstrap list-group class added -->
                                    </ul>
                                    <button class="btn btn-success" class="addAch" onclick="addAchievement(event)">Додати
                                        досягнення</button>
                                </div>

                    </div>
                    @endforeach
                    
                </div>
                <button class="btn btn-success" id="addExp">Додати ще одне місце роботи</button>

            </section>


            <h2  class="mt-5 ml-2 mb-2" >Навички</h2>
            <section>

                <div class="d-flex flex-row flex-wrap bd-highlight" id="skills">

                    @foreach ($cv['info']['skills'] as $skill)
                        <div class="border rounded p-2 m-2" class="skill">
                            <span class="skillText">{{ $skill }}</span>
                            <button class='btn btn-light' onclick="removeSkill(event)"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                    @endforeach

                </div>
                <fieldset class="form-group">
                    <label for="skillName">Назва навички:</label>
                    <input required class="form-control" id="skillName" type="text">
                    <button class="btn btn-success" id="addSkill">Додати</button>
                </fieldset>


            </section>


            <button class="mt-5 btn btn-primary" id="edit">Зберегти</button>

        </div>

        <script src="{{ asset('js/edit-cv.js') }}"></script>

    </div>
@endsection
