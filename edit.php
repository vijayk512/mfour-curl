<?php
require "curl_call.php";
if(isset($_POST['SubmitButton']) && $_GET['id']) {

    $data = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'email' => $_POST['email'],
    ];

    $response = postData('PUT', $data, $_GET['id']);

    if($response->status == 'success'){

        header("Location: /mfour/index.php");

        exit;
    } else {
        foreach ($response->data as $key => $e){
            $errors[$key] = $e;
        }
    }
}

if($_GET['id']){
    $response = getData('GET', $_GET['id']);
}

include('header.html')
?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">MFOUR Edit User Data</h1>

    </div>
    <form method="POST" action="/mfour-curl/edit.php?id=<?=$_GET['id']?>">

        <div class="modal-body">
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="first_name" class="col-form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control" id="first_name" value="<?=$response->data->users->first_name; ?>" />
                    <?php if (isset($errors) && array_key_exists('first_name', $errors)) { ?><small class="text-danger"><?= $errors['first_name'][0] ?></small> <?php } ?>
                </div>
                <div class="col-sm-6">
                    <label for="last_name" class="col-form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control" id="last_name" value="<?=$response->data->users->last_name; ?>"/>
                    <?php if (isset($errors) && array_key_exists('last_name', $errors)) { ?><small class="text-danger"><?= $errors['last_name'][0] ?></small> <?php } ?>

                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="email" class="col-form-label">Email</label>
                    <input type="text" name="email" class="form-control" id="email" value="<?=$response->data->users->email; ?>"/>
                    <?php if (isset($errors) && array_key_exists('email', $errors)) { ?><small class="text-danger"><?= $errors['email'][0] ?></small> <?php } ?>

                </div>
            </div>

        </div>
        <div class="modal-footer">
            <a href="/mfour-curl/index.php" class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-primary" name="SubmitButton">Update</button>
        </div>
    </form>

<?php
include ('footer.html');


