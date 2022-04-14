<link rel="stylesheet" href="<?php base_url() ?>assets/css/login.css">

<main class="form-signin text-center">
    <form method="POST" action="<?= base_url() ?>login/auth">
        <p><?= $this->session->flashdata('msg') ?></p>
        <img src="https://media.licdn.cn/dms/image/C4E0BAQHDYefo6aTuPA/company-logo_200_200/0/1522026012107?e=2159024400&v=beta&t=SzHpMfB6AozOFiXhM4ZaAoo7ZKXNM18IP11FnRiAi8A" class="rounded-circle" alt="ManyMinds" width="150">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <div class="form-floating">
            <input type="text" class="form-control" name="username" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
    </form>
</main>