  <div class="navbar-all">
      <a href="dashboard.php">
          <div class="nav-logo"></div>
      </a>
      <div class="nav-items">
          <div class="nav-links">
              <a href="dashboard.php">Dashboard</a>
              <a href="addmember.php">Add Member</a>
              <a href="view_members.php">View Members</a>
              <!-- <div class="dropdown">
                  <button class="dropbtn">Memebership<i class="fa-solid fa-angle-down"></i></button>
                  <div class="dropdown-content">
                      <a href="addmember.php">Add Member</a>
                      <a href="view_members.php">View Member</a>
                  </div>
              </div> -->
              <!-- <div class="dropdown">
                  <button class="dropbtn">Payment<i class="fa-solid fa-angle-down"></i></button>
                  <div class="dropdown-content">
                      <a href="">Add Payment</a>
                      <a href="">View Payment</a>
                  </div>
              </div> -->




              <a href="logout.php" class="logout-btn" style="color: #fff;">Log Out</a>

          </div>

      </div>
      <button id="toggleButton">
          <i class="fa-solid fa-bars-staggered"></i> MENU
      </button>
  </div>

  <script>
      const toggleButton = document.getElementById("toggleButton");
      const navItems = document.querySelector(".nav-items");

      toggleButton.addEventListener("click", () => {
          console.log("Helloi")
          // Toggle the 'show-flex' class on the nav-items element
          navItems.classList.toggle("show-flex");
      });
  </script>