<?php

use App\Auth\Register;

require './connection.php';
require './header.php';
?>
<div class="wrapper bg-light">
    <div class="authTabs d-flex flex-column justify-content-center align-items-center" style="height:100vh;">
        <div class="tabs d-flex">
            <button data-tab="loginTab" class="tab active-tab">Login</button>
            <button data-tab="registerTab" class="tab">Register</button>
        </div>
        <div class="loginTab bg-secondary active tab-c card show p-5 mt-5">
            <h3 class="text-center text-white">Login</h3>
            <form action="/auth/login.php" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>

                <div class="btnWrapper text-center w-100">

                    <button type="submit" class="btn btn-primary w-75">Login</button>
                </div>
            </form>
        </div>

        <div class="registerTab bg-secondary card tab-c p-5 mt-5">
            <h3 class="text-center text-white">Register</h3>
            <form action="/auth/register.php" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="btnWrapper text-center w-100">
                    <button type="submit" class="btn btn-primary w-75">Register</button>
                </div>
            </form>
            <?php if (isset($_GET['error']) && $_GET['error'] === 'true') : ?>
                <p class="alert alert-danger mt-3" role="alert">There is already an account associated with this email!</p>
            <?php endif; ?>
            <?php if (isset($_GET['error']) && $_GET['error'] === 'false') : ?>
                <p class="alert alert-success mt-3" role="alert">Account created Successfully!</p>
            <?php endif; ?>
        </div>

    </div>
</div>


<?php
require './footer.php';
