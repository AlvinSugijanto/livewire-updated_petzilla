<div class="container">
  <form wire:submit.prevent="login">
    <div class="brand">
      <center>
        <img src="logo-brand.png" alt="" width="100">
        <img src="logo-name.png" alt="" width="130" style="margin-left:10px">
      </center>
    </div>
    @if (session()->has('success'))
    <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif
    @if (session()->has('error'))
    <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif
    <div class="form-group">
      <label for="email">Email address</label>
      <input type="email" class="form-control" placeholder="Enter email" wire:model.lazy="email">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" placeholder="Password" wire:model.lazy="password">
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
    <p class="mt-3 mb-0 text-center">Don't have an account? <a href="/register">Register</a></p>

  </form>
</div>