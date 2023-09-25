<div class="card list-menu-user">
    <div class="card-body">
        <h5 class="text-center font-weight-bold" style="color:#8A5E3E">Hi, {{ (Auth::user()->name) }}</h5>

        <a href="/user/profile" class="@if($type == 'profile') active @endif">
            <div class="d-flex align-items-center border-top p-3 mt-3">
                <i class="fa fa-user" aria-hidden="true"></i>
                <h6 class="mb-0 ml-3">Profil Saya</h6>
                <i class="fa fa-angle-right ml-auto" aria-hidden="true"></i>
            </div>
        </a>

        <a href="/user/transaction" class="@if($type == 'transaction') active @endif">
            <div class="d-flex align-items-center border-top p-3">
                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                <h6 class="mb-0 ml-3">Daftar Transaksi</h6>
                <i class="fa fa-angle-right ml-auto" aria-hidden="true"></i>
            </div>
        </a>

        <a href="/user/inbox">
            <div class="d-flex align-items-center border-top p-3">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <h6 class="mb-0 ml-3">Inbox</h6>
                <i class="fa fa-angle-right ml-auto" aria-hidden="true"></i>
            </div>
        </a>

        <a href="/user/wishlist">
            <div class="d-flex align-items-center border-top p-3">
                <i class="fa fa-bookmark" aria-hidden="true"></i>
                <h6 class="mb-0 ml-3">Wishlist</h6>
                <i class="fa fa-angle-right ml-auto" aria-hidden="true"></i>
            </div>
        </a>

    </div>
</div>