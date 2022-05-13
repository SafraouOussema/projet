<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
  header("location: login.php");
}
?>
<?php include_once "header.php"; ?>


<?php
//including the database connection file

//fetching data in descending order (lastest entry first)
$result = mysqli_query($conn, "SELECT ticket.id,ticket.status,loc.name,loc.cost,user.fname,user.lname FROM tickets  as ticket,location as loc , users as user  WHERE  ticket.location_id = loc.id and ticket.user_id =" . $_SESSION['user_id'] . " and user.user_id =" . $_SESSION['user_id'] . " and ticket.status != 'Done' ORDER BY ticket.id DESC");
 

$result1 = mysqli_query($conn, "SELECT * FROM location");
$location ='';

?>

<body>

  <!--=============== NAV ===============-->
  <div style="padding-left: 2rem;" class="nav" id="nav">
    <nav class="nav__content">
      <div class="nav__toggle" id="nav-toggle">
        <i class='bx bx-chevron-right'></i>
      </div>
 

      <div class="nav__list">
        <?php
        if ($_SESSION['role'] === 'admin') {
        ?>
         

          <a href="location.php" class="nav__link">
            <i class='bx bx-world'></i>
            <span class="nav__name">Location</span>
          </a>

          <a href="truck.php" class="nav__link">
            <i class='bx bxs-truck'></i>
            <span class="nav__name">Truck</span>
          </a>

          <a href="ticket-client.php" class="nav__link ">
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
          <a href="ticket-user.php" class="nav__link active-link">
            <i class='bx bx-bookmark'></i>
            <span class="nav__name">Ticket</span>
          </a>
        <?php
        }
        ?>

        <a href="users.php" class="nav__link ">
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
  <!--=============== MAIN ===============-->
  <main class="container section">
    <h2>Ticket</h2>
    <br>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="text-align: right;" colspan="5">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddTicketUser"> <i class='bx bx-add-to-queue'></i> </button>
          </th>
        </tr>
        <tr>
          <td>Status</td>
          <td>Location</td>
          <td>Cost</td>
          <td>User</td>
          <td>Action</td>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($res = mysqli_fetch_array($result)) {
          echo "<tr>";
          echo "<td>" . $res[1] . "</td>";
          echo "<td>" . $res[2] . "</td>";
          echo "<td>" . $res[3] . "</td>";
          echo "<td>" . $res[4] . " " . $res[5] . "</td>";
          echo "<td> <a class='btn btn-success editbtn' href=\"php/edit-ticket-user.php?id=$res[id]\">Edit</a>   <a class='btn btn-danger ' href=\"php/delete-ticket-user.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\"><i class='bx bx-trash' ></i></a></td>";
        }
        ?>

      </tbody>
    </table>


    <div class="modal fade" id="AddTicketUser" tabindex="-1" role="dialog" aria-labelledby="AddTicketUserLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="AddTicketUserLabel">Add Ticket</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="php/add-ticket-user.php" method="post" name="form1">
              <table width="25%" border="0">
                <tr>
                  <td>Location</td>
                  <td>
                    <select name="location">
                      <?php while ($row1 = mysqli_fetch_array($result1)) :; ?>
                        <option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
                      <?php endwhile; ?>
                    </select>
                  </td>
                </tr>
              </table>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="Submit" class="btn btn-primary">Add</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


  </main>

  <script src="javascript/users.js"></script>

  <!--=============== MAIN JS ===============-->
  <script src="assets/js/main.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

  <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>




</body>

</html>