@extends('layouts.master',['title' => 'All User','body' => 'page-user'])
@section('head')
<link rel="stylesheet" href="{{asset('assets/examples/css/pages/user.css')}}">
<link rel="stylesheet" href="{{asset('assets/examples/css/uikit/modals.css')}}">
@endsection
@section('content')
<div class="page">
    <div class="page-content">
      <div class="row mb-5">
        <div class="col-md-12">
            
    </div>
    </div>
      <!-- Panel -->
      <div class="panel">
        <div class="panel-body">
        <form action="{{route('user.all',$role)}}" class="page-search-form" method="GET" role="search">
            <div class="input-search input-search-dark">
              <i class="input-search-icon md-search" aria-hidden="true"></i>
              <input type="text" class="form-control" id="inputSearch" name="search" placeholder="Search Users">
              <button type="button" class="input-search-close" aria-label="Close">></button>
            </div>
          </form>

          <div class="nav-tabs-horizontal nav-tabs-animate" data-plugin="tabs">
            <div class="dropdown page-user-sortlist">
              Order By: <a class="dropdown-toggle inline-block" data-toggle="dropdown" href="#" aria-expanded="false">Last Active</a>
              <div class="dropdown-menu animation-scale-up animation-top-right animation-duration-250" role="menu">
                <a class="active dropdown-item" href="javascript:void(0)">Last Active</a>
                <a class="dropdown-item" href="javascript:void(0)">Username</a>
                <a class="dropdown-item" href="javascript:void(0)">Location</a>
                <a class="dropdown-item" href="javascript:void(0)">Register Date</a>
              </div>
            </div>

            <ul class="nav nav-tabs nav-tabs-line" role="tablist">
              <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#all_contacts" aria-controls="all_contacts" role="tab">All Contacts</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane animation-fade active" id="all_contacts" role="tabpanel">
                <ul class="list-group">
                  @forelse ($users as $u)    
                  <li class="list-group-item">
                    
                    <div class="media">

                      <div class="pr-0 pr-sm-20 align-self-center">
                        <div class="avatar avatar-online">
                          <img src="{{asset(Storage::url(is_null($u->avatar) ? 'user/profile/placeholder.png' : 'avatar/'.$u->avatar))}}"" alt="...">
                          <i class="avatar avatar-busy"></i>
                        </div>
                      </div>
                      <div class="media-body align-self-center">
                        <h5 class="mt-0 mb-5">
                          {{Str::title($u->name)}}
                        <small>created at: {{$u->created_at->format('d-M-Y')}}</small>
                        </h5>
                        <p>
                          <i class="icon icon-color md-pin" aria-hidden="true"></i>{{$u->alamat}}
                        </p>
                        <div>
                          <a class="text-action" href="javascript:void(0)">
                        <i class="icon icon-color md-email" aria-hidden="true"></i>
                      </a>
                          <a class="text-action" href="javascript:void(0)">
                        <i class="icon icon-color md-smartphone" aria-hidden="true"></i>
                      </a>
                          <a class="text-action" href="javascript:void(0)">
                        <i class="icon icon-color bd-twitter" aria-hidden="true"></i>
                      </a>
                          <a class="text-action" href="javascript:void(0)">
                        <i class="icon icon-color bd-facebook" aria-hidden="true"></i>
                      </a>
                          <a class="text-action" href="javascript:void(0)">
                        <i class="icon icon-color bd-dribbble" aria-hidden="true"></i>
                      </a>
                        </div>
                      </div>
                      <div style="width: 200px" class="pl-0 pl-sm-20 mt-15 mt-sm-0 align-self-center">
                      
                      <a href="{{route('user.index',$u->id)}}"><button type="button" class="btn btn-warning btn-sm waves-effect waves-classic">
                          <i class="icon md-search" aria-hidden="true"></i>Detail
                        </button></a> 
                      </div>
                    </div>
                  </li>
                  @empty
                      <h2 class="text-center text-info mt-4">No users Found</h2>
                  @endforelse
                  
                </ul>
                <nav>
                  {{$l ? $users->links() : null}}
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Panel -->
    </div>
  </div>
 @endsection
@section('footer')
<script src="{{asset('global/js/Plugin/aspaginator.js')}}"></script>
<script src="{{asset('global/js/Plugin/responsive-tabs.js')}}"></script>
<script src="{{asset('global/js/Plugin/tabs.js')}}"></script>
<script>    
var add = "{{session()->get('create')}}";
  if(add == "1"){
  window.onload = function(){
  var button = document.getElementById('myButtonAdd');
button.click();
  }
  }
    </script>

@endsection