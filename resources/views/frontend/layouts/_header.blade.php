<style type="text/css">
    .title-span {
        position: relative;
    }
    .title-span::before {
        content: '';
        position: absolute;
        left: 50%;
        bottom: 0;
        width: 100%;
        height: 2px;
        background-color: #dd001b;
        transform-origin: center;
        transform: translate(-50%, 0) scaleX(0);
        transition: transform 0.3s ease-in-out;
    }
    .title-span:hover::before {
        transform: translate(-50%, 0) scaleX(1);
    }
    .navbar-item:hover{
        background-color: white !important;
    }
</style>

<nav class="navbar is-white" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item " href="http://isconte.com">
            <span class="title-span title">@if(isset($title)&&$title){{ $title }}@else{{ $pageTitle }}@endif</span>
        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarExampleTransparentExample" class="navbar-menu">
        <div class="navbar-start">
        </div>

        <div class="navbar-end">
        </div>
    </div>
</nav>