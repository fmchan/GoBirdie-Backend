@can('user-list')
<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>User</span></a>
</li>
@endcan
@can('role-list')
<li class="{{ Request::is('roles*') ? 'active' : '' }}">
    <a href="{!! route('roles.index') !!}"><i class="fa fa-edit"></i><span>Role</span></a>
</li>
@endcan
@can('permission-list')
<li class="{{ Request::is('permissions*') ? 'active' : '' }}">
    <a href="{!! route('permissions.index') !!}"><i class="fa fa-edit"></i><span>Permission</span></a>
</li>
@endcan
<li class="{{ Request::is('tags*') ? 'active' : '' }}">
    <a href="{!! route('tags.index') !!}"><i class="fa fa-edit"></i><span>Tags</span></a>
</li>

<li class="{{ Request::is('categoryArticles*') ? 'active' : '' }}">
    <a href="{!! route('categoryArticles.index') !!}"><i class="fa fa-edit"></i><span>Category Articles</span></a>
</li>

<li class="{{ Request::is('categoryPlaces*') ? 'active' : '' }}">
    <a href="{!! route('categoryPlaces.index') !!}"><i class="fa fa-edit"></i><span>Category Places</span></a>
</li>

<li class="{{ Request::is('facilities*') ? 'active' : '' }}">
    <a href="{!! route('facilities.index') !!}"><i class="fa fa-edit"></i><span>Facilities</span></a>
</li>

<li class="{{ Request::is('organizations*') ? 'active' : '' }}">
    <a href="{!! route('organizations.index') !!}"><i class="fa fa-edit"></i><span>Organizations</span></a>
</li>

<li class="{{ Request::is('cities*') ? 'active' : '' }}">
    <a href="{!! route('cities.index') !!}"><i class="fa fa-edit"></i><span>Cities</span></a>
</li>

<li class="{{ Request::is('districts*') ? 'active' : '' }}">
    <a href="{!! route('districts.index') !!}"><i class="fa fa-edit"></i><span>Districts</span></a>
</li>

<li class="{{ Request::is('areas*') ? 'active' : '' }}">
    <a href="{!! route('areas.index') !!}"><i class="fa fa-edit"></i><span>Areas</span></a>
</li>

<li class="{{ Request::is('hours*') ? 'active' : '' }}">
    <a href="{!! route('hours.index') !!}"><i class="fa fa-edit"></i><span>Hours</span></a>
</li>

<li class="{{ Request::is('articles*') ? 'active' : '' }}">
    <a href="{!! route('articles.index') !!}"><i class="fa fa-edit"></i><span>Articles</span></a>
</li>

<li class="{{ Request::is('places*') ? 'active' : '' }}">
    <a href="{!! route('places.index') !!}"><i class="fa fa-edit"></i><span>Places</span></a>
</li>