@props(['isAdmin'])

@php
    use App\Models\Contact;

    $messages = $isAdmin ? Contact::latest()->paginate(10) : collect();
@endphp

@include('dashboard.messages', ['messages' => $messages, 'isAdmin' => $isAdmin])