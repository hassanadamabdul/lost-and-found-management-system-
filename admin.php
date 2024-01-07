<!DOCTYPE html>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>
        Admin Area (flown things)
    </title>
</head>
<body class="blue-grey darken-4">
<nav>
    <div class="nav-wrapper  blue-grey darken-3  ">
        <a href="#" class="brand-logo center " style="text-transform: uppercase;overflow: hidden;">Admin Area <span
                class="hide-on-med-and-down"></span> </a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li style="margin-right: 0px;" ><a class="btn teal" href="catageory.php">Category</a> </li>
            <li style="margin-right: 0px;" ><a class="btn teal" href="index.php">home</a> </li>
            <li style="margin-left: 0px" ><a class="btn teal" href="logut.php">logout</a> </li>
            <!-- <li><a href="badges.html">Components</a></li>
           <li><a href="collapsible.html">JavaScript</a></li>-->
        </ul>
    </div>
</nav>
<br>
<?php
    require ("session.php");
    require ("config.php");
    require ("functions.php");
    auth_admin();

    mysqli_query($conn,"SET @p0='0'");
    mysqli_query($conn,"CALL `userCount`(@p0)");
    $proce=mysqli_fetch_array(mysqli_query($conn,"SELECT @p0 AS `counts`"));
    $tu=$proce['counts'];

    //$tu=t_count('user');
    $tl=tp_count('lthings');
    $tf=tp_count('fthings');
    $td=draft_post_count();

?>
<style>
    .row {
        margin-bottom: 0px;
    }
    .xx{
        overflow-y:scroll;
        height: 350px;
        display:block;
    }
</style>
<div class="row" style="margin: 0px;">
    <div class="col s12 m12 l3">
        <div class="card blue darken-2">
            <div class="card-content white-text">
                <span class="card-title">Total User's</span>
                <?php echo"<p>$tu</p>"?>
                <span><a href="admin.php" class="disabled btn">VIEW</a></span>
            </div>
        </div>
    </div>

    <div class="col s12 m12 l3">
        <div class="card blue darken-2">
            <div class="card-content white-text">
                <span class="card-title">  Lost post's</span>
                <?php echo"<p>$tl</p>"?>
                <span><a href="adminlost.php" class="btn">VIEW</a></span>
            </div>
        </div>
    </div>

<!-- View all found items-->
    <div class="col s12 m12 l3">
        <div class="card blue darken-2">
            <div class="card-content white-text">
                <span class="card-title"> Found post's</span>
                <?php echo"<p>$tf</p>"?>
                <span><a href="adminfound.php" class="btn">VIEW</a></span>
            </div>
        </div>
    </div>
<!--Draft post-->
    <div class="col s12 m12 l3">
        <div class="card blue darken-2">
            <div class="card-content white-text">
                <span class="card-title">Drafted posts</span>
                <?php echo"<p>$td</p>"?>
                <span><a href="admindraft.php" class=" btn">VIEW</a></span>
            </div>
        </div>
    </div>


    
<!-- Add User Button -->
<div class="col s12 m12 l3">
    <div class="card blue darken-2">
        <div class="card-content white-text">
            <span class="card-title">Add User</span>
            <!-- Open the modal with the unique identifier "addUserModal" -->
            <span><a href="#addUserModal" class="modal-trigger btn">ADD</a></span>
        </div>
    </div>
</div>

<!-- Match items-->
<div class="col s12 m12 l3">
    <div class="card blue darken-2">
        <div class="card-content white-text">
            <span class="card-title">Match Found and Lost item</span>
            <span><a href="match.php" class="btn">MATCH</a></span>
        </div>
    </div>
</div>



</div><!--main bar-->
<div class="container" style="margin-top: 0px;">


    <div class="white-text blue-grey darken-1 xx z-depth-1" style="border-radius: 5px;">
        <table class="centered  responsive-table  ">
            <div class="center-align flow-text">USERS</div>
            <thead>
            <tr>
                <th>User name</th>
                <th>email</th>
                <th>total post</th>
                <th>delete user</th>

            </tr>
            </thead>
            <tbody>
            <?php
            get_user_list();
            ?>
            </tbody>
        </table>


    </div>


</div>
<br>

<!-- Add User Form Modal -->
<div id="addUserModal" class="modal">
    <div class="modal-content">
        <h4>Add User</h4>
        <!-- Specify the action attribute to point to adduser.php -->
        <form id="addUserForm" action="adduser.php" method="POST">
            <div class="input-field">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>
            <div class="input-field">
                <input type="text" name="first_name" required>
                <label>First Name</label>
            </div>
            <div class="input-field">
                <input type="text" name="last_name" required>
                <label>Last Name</label>
            </div>
            <div class="input-field">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>
            <button class="btn teal" type="submit">Submit</button>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modals = document.querySelectorAll('.modal');
        M.Modal.init(modals);
    });
</script>

</body>
</html>
