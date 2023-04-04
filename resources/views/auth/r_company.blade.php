@extends('layouts.login')

@section('content')
<div class="wrapper wrapper-full-page">
    <div class="full-page register-page" filter-color="black" data-image="../../assets/img/register.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="card card-signup">
                        <h2 class="card-title text-center">Register</h2>
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="social text-center">
                                    <button class="btn btn-just-icon btn-round btn-twitter">
                                        <i class="fa fa-twitter"></i>
                                    </button>
                                    <button class="btn btn-just-icon btn-round btn-dribbble">
                                        <i class="fa fa-dribbble"></i>
                                    </button>
                                    <button class="btn btn-just-icon btn-round btn-facebook">
                                        <i class="fa fa-facebook"> </i>
                                    </button>
                                    <h4> Company Register </h4>
                                </div>
                                @if(count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <button type="button" aria-hidden="true" class="close">
                                            <i class="material-icons">close</i>
                                        </button>
                                        <span>
                                            <b> Danger - </b>
                                            @foreach($errors->all() as $error)
                                                {{ $error }} <br />
                                            @endforeach
                                        </span>
                                    </div>
                                @endif
                                <form class="form" method="POST" action="{{route('register')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-content">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">store</i>
                                            </span>
                                            <input type="text" name="nama" class="form-control" placeholder="Nama Gallery">
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">home</i>
                                            </span>
                                            <input type="text" name="alamat" class="form-control" placeholder="Alamat Gallery">
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">home</i>
                                            </span>
                                            <input type="text" name="kota" class="form-control" placeholder="Kota">
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">call</i>
                                            </span>
                                            <input type="number" name="telp" class="form-control" placeholder="Telp Gallery">
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">subject</i>
                                            </span>
                                            <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi Gallery">
                                        </div>
                                        <br>
                                        <center>
                                            <div class="input-group">
                                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                    {{-- <div class="fileinput-new thumbnail">
                                                        <img style="width: 100px; height:100px" src="https://media.istockphoto.com/vectors/file-folder-in-flat-on-white-background-vector-id1175215972?k=6&m=1175215972&s=612x612&w=0&h=SJQ5O2BikSn33YYYVsjNKGfmgDGknf4QSvWQnmtHDP8=" alt="...">
                                                    </div> --}}
                                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                                    <div>
                                                        <span class="btn btn-rose btn-round btn-file">
                                                            <span class="fileinput-new">Select File</span>
                                                            <span class="fileinput-exists">Change</span>
                                                            <input type="file" name="file" />
                                                        </span>
                                                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                    </div>
                                                </div>
                                                <br>
                                                <small>file dalam format zip / rar</small>
                                                <br>
                                                <small>Berisikan scan TDP, SIUP, AKTA PENDIRIAN, NPWP PERUSAHAAN, dan NPWP DIREKTUR</small>
                                            </div>
                                        </center>
                                        
                                        <hr>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">email</i>
                                            </span>
                                            <input type="text" name="email" class="form-control" placeholder="Email">
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                            <input type="password" name="password" placeholder="Password"
                                                class="form-control" />
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">vpn_key</i>
                                            </span>
                                            <input type="password" name="password_confirmation"
                                                placeholder="Confirm Password" class="form-control" />
                                        </div>
                                        <!-- If you want to add a checkbox to this form, uncomment this code -->
                                        {{-- <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes" checked> I agree to the
                                                <a href="#something">terms and conditions</a>.
                                            </label>
                                        </div> --}}
                                        <input type="hidden" name="level" value="designer">
                                        <input type="hidden" name="status" value="1">
                                    </div>
                                    <div class="footer text-center">
                                        <button type="submit" class="btn btn-primary btn-round">Get Started</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-5">
                                <div class="card-content">
                                    <div class="info info-horizontal">
                                        <div class="icon icon-rose">
                                            <i class="material-icons">timeline</i>
                                        </div>
                                        <div class="description">
                                            <h4 class="info-title">Register Designer Company</h4>
                                            <p class="description">
                                                Mari kembangkan perusahaan anda bersama kami, melalui platform EZDesign perusahaan anda akan dikenal oleh banyak kalangan, segera daftarkan perusaahaan anda.
                                            </p>
                                            <a href="{{route('signup_company')}}" class="btn btn-info btn-round">Clik Here</a>
                                        </div>
                                    </div>
                                    <div class="info info-horizontal">
                                        <div class="icon icon-primary">
                                            <i class="material-icons">code</i>
                                        </div>
                                        <div class="description">
                                            <h4 class="info-title">Register Designer Individual</h4>
                                            <p class="description">
                                                We've developed the website with HTML5 and CSS3. The client has access
                                                to the code using GitHub.
                                            </p>
                                            <a href="{{route('signup_individual')}}" class="btn btn-info btn-round">Clik Here</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="https://technodeisgn.co.id">
                                Company
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())

                    </script>
                    <a href="https://technodesign.co.id">Creative Tim</a>, made with love for a better web
                </p>
            </div>
        </footer>
    </div>
</div>
@endsection
