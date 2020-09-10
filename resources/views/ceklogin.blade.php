@if (Auth::guard('web')->check())
<div class="alert alert-primary alert-dismissible fade show" role="alert">
    <marquee behavior="alternate"> Anda Login sebagai User</marquee>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (Auth::guard('admin')->check())
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <marquee behavior="alternate"> Anda Login sebagai Admin</marquee>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif