<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="hackers-poulette-logo.png" alt="logo Hackers Poulette">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Hackers Poulette</title>
</head>

<body>

    <?php include('process.php'); ?>
    <img class="logo" src="hackers-poulette-logo.png" alt="logo Hackers Poulette" width="250px">
    <div class="container">
        <form id="contact" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
            <!-- $_SERVER 'PHP_SELF' calls the page itself, it means càd form.php, but also the form_process included when it ll be called -->
            <div class="row">
                <fieldset class="form-group col-md-6">
                    <label for="name">Name</label>
                    <input class="form-control form-control" placeholder="Name" type="text" id="name" tabindex="1" name="name" value="<?= $name ?>" autofocus tabindex="1" aria-label="Name"> <!-- value ="?= $name?>" allows to conserve fields after submited and if one of them missing -->
                    <span class="error"><?= $name_error ?></span> <!-- to display error message right under the field -->
                </fieldset>

                <fieldset class="form-group col-md-6">
                    <label for="lastname">Lastname</label>
                    <input class="form-control form-control" placeholder="Lastname" type="text" id="lastname" tabindex="2" name="lastname" value="<?= $lastname ?>" autofocus tabindex="2" aria-label="Lastname"> <!-- value ="?= $name?>" allows to conserve fields after submited and if one of them missing -->
                    <span class="error"><?= $lastname_error ?></span>
                </fieldset>
            </div>

            <fieldset class="form-group">
                <label for="gender">Gender</label><br>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="female" name="gender" tabindex="3" aria-label="Gender = Female" value="female" <?php if ($gender == "female") {
                                                                                                                                                            echo 'checked="checked"';
                                                                                                                                                        } ?>>
                    <label class="custom-control-label " for="female">Female</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="male" name="gender" tabindex="4" aria-label="Gender = Male" value="male" <?php if ($gender == "male") {
                                                                                                                                                        echo 'checked="checked"';
                                                                                                                                                    } ?>>
                    <label class="custom-control-label " for="male">Male</label>
                </div>
                <span class="error"><?= $gender_error ?></span>
            </fieldset>

            <fieldset class="form-group">
                <label for="email">Email adress</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">@</div>
                    </div>
                    <input class="form-control" placeholder="Email address" type="texte" id="email" name="email" value="<?= $email ?>" tabindex="5" aria-label="Email adress">
                </div>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                <span class="error"><?= $email_error ?></span>
            </fieldset>


            <fieldset class="autocomplete form-group" style="width:300px;">
                <label for="country">Country</label><br>
                <input class="form-control" placeholder="Country" id="country" type="text" name="country" value="<?= $country ?>" tabindex="6" aria-label="Country">
                <span class="error"><?= $country_error ?></span>
            </fieldset>


            <!-- Honneypot -->

            <input type="checkbox" name="contact_me_baby" value="1" style="opacity :0;" tabindex="-1" autocomplete="off">

            <fieldset class="form-group">
                <label>Type of subject</label><br>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input " id="order" name="subject" value="order" aria-label="subject'message = order" tabindex="7">
                    <label class="custom-control-label " for="order">Order</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="question" name="subject" value="question" aria-label="subject's message = question" tabindex="8">
                    <label class="custom-control-label" for="question">Question</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="others" name="subject" value="others" aria-label="subject's message = others" tabindex="9" checked>
                    <label class="custom-control-label" for="others">Others</label>
                </div>
            </fieldset>


            <fieldset class="form-group">
                <textarea class="form-control" placeholder="Type your message here...." type="text" name="message" value="<?= $message ?>" aria-label="message area" tabindex="10"></textarea>
            </fieldset>


            <fieldset class="form-group">
                <button class="btn btn-info" type="submit" id="contact-submit" name="submit" aria-label="submit" tabindex="11">Submit</button>
            </fieldset>

            <div class="success"><?= $success ?></div>
        </form>
    </div>
    <script type="text/javascript" src="functions.js"></script>
</body>

</html>