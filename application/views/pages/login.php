<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - Doctor Information System</title>
        <link rel="icon" href="<?= base_url() ?>assets/images/icon/doctor.png">
        <link href="<?= base_url()?>assets/css/styles.css" rel="stylesheet" />
        <link href="<?= base_url()?>assets/css/toastr.min.css" rel="stylesheet" />
        <script src="<?= base_url()?>assets/js/all.js"></script>
        <script>
            let $url = '<?= base_url(); ?>';
        </script>
    </head>
    <body class="bg-gray-400">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content" class="mt-5">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-4">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">Doctor Information System <br> User Login</h3>
                                    </div>
                                    <div class="card-body">
                                        <form
                                            id="form-login"
                                            onsubmit="event.preventDefault(); return doLogin();">
                                            <div class="form-floating mb-3">
                                                <input
                                                    class="form-control"
                                                    id="inputUsername"
                                                    type="text"
                                                    name="username"
                                                    placeholder="Username"
                                                    autocomplete="off"
                                                    required />
                                                <label for="inputUsername">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input
                                                    class="form-control"
                                                    id="inputPassword"
                                                    type="password"
                                                    name="password"
                                                    placeholder="Password"
                                                    required />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                           
                                            <div class="d-flex align-items-right justify-content-between mt-4 mb-0">
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                    <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                                </div>
                                                <button
                                                    type="submit"
                                                    id="btn-login"
                                                    button-message="Authenticating..."
                                                    class="btn btn-primary btn-sm">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="<?= base_url()?>assets/js/backend-bundle.min.js"></script>
        <script src="<?= base_url()?>assets/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url()?>assets/js/scripts.js"></script>
        <script src="<?= base_url()?>assets/js/toastr.min.js"></script>
        <script src="<?= base_url()?>assets/js/doctor.js"></script>
    </body>
</html>
