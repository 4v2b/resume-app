@extends('layouts.app')


@section('content')
    <div class="container-fluid">

        <div class="create-cv">

            <div>
                <h2 class="mt-5 ml-2 mb-2">Назва</h2>
                <input id="name" name='name' class="form-control">
            </div>

            <h2  class="mt-5 ml-2 mb-2" >Освіта</h2>

            <section>
                <div id='edu-container' class="container">

                </div>
                <button class="btn btn-success" id="addEdu">Додати освіту</button>

            </section>

            <h2 class="mt-5 ml-2 mb-2" >Досвід</h2>

            <section>
                <div id="experience-container" class="container">

                    
                </div>
                <button class="btn btn-success" id="addExp">Додати місце роботи</button>

            </section>


            <h2  class="mt-5 ml-2 mb-2" >Навички</h2>
            <section>

                <div class="d-flex flex-row flex-wrap bd-highlight" id="skills">


                </div>
                <fieldset class="form-group">
                    <label for="skillName">Назва навички:</label>
                    <input required class="form-control" id="skillName" type="text">
                    <button class="btn btn-success" id="addSkill">Додати</button>
                </fieldset>

            </section>


            <div> <button class="btn btn-primary" id="create">Зберегти</button> </div>

        </div>

        <script src="{{ asset('js/edit-cv.js') }}"></script>

    </div>
@endsection
