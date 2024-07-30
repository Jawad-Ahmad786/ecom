<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="index.html"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Categories</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-plus"></i><a href="{{ route('category.add')}}">Add Category</a></li>
                        <li><i class="fa fa-bars"></i><a href="{{ route('categories.list') }}">Categories List</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Brands</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-plus"></i><a href="{{route('brand.add') }}">Add Brand</a></li>
                        <li><i class="fa fa-bars"></i><a href="{{ route('brands.list') }}">Brands List</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Products</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-plus"></i><a href="{{ route('product.add') }}">Add Product</a></li>
                        <li><i class="fa fa-bars"></i><a href="{{ route('products.list') }}">Products List</a></li>
                    </ul>
                </li
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
