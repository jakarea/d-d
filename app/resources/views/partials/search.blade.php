<form action="" method="GET" id="mainSearchForm">
    <div class="header-search-box">
        <img src="{{ asset('public/assets/images/icons/search.svg') }}" alt="S" class="img-fluid search">
        <input type="text" class="form-control" placeholder="Search" id="searchField" name="search" value="{{ $searchText ?? ''}}">
        <a href="#" class="filter">
            <img src="{{ asset('public/assets/images/icons/filter.svg') }}" alt="F" class="img-fluid">
        </a>
    </div>
</form>