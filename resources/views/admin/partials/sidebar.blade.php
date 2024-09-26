<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="{{ request()->routeIs('dashboard') ? 'active' : ''}}" >
                    <a href="{{ route('dashboard')  }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Categories</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-plus"></i><a href="{{ route('categories.create')}}">Add Category</a></li>
                        <li><i class="fa fa-bars"></i><a href="{{ route('categories.index') }}">Categories List</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Brands</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-plus"></i><a href="{{route('brands.create') }}">Add Brand</a></li>
                        <li><i class="fa fa-bars"></i><a href="{{ route('brands.index') }}">Brands List</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Products</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-plus"></i><a href="{{ route('products.create') }}">Add Product</a></li>
                        <li><i class="fa fa-bars"></i><a href="{{ route('products.index') }}">Products List</a></li>
                    </ul>
                </li>
                <li class="{{ request()->routeIs('orders.index') ? 'active' : ''}}" >
                    <a href="{{ route('orders.index')  }}"><i class="menu-icon fa fa-laptop"></i>Orders </a>
                </li>
            </ul>
        </div>
    </nav>
</aside>
