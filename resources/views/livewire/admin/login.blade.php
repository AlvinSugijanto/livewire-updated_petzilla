<div class="login-container">

    <div class="card shadow" style="width: 450px; height:500px">
        <div class="card-body">
            @if (session()->has('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif
            @if (session()->has('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
            @endif
            <h4 class="text-title" style="color:#6A6A6A">LOGIN AS ADMIN</h4>
            <div class="form-group mt-4">
                <label for="" style="color:#6A6A6A">EMAIL</label>
                <input type="text" class="form-control" placeholder="Enter email here..." wire:model="email">
            </div>
            <div class="form-group mt-4">
                <label for="" style="color:#6A6A6A">PASSWORD</label>
                <input type="password" class="form-control" placeholder="Enter password here..." wire:model="password">
            </div>
            <button class="mt-3" wire:click="login">Login</button>
            <div class="mt-5"><a href="">&#x2190; back to homepage</a></div>
        </div>
    </div>
</div>