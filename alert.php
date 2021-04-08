<?php if (isset($_COOKIE["error"])) : ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong> <?= $_COOKIE["error"] ?>
    </div>
<?php endif; ?>


<?php if (isset($_COOKIE["success"])) : ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> <?= $_COOKIE["success"] ?>
    </div>
<?php endif; ?>


