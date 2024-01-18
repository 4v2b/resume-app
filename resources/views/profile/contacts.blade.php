
@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <h2>Змінити контактну інформацію</h2>

    <!-- Contact Information Form -->
    <form method=POST action="{{url("/contacts/submit")}}">
        {{ csrf_field() }}
        <div class="mb-3">
            <label for="address" class="form-label">Ім'я та прізвище:</label>
            <input required type="text" class="form-control" name="full_name" value="{{$contacts?->full_name}}">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Місце проживання:</label>
            <input required type="text" class="form-control" name="address" value="{{$contacts?->address}}" placeholder="Ваша адреса">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input required type="email" class="form-control" name="email" value="{{$contacts?->email}}" placeholder="your.email@example.com">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Телефон:</label>
            <input required type="tel" class="form-control" name="phone_number" value="{{$contacts?->phone_number}}">
        </div>
        <div class="mb-3">
            <label for="linkedin" class="form-label">LinkedIn:</label>
            <input type="text" class="form-control" name="link" value="{{$contacts?->link}}" placeholder="linkedin.com/in/yourprofile">
        </div>

        <!-- Save Button -->
        <input type="submit" class="btn btn-primary" value="Зберегти">
    </form>
</div>

    
@endsection
