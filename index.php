<?php

require "curl_call.php";

if(isset($_POST['deleteButton'])){

    $response =  getData('DELETE', $_POST['id']);
    print_r($response);
} else {
    $response = getData('GET');
}

include('header.html')
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">MFOUR User Data</h1>
    <a href="/mfour/add_user.php" class="btn btn-success btn-sm align-right" >Add User</a>

</div>
<div class="table-responsive">
    <table class="table table-striped data-table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">E-mail</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach ($response->data->users as $d){ ?>
        <tr>
            <td><?= $d->id ?></td>
            <td><?= $d->first_name ?></td>
            <td><?= $d->last_name ?></td>
            <td><?= $d->email ?></td>
            <td> <a href="/mfour-curl/edit.php/?id=<?= $d->id?>" class="edit btn btn-primary btn-sm" >Edit</a> |
                <form action="/mfour-curl/index.php" method="post" style="display: inline-block">
                    <input type="hidden" name="id" value="<?=$d->id?>">
                    <button type="submit" class="delete btn btn-danger btn-sm" name="deleteButton">Delete</button>
                </form>
            </td>
        </tr>
        <?php } ?>

        </tbody>
    </table>

</div>

<?php
    include ('footer.html');
?>

