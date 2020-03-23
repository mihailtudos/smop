<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
{{--                            @if (Route::has('register'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
                        @else
                            {{-- dropw down for emails --}}

                            <li class="nav-item dropdown ">
                               @include('partials.emailDrop')
                            </li>
                            {{-- drop down for logout,registration, etc--}}
                            <li class="nav-item dropdown ">
                                <a id="navbarDropdown" class="nav-link text-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @include('partials.dropDownMenu')
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @include('partials.alerts')
                @yield('content')
            </div>
        </main>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    {{--    ajax requiest --}}
    <script>
        $(document).ready(function(){

            $('.dynamic').change(function(){

                if($(this).val() != '')
                {
                    var select = $(this).attr("id");
                    var value = $(this).val();
                    var dependent = $(this).data('dependent');
                    var students = $("#supervisor").data('dependent');
                    var _token = $('input[name="_token"]').val();


                    if(students == 'supervisor'){

                        $.ajax({
                            url:"{{ route('admin.projectscontroller.fetch') }}",
                            method:"POST",
                            data:{select:select, value:value, _token:_token, dependent:dependent},
                            success:function(result)
                            {
                                $('#'+dependent).html(result);
                            }

                        })
                    } else {
                        dependent = 'supervisor';
                        students = 'student';

                        $.ajax({
                            url:"{{ route('admin.emailscontroller.fetch') }}",
                            method:"POST",

                            data:{select:select, value:value, _token:_token, dependent:dependent, students:students},

                            success:function(result)
                            {
                                $('#'+students).html(result['students']);
                                $('#'+dependent).html(result['supervisors']);
                            }

                        })
                    }





                }
            });

            $('#studyField').change(function(){
                $('#supervisor').val('');
                // $('#city').val('');
            });

            // $('#supervisor').change(function(){
            //     // $('#city').val('');
            // });
            //
            // $('#student').change(function(){
            //     // $('#city').val('');
            // });

        });

    </script>
    <script>
        function addCoordinator() {
            var studentsCheck = document.getElementById("studentsCheck");
            var coordinatorCheck  = document.getElementById("coordinatorCheck");
            var errorMessageDestination  = document.getElementById("errorMessageDestination");
            var students = document.getElementById("students");
            var coordinatorEmail = $("#coordinatorEmail").val();


            if (studentsCheck.checked == true && coordinatorCheck.checked == false){
                students.style.display = "block";
                $("#students").attr("required", true);
                coordinator.style.display = "none";
                $("#coordinator").removeAttr("required").val('');
            } else if (studentsCheck.checked == true && coordinatorCheck.checked == true){
                students.style.display = "block";
                $('#coordinator').val(coordinatorEmail).attr("required", true).css("display", "block");
            }   else if (studentsCheck.checked == false && coordinatorCheck.checked == true){
                $('#coordinator').val(coordinatorEmail).attr("required", true).css("display", "block");
                students.style.display = "none";
                $("#students").removeAttr("required");
                $("select").val([]);
            } else {
                $('#coordinator').val('').removeAttr("required").css("display", "none");
                $("#students").removeAttr("required");
                students.style.display = "none";
                $("select").val([]);
            }


        }

        // function checkValidation() {
        //     if (studentsCheck.checked == true || coordinatorCheck.checked == true) {
        //         if(studentsCheck.checked == true){
        //             errorMessageDestination.style.display = "none";
        //             alert('sda');
        //         }
        //     } else {
        //         errorMessageDestination.style.display = "block";
        //         $("#coordinator").prop('required', true);
        //     }
        // }
    </script>
    <script>
        $('.date').datepicker({
            autoclose: true,
            dateFormat: "yy-mm-dd"
        });
    </script>

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
