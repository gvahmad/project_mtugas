<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" style="background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1); border-bottom: 2px solid #f0f0f0;">

                   
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars" style="color: #6b7280; font-size: 1.2rem;"></i>
                    </button>

                    
                    <ul class="navbar-nav ml-auto">

                        
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle text-gray-600" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw" style="color: #6b7280;"></i>
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small" style="font-weight: 600;">{{ Auth::user()->name ?? 'ADMIN' }}</span>
                                @php
                                    $profileFile = 'img/profile/' . (Auth::user()->profile_photo ?? 'default-profile.png');
                                    $profileSrc = file_exists(public_path($profileFile)) ? asset($profileFile) : asset('img/undraw_profile.svg');
                                @endphp
                                <img class="img-profile rounded-circle" src="{{ $profileSrc }}" style="width: 40px; height: 40px; border: 2px solid #2f3437; object-fit: cover;" alt="Profile">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown" style="border-top: 3px solid #2f3437;">
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2" style="color: #6b7280;"></i>
                                    Edit Profil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2" style="color: #9ca3af;"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>