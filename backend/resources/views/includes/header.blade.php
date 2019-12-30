
<nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="/">
                GIFKAWOOD </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="material-icons">apps</i> Категории
                    </a>
                    <div class="dropdown-menu dropdown-with-icons">
                        <a href="/" class="dropdown-item">
                            <i class="material-icons">layers</i> приколы
                        </a>
                        <a href="/" class="dropdown-item">
                            <i class="material-icons">content_paste</i> животные
                        </a>
                        <a href="/" class="dropdown-item">
                            <i class="material-icons">content_paste</i> не ловко вышло
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)" onclick="scrollToDownload()">
                        <i class="material-icons">cloud_download</i> Download
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="https://vk.com/fun_gifs_video_prikoly" target="_blank" data-original-title="Подпишись на группу">
                        <i class="fa fa-vk"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="page-header header-filter clear-filter purple-filter" data-parallax="true" style="background-image: url('/assets/img/bg2.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto">
                <div class="brand">
                    <h1>@yield('header_text')</h1>
                    <h3>@yield('header_description')</h3>
                </div>
            </div>
        </div>
    </div>
</div>