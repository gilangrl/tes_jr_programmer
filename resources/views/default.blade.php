<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('styles/dashboardStyles.css') }}">
    <link rel="icon" type="image/png"
        href="https://images.tokopedia.net/img/cache/215-square/shops-1/2019/7/4/225311/225311_dd249f77-e58e-49ad-aef3-4132772c3b07.jpg">

    {{-- Jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    {{-- Fontawesome --}}
    <script src="https://kit.fontawesome.com/b87f3ad2d2.js" crossorigin="anonymous"></script>

    {{-- Datatable --}}
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.4/sorting/formatted-numbers.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;500;800&display=swap"
        rel="stylesheet">

    {{-- Sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title></title>

    @stack('style')

    {{-- Bootstrap --}}
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>
</head>

<body>

    <div class="dashboardContainer__das">
        <div class="dashboardContent__items">
            <div class="dashboardContent__wrapper">
                <div class="dashboardInner__wrapper">
                    {{-- Sidebar --}}
                    @include('components.sidebar')
                    <div class="dashboardSide__container">
                        <div class="dashboardSide">
                            <div class="dashContent__wrapper">
                                {{-- Topbar --}}
                                @include('components.topbar')
                                <div class="dashboardContent__container">
                                    @yield('pageContent')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="" method="post" id="deleteForm">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>
</body>
<script>
    $(document).ready(function() {
        $('.dataTable').DataTable();
        $('.numbersOnly').keypress(function(e) {
                if (isNaN(this.value + "" + String.fromCharCode(e.charCode))) return false;
            })
            .on("cut copy paste", function(e) {
                e.preventDefault();
            });
        $('input[type="text"]').val().toUpperCase();
    });
</script>
@stack('scripts')
@include('components.sweetalert')
</html>
