<ul>
    <li>{{ $user->name }}</li>
    <li>{{ $user['email'] }}</li>
</ul>

<hr>
@php
    var_dump($user);
@endphp
