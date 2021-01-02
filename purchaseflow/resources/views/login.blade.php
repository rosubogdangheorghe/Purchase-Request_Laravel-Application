
<?php require("../public/includes/head.php");?>

  </head>

    <body>
        <div class = "container position-relative" style="margin-top:15%">
            <div class="card">
                <div class = "card-body">
                <form action="{{ route('login') }}" method="POST" class="was-validated align-middle">
                         <div class="form-group">
                            <label class = "col-form-label-sm" for = "username">Username</label>
                            <input type="text" name="username" class="form-control-sm" placeholder="username" id="username" required>
                            <div class="valid-feedback">Valid</div>
                            <div class="invalid-feedback">Please fill out this field</div>
                        </div>
                        <div class="form-group">
                        <label class = "col-form-label-sm" for = "password">Password</label>
                            <input type="password" name="password" class="form-control-sm" placeholder="password" id="password" required>
                            <div class="valid-feedback">Valid</div>
                            <div class="invalid-feedback">Please fill out this field</div>
                        </div>

                    <button type="submit" class="btn btn-primary mb-2">LogIn</button>
             </form>
             </div>
            </div>

        </div>
    </body>
    </html>

