<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "headerChat.php"; ?>
<body>
  
  <!--=============== NAV ===============-->
  <div class="nav" id="nav">
    <nav class="nav__content">
      <div class="nav__toggle" id="nav-toggle">
        <i class='bx bx-chevron-right'></i>
      </div>
 

      <div class="nav__list">
        <?php
        if ($_SESSION['role'] === 'admin') {
        ?>
      

          <a href="location.php" class="nav__link">
            <i class='bx bx-world' ></i>
            <span class="nav__name">Location</span>
          </a>

          <a href="truck.php" class="nav__link">
          <i class='bx bxs-truck'></i>
            <span class="nav__name">Truck</span>
          </a>

          <a href="ticket-client.php" class="nav__link">
          <i class='bx bxs-bookmark'></i>
           <span class="nav__name">Ticket</span>
          </a>

          <a href="list-user.php" class="nav__link">
          <i class='bx bx-user-pin'></i>
          <span class="nav__name">List user</span>
          </a>
        <?php
        } else {
        ?>
          <a href="ticket-user.php" class="nav__link">
            <i class='bx bx-bookmark'></i>
            <span class="nav__name">Ticket</span>
          </a>
        <?php
        }
        ?>

        <a href="users.php" class="nav__link active-link">
          <i class='bx bx-envelope'></i>
          <span class="nav__name">Messages</span>
        </a>

        <a href="php/logout.php?logout_id=<?php echo $_SESSION['unique_id']; ?>" class="nav__link logout">
          <i class='bx bx-log-out'></i>
          <span class="nav__name">Logout </span>
        </a>

      </div>
    </nav>
  </div>

  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="php/images/<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>

</body>
</html>
