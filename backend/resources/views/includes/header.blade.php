
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
                <li class="nav-item">
                    <a href="/moregirls/" class="nav-link" rel="tooltip" title="" data-placement="bottom" data-original-title="Подпишись на группу">
                        Горячие девушки
                        <i style="text-decoration: none;margin-left: 4px;" class="fa fa-heart"></i>
                    </a>
                </li>
                <li class="dropdown nav-item">
                    <a onclick="yandexGoal(56860381,'HEAD_DROPDOWN');" href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="material-icons">apps</i> Категории
                    </a>
                    <div class="dropdown-menu dropdown-with-icons">
                        @if (isset($tags))
                            @foreach ($tags as $key => $tag)
                                <a href="/tags/{{$tag['slug']}}" class="dropdown-item">
                                    <i class="material-icons">layers</i> {{$tag['name']}}
                                </a>
                            @endforeach
                        @endif
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="yandexGoal(56860381,'HEAD_DOWNLOAD');scrollToDownload();">
                        <i class="material-icons">cloud_download</i> Download
                    </a>
                </li>
                <li class="nav-item">
                    <a onclick="yandexGoal(56860381,'HEADER_VK_LINK');" target="_blank" href="{{env('VK_LINK')}}" class="nav-link" rel="tooltip" title="" data-placement="bottom" data-original-title="Подпишись на группу">
                        <i class="fa fa-vk"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="page-header header-filter clear-filter purple-filter" data-parallax="true" style="background-image: url('/assets/img/bg2.webp');">
    <div class="container">
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto">
                <div class="brand">
                    @yield('header_text')
                    @yield('header_description')
                </div>
            </div>
        </div>
    </div>
</div>
