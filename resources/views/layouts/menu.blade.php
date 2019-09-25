<h4>Core</h4>
<li class="{{ Request::is('articles*') ? 'active' : '' }}">
    <a href="{!! route('articles.index') !!}"><i class="fa fa-edit"></i><span>情報</span></a>
</li>

<li class="{{ Request::is('places*') ? 'active' : '' }}">
    <a href="{!! route('places.index') !!}"><i class="fa fa-edit"></i><span>好去處</span></a>
</li>

<h4>Relations</h4>
<li class="{{ Request::is('tags*') ? 'active' : '' }}">
    <a href="{!! route('tags.index') !!}"><i class="fa fa-edit"></i><span>Tags</span></a>
</li>

<li class="{{ Request::is('categoryArticles*') ? 'active' : '' }}">
    <a href="{!! route('categoryArticles.index') !!}"><i class="fa fa-edit"></i><span>Category (情報)</span></a>
</li>

<li class="{{ Request::is('categoryPlaces*') ? 'active' : '' }}">
    <a href="{!! route('categoryPlaces.index') !!}"><i class="fa fa-edit"></i><span>Category (好去處)</span></a>
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

<h4>App Display</h4>
<li class="{{ Request::is('banners*') ? 'active' : '' }}">
    <a href="{!! route('banners.index') !!}"><i class="fa fa-edit"></i><span>Banners</span></a>
</li>

<li class="{{ Request::is('highlightPlaces*') ? 'active' : '' }}">
    <a href="{!! route('highlightPlaces.index') !!}"><i class="fa fa-edit"></i><span>推介好去處</span></a>
</li>

<li class="{{ Request::is('highlightArticles*') ? 'active' : '' }}">
    <a href="{!! route('highlightArticles.index') !!}"><i class="fa fa-edit"></i><span>精選活動</span></a>
</li>

<li class="{{ Request::is('recommendPlaces*') ? 'active' : '' }}">
    <a href="{!! route('recommendPlaces.index') !!}"><i class="fa fa-edit"></i><span>你可能想去</span></a>
</li>

<li class="{{ Request::is('hotKeywordPlaces*') ? 'active' : '' }}">
    <a href="{!! route('hotKeywordPlaces.index') !!}"><i class="fa fa-edit"></i><span>熱門搜尋 (好去處)</span></a>
</li>

<li class="{{ Request::is('hotKeywordArticles*') ? 'active' : '' }}">
    <a href="{!! route('hotKeywordArticles.index') !!}"><i class="fa fa-edit"></i><span>熱門搜尋 (精選)</span></a>
</li>

<h4>Others</h4>
<li class="{{ Request::is('imports*') ? 'active' : '' }}">
    <a href="{!! route('imports.index') !!}"><i class="fa fa-edit"></i><span>Importer</span></a>
</li>
<li class="{{ Request::is('pages*') ? 'active' : '' }}">
    <a href="{!! route('pages.index') !!}"><i class="fa fa-edit"></i><span>Pages</span></a>
</li>

<h4>User Management</h4>
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