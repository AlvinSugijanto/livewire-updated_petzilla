<div>
    <h2>Welcome to Our Website, {{ $user->name }}</h2>
    <p>
        Click <a href="{{ url('/user/verify/' .$user->verifyUser->token) }}">here</a> to verify your email.
    </p>
</div>