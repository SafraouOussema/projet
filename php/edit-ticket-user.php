<?php

session_start();
include_once "config.php";
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
}
// including the database connection file

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $location = $_POST['location'];


    // checking empty fields
    if (empty($location)) {

        if (empty($location)) {
            echo "<font color='red'>location field is empty.</font><br/>";
        }
    } else {
        //updating the table
        $result = mysqli_query($conn, "UPDATE tickets SET location_id='$location'  WHERE id=$id");

        //redirectig to the display page. In our case, it is   view-ticket-user
        header("Location: ../ticket-user.php");
    }
}

//getting id from url
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    //selecting data associated with this particular id
    $result = mysqli_query($conn, "SELECT * FROM tickets WHERE id=$id");

    while ($res = mysqli_fetch_array($result)) {
        $location = $res['location_id'];
    }
    echo "<script>console.log('Debug Objects: " . $location . "' );</script>";


    // mysql select query
    $query = "SELECT * FROM `location`";
    // for method 1
    $result1 = mysqli_query($conn, "SELECT * FROM location");
}
?>

<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <!--=============== BOXICONS ===============-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

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

                    <a href="../location.php" class="nav__link">
                        <i class='bx bx-world'></i>
                        <span class="nav__name">Location</span>
                    </a>

                    <a href="../truck.php" class="nav__link">
                        <i class='bx bxs-truck'></i>
                        <span class="nav__name">Truck</span>
                    </a>

                    <a href="../ticket-client.php" class="nav__link ">
                        <i class='bx bxs-bookmark'></i>
                        <span class="nav__name">Ticket</span>
                    </a>

                    <a href="../list-user.php" class="nav__link">
                        <i class='bx bx-user-pin'></i>
                        <span class="nav__name">List user</span>
                    </a>
                <?php
                } else {
                ?>
                    <a href="../ticket-user.php" class="nav__link active-link">
                        <i class='bx bx-bookmark'></i>
                        <span class="nav__name">Ticket</span>
                    </a>
                <?php
                }
                ?>

                <a href="../users.php" class="nav__link ">
                    <i class='bx bx-envelope'></i>
                    <span class="nav__name">Messages</span>
                </a>

                <a href="logout.php?logout_id=<?php echo $_SESSION['unique_id']; ?>" class="nav__link logout">
          <i class='bx bx-log-out'></i>
          <span class="nav__name">Logout </span>
        </a>


            </div>
        </nav>
    </div>
    <!--=============== MAIN ===============-->
    <main class="container section">


        <form name="form1" method="post" action="edit-ticket-user.php">
            <table class="table table-bordered">

                <tr>
                    <td>Location</td>
                    <td>
                        <select name="location">
                            <?php while ($row1 = mysqli_fetch_array($result1)) :; ?>
                                <option value="<?php echo $row1[0]; ?>" <?php if ($location == $row1[0]) echo 'selected="selected"'; ?>> <?php echo $row1[1]; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </td>
                </tr>
 
                <tr>
                    <td><input type="hidden" name="id" value=<?php if (isset($_GET['id'])) {
                                                                    echo $_GET['id'];
                                                                } ?>></td>
                    <td><input class="btn btn-primary" type="submit" name="update" value="Update"></td>
                </tr>

            </table>
        </form>
    </main>
</body>

<script src="javascript/users.js"></script>

<!--=============== MAIN JS ===============-->
<script src="../assets/js/main.js"></script>
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