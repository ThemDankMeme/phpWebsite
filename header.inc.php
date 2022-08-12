<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<div class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li><a href="index.php">HOME</a></li>
            <?php if(isset($_SESSION['logon'])){ ?>
                <li><a href="sell.php">SELL</a></li>
            <?php } else{ ?>
                <li><a href="login.php">SELL</a></li>
            <?php } ?>
        </ul>
        <form class="navbar-form navbar-left" action="searchPage.php" method="post">
            <div class="form-group">
                <input type="text" name="search" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> Search</button>
        </form>
        <ul class="nav navbar-nav navbar-right">
            <?php if(isset($_SESSION['logon'])){ ?>
                <li><a><span class="glyphicon glyphicon-user"></span> <?php echo($_SESSION['user'])?></a></li>
                <li><a href="logout.inc.php"><span class="glyphicon glyphicon-log-out"></span> Log-Out</a></li>
            <?php } else{ ?>
                <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign-Up</a></li>
                <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Log-In</a></li>
            <?php } ?>
        </ul>
    </div>
</div>