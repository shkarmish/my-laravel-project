@extends('layouts.app')

@section('content')

<style>
.contact-container {
    max-width: 600px;
    margin: 40px auto;
    background: #1f1f1f;
    padding: 30px;
    border-radius: 10px;
    color: #fff;
    box-shadow: 0 0 15px rgba(0,0,0,0.5);
}

.contact-container h2 {
    text-align: center;
    margin-bottom: 20px;
}

.contact-container input,
.contact-container textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 15px;
    border: none;
    border-radius: 5px;
    background: #2c2c2c;
    color: #fff;
}

.contact-container input:focus,
.contact-container textarea:focus {
    outline: none;
    background: #333;
}

.contact-container button {
    width: 100%;
    padding: 10px;
    background: #00bcd4;
    border: none;
    border-radius: 5px;
    color: #fff;
    font-weight: bold;
    cursor: pointer;
}

.contact-container button:hover {
    background: #0097a7;
}

.error {
    color: #ff4d4d;
    font-size: 14px;
}

.success {
    background: #28a745;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 15px;
}
</style>

<div class="contact-container">
    <h2>Contact Us</h2>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('contact.submit') }}" method="POST">
        @csrf

        <label>Name</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name') <div class="error">{{ $message }}</div> @enderror

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email') <div class="error">{{ $message }}</div> @enderror

        <label>Subject</label>
        <input type="text" name="subject" value="{{ old('subject') }}">
        @error('subject') <div class="error">{{ $message }}</div> @enderror

        <label>Message</label>
        <textarea name="message" rows="4">{{ old('message') }}</textarea>
        @error('message') <div class="error">{{ $message }}</div> @enderror

        <button type="submit">Send Message</button>
    </form>
</div>

@endsection