<ul class="nav">
                    <li class="nav-item <?php if($page == "Home") { echo 'active'; } ?>">
                        <a class="nav-link" href="/admin">
                            <i class="nc-icon nc-button-power"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="nav-item <?php if($page == "Orders") { echo 'active'; } ?>">
                        <a class="nav-link" href="/admin/orders.php">
                            <i class="nc-icon nc-backpack"></i>
                            <p>Orders</p>
                        </a>
                    </li>
                    <li class="nav-item <?php if($page == "Users") { echo 'active'; } ?>">
                        <a class="nav-link" href="/admin/users.php">
                            <i class="nc-icon nc-circle-09"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li class="nav-item <?php if($page == "products") { echo 'active'; } ?>">
                        <a class="nav-link" href="/admin/products.php">
                            <i class="nc-icon nc-app"></i>
                            <p>Products</p>
                        </a>
                    </li>
                    <li class="nav-item <?php if($page == "categories") { echo 'active'; } ?>">
                        <a class="nav-link" href="/admin/categories.php">
                            <i class="nc-icon nc-bullet-list-67"></i>
                            <p>Categories</p>
                        </a>
                    </li>
                        <li class="nav-item <?php if($page == "log out") { echo 'active'; } ?>">
                        <a class="nav-link" href="./typography.html">
                            <i class="nc-icon nc-key-25"></i>
                            <p>log out</p>
                        </a>
                    </li>
                </ul>
