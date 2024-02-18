  <!-- <div class="navbar-all">
      <a href="dashboard.php">
          <div class="nav-logo"></div>
      </a>
      <div class="nav-items">
          <div class="nav-links">
              <a href="dashboard.php">Dashboard</a>
              <a href="addmember.php">Add Member</a>
              <a href="view_members.php">View Members</a>

          </div>


      </div>
      <div class="logout">
          <a href="logout.php" class="logout-btn" style="color: #fff;">Log Out</a>
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
  </script> -->


  <div class="sidebar_all">
      <div class="logo"></div>
      <div class="links">
          <a href="./dashboard.php" class="ll"> <i class="fas fa-home"></i> Dashboard</a>
          <a href="./addmember.php"> <i class="fas fa-user-plus"></i> Add a Member</a>
          <a href="./view_members.php"> <i class="fas fa-users"></i> View all Members</a>
          <a href="./logout.php" class="log"><i class="fas fa-sign-out-alt"></i>
              Logout</a>

      </div>

  </div>
  <button id="toggleButton">
      <i class="fa-solid fa-bars-staggered"></i> MENU
  </button>

  <script>
      // Get the button and sidebar elements
      var toggleButton = document.getElementById("toggleButton");
      var sidebar = document.querySelector(".sidebar_all");
      var icon = toggleButton.querySelector("i");

      // Add click event listener to the button
      toggleButton.addEventListener("click", function() {
          // Toggle the visibility of the sidebar
          if (sidebar.style.display === "none" || sidebar.style.display === "") {
              sidebar.style.display = "block";
              icon.classList.remove("fa-bars-staggered");
              icon.classList.add("fa-xmark");
          } else {
              sidebar.style.display = "none";
              icon.classList.remove("fa-xmark");
              icon.classList.add("fa-bars-staggered");
          }
      });
  </script>