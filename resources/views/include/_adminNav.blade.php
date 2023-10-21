    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical  fixed-left navbar-expand-xs navbar-dark bg-dark" id="sidenav-main">
        <div class="scrollbar-inner">
          
          <div class="navbar-inner">
              <!-- Collapse --><div class="collapse navbar-collapse" id="sidenav-collapse-main">
              <!-- Nav items -->
              <ul class="navbar-nav">
                  <li class="nav-item">
                      <a class="nav-link {{request()->routeIs('home') ? 'active' : '' }}" href="{{route('home')}}">
                          <i class="fas fa-th-large"></i>
                          <span class="nav-link-text">{{__('master.HOME')}}</span>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a class="nav-link collapsed" href="#navbar-staff" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-components">
                        <i class="fa fa-users"></i>
                        <span class="nav-link-text">People</span>
                      </a>
                      <div class="collapse" id="navbar-staff" style="">
                        <ul class="nav nav-sm flex-column">
                   
                          <li class="nav-item">
                            <a href="{{route('staff.index')}}" class="nav-link nav-link-sub {{request()->routeIs('staff.index') ? 'active' : '' }}">
                              <i class="far fa-dot-circle"></i>
                              <span class="sidenav-normal"> Staff</span>
                            </a>
                          </li>
                   
                          <li class="nav-item">
                            <a href="{{route('team.index')}}" class="nav-link nav-link-sub {{request()->routeIs('team.index') ? 'active' : '' }}">
                              <i class="far fa-dot-circle"></i>
                              <span class="sidenav-normal"> Team</span>
                            </a>
                          </li>
                   
                          <li class="nav-item">
                            <a href="{{route('customer.index')}}" class="nav-link nav-link-sub {{request()->routeIs('customer.index') ? 'active' : '' }}">
                              <i class="far fa-dot-circle"></i>
                              <span class="sidenav-normal"> Customers</span>
                            </a>
                          </li>

                        </ul>
                      </div>
                  </li>

                  <li class="nav-item">
                      <a class="nav-link collapsed" href="#navbar-category" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-courses">
                        <i class="fas fa-chart-pie"></i>
                        <span class="nav-link-text">Categories</span>
                      </a>
                      <div class="collapse" id="navbar-category" style="">
                        <ul class="nav nav-sm flex-column">

                          <li class="nav-item">
                            <a href="{{ route('coursecategory.create')}}" class="nav-link nav-link-sub {{request()->routeIs('coursecategory.create') ? 'active' : '' }}">
                              <i class="far fa-dot-circle"></i>
                              <span class="sidenav-normal">Add New Category</span>
                            </a>
                          </li>

                          <li class="nav-item">
                            <a href="{{ route('coursecategory.index')}}" class="nav-link nav-link-sub {{request()->routeIs('coursecategory.index') ? 'active' : '' }}">
                              <i class="far fa-dot-circle"></i>
                              <span class="sidenav-normal">Categories List</span>
                            </a>
                          </li>
                          
                        </ul>
                      </div>
                  </li>

                  <li class="nav-item">
                      <a class="nav-link collapsed" href="#navbar-courses" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-courses">
                        <i class="fas fa-clipboard"></i>
                        <span class="nav-link-text">Courses</span>
                      </a>
                      <div class="collapse" id="navbar-courses" style="">
                        <ul class="nav nav-sm flex-column">

                          <li class="nav-item">
                            <a href="{{ route('courses.create')}}" class="nav-link nav-link-sub {{request()->routeIs('courses.create') ? 'active' : '' }}">
                              <i class="far fa-dot-circle"></i>
                              <span class="sidenav-normal">Add New Course</span>
                            </a>
                          </li>

                          <li class="nav-item">
                            <a href="{{ route('courses.index')}}" class="nav-link nav-link-sub {{request()->routeIs('courses.index') ? 'active' : '' }}">
                              <i class="far fa-dot-circle"></i>
                              <span class="sidenav-normal">Courses List</span>
                            </a>
                          </li>
                          
                        </ul>
                      </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link collapsed" href="#navbar-qrcode" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-qrcode">
                      <i class="fas fa-clipboard"></i>
                      <span class="nav-link-text">qrcode</span>
                    </a>
                    <div class="collapse" id="navbar-qrcode" style="">
                      <ul class="nav nav-sm flex-column">

                        <li class="nav-item">
                          <a href="{{ route('qrcode.create')}}" class="nav-link nav-link-sub {{request()->routeIs('qrcode.create') ? 'active' : '' }}">
                            <i class="far fa-dot-circle"></i>
                            <span class="sidenav-normal">Add New qrcode</span>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ route('qrcode.index')}}" class="nav-link nav-link-sub {{request()->routeIs('qrcode.index') ? 'active' : '' }}">
                            <i class="far fa-dot-circle"></i>
                            <span class="sidenav-normal">qrcode List</span>
                          </a>
                        </li>
                        
                      </ul>
                    </div>
                </li>
                  <li class="nav-item">
                      <a class="nav-link {{request()->routeIs('order.index') ? 'active' : '' }}" href="{{route('order.index')}}">
                          <i class="ni ni-bullet-list-67"></i>
                          <span class="nav-link-text">Subscriptions</span>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a class="nav-link {{request()->routeIs('faq.index') ? 'active' : '' }}" href="{{route('faq.index')}}">
                          <i class="fas fa-comment-dots"></i>
                          <span class="nav-link-text">FAQs</span>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a class="nav-link {{request()->routeIs('achievements.index') ? 'active' : '' }}" href="{{route('achievements.index')}}">
                          <i class="fas fa-certificate"></i>
                          <span class="nav-link-text">Achievements</span>
                      </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('messages') ? 'active' : '' }}" href="{{route('messages')}}">
                        <i class="ni ni-email-83"></i>
                        <span class="nav-link-text">Messages</span>
                    </a>
                  </li>

                  {{-- <li class="nav-item">
                      <a class="nav-link" href="#">
                          <i class="fas fa-copy"></i>
                          <span class="nav-link-text">Pages</span>
                      </a>
                  </li> --}}

                  {{-- <li class="nav-item">
                    <a class="nav-link collapsed" href="#navbar-slider" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-components">
                        <i class="fa fa-images"></i>
                      <span class="nav-link-text"> Slide Show</span>
                    </a>
                    <div class="collapse" id="navbar-slider" style="">
                      <ul class="nav nav-sm flex-column">
                        
                        <li class="nav-item">
                            <a class="nav-link nav-link-sub {{request()->is('slideshow/eg') ? 'active' : '' }}" href="{{ route('admin-show-slider', 'eg')}}">
                                <i class="far fa-dot-circle"></i>
                                <span class="nav-link-text">Egypt</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link nav-link-sub {{request()->is('slideshow/sa') ? 'active' : '' }}" href="{{route('admin-show-slider', 'sa')}}">
                                <i class="far fa-dot-circle"></i>
                                <span class="nav-link-text">KSA</span>
                            </a>
                        </li>
                        
                      </ul>
                    </div>
                  </li> --}}

                  <li class="nav-item">
                      <a class="nav-link collapsed" href="#navbar-setting" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-components">
                        <i class="ni ni-settings"></i>
                        <span class="nav-link-text"> {{__('master.SETTINGS')}}</span>
                      </a>
                      <div class="collapse" id="navbar-setting" style="">
                        <ul class="nav nav-sm flex-column">
                          
                          <li class="nav-item">
                              <a href="{{ route('admin-setting')}}" class="nav-link nav-link-sub {{request()->routeIs('admin-setting') ? 'active' : '' }}">
                                <i class="far fa-dot-circle"></i>
                                <span class="sidenav-normal"> General Setting </span>
                              </a>
                          </li>
                          
                          <li class="nav-item">
                              <a href="{{route('socialmedia')}}" class="nav-link nav-link-sub {{request()->routeIs('socialmedia') ? 'active' : '' }}">
                                <i class="far fa-dot-circle"></i>
                                <span class="sidenav-normal"> Social Media </span>
                              </a>
                          </li>
                          
                        </ul>
                      </div>
                  </li>
                  
              </ul>
              <!-- Divider -->
              <hr class="my-3">
              <!-- Heading -->
              <h6 class="navbar-heading p-0 text-muted">
              </h6>
              <!-- Navigation -->
              <ul class="navbar-nav mb-md-3">
                
                  <li class="nav-item">
                      <a class="nav-link {{request()->routeIs('profile') ? 'active' : '' }}" href="{{route('profile')}}">
                          <i class="fa fa-user-circle"></i>
                          <span class="nav-link-text">{{__('master.PROFILE')}}</span>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                          <i class="ni ni-user-run"></i>
                          <span class="nav-link-text">{{__('master.LOGOUT')}} </span>
                      </a>
                  </li>
              </ul>
              </div>
          </div>
        </div>
    </nav>