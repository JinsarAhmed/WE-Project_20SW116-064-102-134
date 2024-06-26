<?php

session_start();

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {


    include_once 'dbConnect.php';

    $getsql = "SELECT * FROM users;";
    $result = mysqli_query($conn, $getsql);
    $resultCheck = mysqli_num_rows($result);

    ?>

    <!DOCTYPE html>
    <html>

    <head>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="style.css" rel="stylesheet">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>

        <title>Autozone</title>

    </head>

    <body class="bg-light">

        <div class="container">

            <nav class="navbar sticky-top navbar-light bg-light border-bottom border-2">
                <div class="container-fluid">

                    <a class="navbar-brand" href="product.php">
                        <img src="icons\AppLogo.jpeg" alt="" width="110rem" height="30rem">
                    </a>

                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link link-dark active" href="product.php">Buy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-dark " href="sell.php">Sell</a>
                        </li>
                        <li class="nav-item my-auto">
                            <form id="user" name="menuForm" method="POST" class="" action="productMenu.php">
                                <select onChange="user.submit()" name="userSel" id="usersel" class="userButton bg-light">
                                    ><option hidden value="user">
                                        <?php echo $_SESSION['name']; ?>
                                    </option>
                                    <option value="Dashbord">Dashbord</option>
                                    <option value="logout">Logout</option>
                                </select>
                            </form>
                        </li>
                    </ul>


                </div>
            </nav>

            <section class="container mt-1">
                <div class="row">
                    <h6>Admin Dashbord</h6>
                    <div class="col-sm-4 list-group">
                        <a href="adminDashbord.php" class="list-group-item list-group-item-action active">Users
                            Registered</a>
                        <a href="carsRegister.php" class="list-group-item list-group-item-action">Cars Registered</a>
                        <a href="orderRegister.php" class="list-group-item list-group-item-action">Orders Registered</a>
                        <a href="adminUpdate.php" class="list-group-item list-group-item-action">Update Account</a>
                        <a href="adminDeleteDashbord.php" class="list-group-item list-group-item-action">Delete Account</a>
                    </div>

                    <div class="col-sm-8 feedMargin mx-auto">
                        <h6>Users Registered</h6>
                        <div class="table-responsive ">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email ID</th>
                                        <th scope="col">Password</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <?php
                                if ($resultCheck > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        if ($row['name'] != $_SESSION['name']) {
                                            ?>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">
                                                        <?php echo $row['userID']; ?>
                                                    </th>
                                                    <td>
                                                        <?php echo $row['name']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['email']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['password']; ?>
                                                    </td>
                                                    <td>
                                                        <form id="deleter" method="POST" action="userDelete.php">
                                                            <select hidden name="deleteUser">
                                                                <option value="<?php echo $row['userID'] ?>"></option>
                                                            </select>
                                                            <button onclick=" deleter.submit() " class="btn btn-danger ">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        <?php
                                        }
                                    }
                                }
                                ?>
                            </table>
                        </div>
                    </div>
            </section>
    </body>

    </html>


    <?php

} else {

    header("Location: loginForm.php");

    exit();

}

?>