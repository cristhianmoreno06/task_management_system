@extends('layouts.vertical', ['title' => 'Profile', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
    @vite(['node_modules/select2/dist/css/select2.min.css', 'node_modules/daterangepicker/daterangepicker.css', 'node_modules/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css', 'node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css', 'node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css', 'node_modules/flatpickr/dist/flatpickr.min.css'])
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="profile-bg-picture"
                style="background-image:url('/images/bg-profile.jpg')">
                <span class="picture-bg-overlay"></span>
                <!-- overlay -->
            </div>
            <!-- meta -->
            <div class="profile-user-box">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="profile-user-img">
                            <div class="avatar-xl" style="width: 6rem; height: 6rem; top: -56px; position: absolute">
                                <span class="avatar-lg rounded-circle avatar-title bg-primary-subtle text-primary fs-24 rounded-circle">{{ Auth::user()->getInitials() }}</span>
                            </div>
                            {{--<img src="/images/users/avatar-1.jpg" alt="" class="avatar-lg rounded-circle">--}}
                        </div>
                        <div class="">
                            <h4 class="mt-4 fs-17 ellipsis">{{ $user->name }}</h4>
                            {{--<p class="font-13"> {{ $user->username }}</p>--}}
                            <p class="text-muted mb-0"><small>Bogotá, Colombia</small></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex justify-content-end align-items-center gap-2">
                            <button type="button" class="btn btn-soft-danger">
                                <i class="ri-settings-2-line align-text-bottom me-1 fs-16 lh-1"></i>
                                Edit Profile
                            </button>
                            <a class="btn btn-soft-info" href="#"> <i class="ri-check-double-fill fs-18 me-1 lh-1"></i> Following</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ meta -->
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card p-0">
                <div class="card-body p-0">
                    <div class="profile-content">
                        <ul class="nav nav-underline nav-justified gap-0">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#aboutme" type="button" role="tab" aria-controls="home" aria-selected="true" href="#aboutme">About</a>
                            </li>
                            {{--<li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#user-activities" type="button" role="tab" aria-controls="home" aria-selected="true" href="#user-activities">Activities</a>
                            </li>--}}
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#edit-profile" type="button" role="tab" aria-controls="home" aria-selected="true" href="#edit-profile">Settings</a>
                            </li>
                            {{--<li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#projects" type="button" role="tab" aria-controls="home" aria-selected="true" href="#projects">Projects</a>
                            </li>--}}
                        </ul>

                        <div class="tab-content m-0 p-4">
                            <div class="tab-pane active" id="aboutme" role="tabpanel"
                                aria-labelledby="home-tab" tabindex="0">
                                <div class="profile-desk">
                                    <h5 class="text-uppercase fs-17 text-dark">{{ $user->name }}</h5>
                                    {{--<div class="designation mb-4">{{ $user->sede->Nombre }}</div>--}}

                                    <h5 class="mt-4 fs-17 text-dark">Contact Information</h5>
                                    <table class="table table-condensed mb-0 border-top">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Url</th>
                                                <td>
                                                    <a href="#" class="ng-binding">
                                                        www.taskmanagement.com
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Email</th>
                                                <td>
                                                    <a href="#" class="ng-binding">
                                                        {{ $user->email }}
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Nombre de Usuario</th>
                                                <td class="ng-binding">{{ $user->name }}</td>
                                            </tr>
                                            {{--<tr>
                                                <th scope="row">Rol asignado</th>
                                                <td class="ng-binding">{{ $user->role->name }}</td>
                                            </tr>--}}

                                        </tbody>
                                    </table>
                                </div> <!-- end profile-desk -->
                            </div> <!-- about-me -->

                            <!-- Activities -->
                            {{--<div id="user-activities" class="tab-pane">
                                <div class="timeline-2">
                                    <div class="time-item">
                                        <div class="item-info ms-3 mb-3">
                                            <div class="text-muted">5 minutes ago</div>
                                            <p><strong><a href="#" class="text-info">John
                                                        Doe</a></strong>Uploaded a photo</p>
                                            <img src="/images/small/small-3.jpg" alt=""
                                                height="40" width="60" class="rounded-1">
                                            <img src="/images/small/small-4.jpg" alt=""
                                                height="40" width="60" class="rounded-1">
                                        </div>
                                    </div>

                                    <div class="time-item">
                                        <div class="item-info ms-3 mb-3">
                                            <div class="text-muted">30 minutes ago</div>
                                            <p><a href="" class="text-info">Lorem</a> commented your
                                                post.
                                            </p>
                                            <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing
                                                    elit.
                                                    Aliquam laoreet tellus ut tincidunt euismod. "</em>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="time-item">
                                        <div class="item-info ms-3 mb-3">
                                            <div class="text-muted">59 minutes ago</div>
                                            <p><a href="" class="text-info">Jessi</a> attended a meeting
                                                with<a href="#" class="text-success">John Doe</a>.</p>
                                            <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing
                                                    elit.
                                                    Aliquam laoreet tellus ut tincidunt euismod. "</em>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="time-item">
                                        <div class="item-info ms-3 mb-3">
                                            <div class="text-muted">5 minutes ago</div>
                                            <p><strong><a href="#" class="text-info">John
                                                        Doe</a></strong> Uploaded 2 new photos</p>
                                            <img src="/images/small/small-2.jpg" alt=""
                                                height="40" width="60" class="rounded-1">
                                            <img src="/images/small/small-1.jpg" alt=""
                                                height="40" width="60" class="rounded-1">
                                        </div>
                                    </div>

                                    <div class="time-item">
                                        <div class="item-info ms-3 mb-3">
                                            <div class="text-muted">30 minutes ago</div>
                                            <p><a href="" class="text-info">Lorem</a> commented your
                                                post.
                                            </p>
                                            <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing
                                                    elit.
                                                    Aliquam laoreet tellus ut tincidunt euismod. "</em>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="time-item">
                                        <div class="item-info ms-3 mb-3">
                                            <div class="text-muted">59 minutes ago</div>
                                            <p><a href="" class="text-info">Jessi</a> attended a meeting
                                                with<a href="#" class="text-success">John Doe</a>.</p>
                                            <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing
                                                    elit.
                                                    Aliquam laoreet tellus ut tincidunt euismod. "</em>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>--}}

                            <!-- settings -->
                            <div id="edit-profile" class="tab-pane">
                                <div class="user-profile-content">
                                    <form method="POST" action="{{ route('profile.update', Auth::id()) }}">
                                        @csrf
                                        <div class="row row-cols-sm-2 row-cols-1">
                                            <div class="mb-2">
                                                <label for="name" class="form-label">Full Name</label>
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus placeholder="Enter your name">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" placeholder="Enter your email">

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            {{--<div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="6 - 15 Characters" value="{{ Str::limit($user->password, 10) }}">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="password-confirm" class="form-label">Re-Password</label>
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="6 - 15 Characters">
                                            </div>--}}
                                            {{--<div class="col-sm-12 mb-3">
                                                <label class="form-label" for="AboutMe">About Me</label>
                                                <textarea style="height: 125px;" id="AboutMe"
                                                    class="form-control">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</textarea>
                                            </div>--}}
                                        </div>
                                        <button class="btn btn-primary" type="submit"><i class="ri-save-line me-1 fs-16 lh-1"></i> Save</button>
                                    </form>
                                </div>
                            </div>

                            <!-- profile -->
                            {{--<div id="projects" class="tab-pane">
                                <div class="row m-t-10">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Project Name</th>
                                                        <th>Start Date</th>
                                                        <th>Due Date</th>
                                                        <th>Status</th>
                                                        <th>Assign</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Velonic Admin</td>
                                                        <td>01/01/2015</td>
                                                        <td>07/05/2015</td>
                                                        <td><span class="badge bg-info">Work
                                                                in Progress</span></td>
                                                        <td>Techzaa</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Velonic Frontend</td>
                                                        <td>01/01/2015</td>
                                                        <td>07/05/2015</td>
                                                        <td><span
                                                                class="badge bg-success">Pending</span>
                                                        </td>
                                                        <td>Techzaa</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Velonic Admin</td>
                                                        <td>01/01/2015</td>
                                                        <td>07/05/2015</td>
                                                        <td><span class="badge bg-pink">Done</span>
                                                        </td>
                                                        <td>Techzaa</td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Velonic Frontend</td>
                                                        <td>01/01/2015</td>
                                                        <td>07/05/2015</td>
                                                        <td><span class="badge bg-purple">Work
                                                                in Progress</span></td>
                                                        <td>Techzaa</td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>Velonic Admin</td>
                                                        <td>01/01/2015</td>
                                                        <td>07/05/2015</td>
                                                        <td><span class="badge bg-warning">Coming
                                                                soon</span></td>
                                                        <td>Techzaa</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
<!-- end row -->
@endsection

@section('script')
    @vite(['resources/js/pages/form-advanced.init.js'])
@endsection
