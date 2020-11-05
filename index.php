<!doctype html>
<html lang="en">

<head>
    <title>Heros</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php require_once 'process.php'; ?>

    <?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
    <?php 
         echo $_SESSION['message'];
         unset ($_SESSION['message']);   
    ?>
    </div>
    <?php endif ?>
    <?php $mysqli = new mysqli('localhost', 'root', 'root', 'sqlheroes') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM heroes") or die($mysqli->error);
    $cards = $mysqli->query("SELECT * FROM heroes") or die($mysqli->error);
    ?>

<div class="row justify-content-center">
<?php
            while ($buttons = $result->fetch_assoc()) : ?>
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse<?php echo $buttons['id'];?>" aria-expanded="false" aria-controls="collapseExample">
        <?php echo $buttons['name'];?><br>
        <span class="badge badge-pill badge-secondary"><?php echo $buttons['powers'];?></span>
    </button>
    <?php endwhile; ?>
</div>
<div class="row">
<?php
while ($stuffs = $cards->fetch_assoc()) : ?>
<div class="collapse" id="collapse<?php echo $stuffs['id'];?>">
    <div class="card card-body text-center col-12 col-sm-12 col-md-8 col-lg-6 col-xl-6 mx-auto mr-o ml-0">
        <img class="img-fluid" src="<?php echo $stuffs['image_url'];?>">
        <h1><?php echo $stuffs['name'];?></h1><br>
        <span class="badge badge-pill badge-warning"><?php echo $stuffs['powers'];?></span>
        <h3><?php echo $stuffs['about_me'];?><br></h3>
        <p><?php echo $stuffs['biography'];?></p>
        <a href="index.php?edit=<?php echo $stuffs['id'];?>"
        class="btn btn-info">Edit</a>
        <a href="process.php?delete=<?php echo $stuffs['id'];?>"
        class="btn btn-danger">Delete</a>
    </div>
</div>
</div>
<?php endwhile; ?>

<div class="row justify-content-center">
    <form action="process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group text-center">
            <label>Hero Name</label><br>
            <input class="text-center" type="text" name="name" value="<?php echo $name;?>" placeholder="Enter Name">
        </div>
        <div class="form-group text-center">
            <label>About Your Hero</label><br>
            <input class="text-center" type="text" name="about_me" value="<?php echo $about_me;?>" placeholder="Enter About-Me">
        </div>
        <div class="form-group text-center">
            <label>Hero Biography</label><br>
            <input class="text-center" type="text" name="biography" value="<?php echo $biography?>" placeholder="Enter Biography">
        </div>
        <div class="form-group text-center">
            <label>Super Power</label><br>
            <input class="text-center" type="text" name="powers" value="<?php echo $powers?>" placeholder="Enter Super Power">
        </div>
        <div class="form-group text-center">
            <label>Hero Image URL</label><br>
            <input class="text-center" type="text" name="image_url" value="<?php echo $image_url?>" placeholder="Enter Image URL">
        </div>
        <?php 
        if ($update == true):
        ?>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-info" name="update">Update Hero</button>
        </div>
        <?php else: ?>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary" name="save">Add Hero</button>
        </div>
        <?php endif ?>
    </form>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>