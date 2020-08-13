<template>
  <div class="wrapper">
    
    
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header text-center">
            <h3>Menu</h3>
        </div>

        <ul class="list-unstyled components text-center">
            <div class="text-center">
                <p>Kategorie</p>
            </div>
            <li class="active">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Značky</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                        <a href="#">Apple</a>
                    </li>
                    <li>
                        <a href="#">Samsung</a>
                    </li>
                    <li>
                        <a href="#">Motorola</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">About</a>
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="#">Page 1</a>
                    </li>
                    <li>
                        <a href="#">Page 2</a>
                    </li>
                    <li>
                        <a href="#">Page 3</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Portfolio</a>
            </li>
            <li>
                <a href="#">Contact</a>
            </li>
        </ul>
    </nav>

</div>
  

</template>
