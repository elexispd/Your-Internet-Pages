<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="typcn typcn-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="history.php">
              <i class="typcn typcn-chart-bar menu-icon"></i>
              <span class="menu-title">History</span>
              <!-- <i class="menu-arrow"></i> -->
            </a>
          </li>
      
          <li class="nav-item">
            <form action="../handlers/allHandlers.php" method="post">
              <button class="btn btn-success border-0" name="logout" >Logout</button>
            </form>
          </li>
        </ul>
      </nav>