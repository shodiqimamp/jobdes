<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
  <!-- <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-laugh-wink"></i>
  </div> -->
  <div class="sidebar-brand-text mx-3">Job Description</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

@if(Session::get('role') == 'SUPER ADMIN')
<!-- Heading -->
<div class="sidebar-heading mt-3">Super Admin</div>
<!-- Nav Item - Dashboard -->
<li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}">
  <a class="nav-link" href="{{ url('/') }}">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>
<li class="nav-item {{ (request()->is('inputjd')) ? 'active' : '' }}">
  <a class="nav-link" href="{{ url('inputjd') }}">
    <i class="fas fa-plus"></i>
    <span>Add Job Description</span></a>
</li>

<li class="nav-item {{ (request()->is('manageuser')) ? 'active' : '' }}">
  <a class="nav-link" href="{{ url('manageuser') }}">
  <i class="fas fa-user-cog"></i>
    <span>Manage User</span></a>
</li>
@endif

@if(Session::get('role') == 'ADMIN' || Session::get('role') == 'SUPER ADMIN' )
<hr class="sidebar-divider">
<div class="sidebar-heading">Review</div>
<li class="nav-item {{ (request()->is('review/*')) ? 'active' : '' }}">
  <a class="nav-link" href="{{ url('review') }}">
  <i class="fas fa-check-double"></i>
    <span>Job Desc List</span></a>
</li>
@endif
@if(Session::get('position') == 'Struktural' )
<hr class="sidebar-divider">
<div class="sidebar-heading">Leader</div>
<li class="nav-item {{ (request()->is('approval')) ? 'active' : '' }}">
  <a class="nav-link" href="{{ url('approval') }}">
  <i class="fas fa-check-double"></i>
    <span>Approval</span></a>
</li>
<li class="nav-item {{ (request()->is('submission')) ? 'active' : ''}} {{ (request()->is('pengajuan/*')) ? 'active' : ''}} ">
  <a class="nav-link" href="{{ url('submission') }}">
  <i class="fas fa-edit"></i>
    <span>My Submission</span></a>
</li>

@endif

<hr class="sidebar-divider">
<div class="sidebar-heading">Employee</div>
<li class="nav-item {{ (request()->is('alluser')) ? 'active' : '' }}">
  <a class="nav-link" href="{{ url('alluser') }}">
  <i class="fas fa-users"></i>
    <span>All Job Description</span></a>
</li>

</ul>