<div class="dashboardSide__nav">
    <div class="navSide__logo">
        <span>
            <img class="logo__img" src="{{ asset('images/fastprint-white.png') }}" alt="FastPrint">
        </span>
    </div>
    <div class="sideNav__list">
        <ul class="navDash__wrapper">
            <span class="nav__Sidelinks">
                <li class="navSide__Db
                @if(isset($sideProduct))
                {{ $sideProduct }}
                @endif
                ">
                    <a href="{{ route('produk.index') }}" class="nav__links">
                        <i class="fa-solid fa-house" style="color: #ffffff;"></i>
                        Produk
                    </a>
                </li>
            </span>
            <span class="nav__Sidelinks">
                <li class="navSide__Db
                @if(isset($sideCategory))
                {{ $sideCategory }}
                @endif
                ">
                    {{-- <a href="" class="nav__links">
                        <i class="fa-solid fa-folder" style="color: #ffffff;"></i>
                        Kategori
                    </a> --}}
                </li>
            </span>
        </ul>
    </div>
</div>