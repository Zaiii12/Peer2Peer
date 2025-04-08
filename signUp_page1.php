<!DOCTYPE html>
<html lang="en">

<?php
    include 'Scripts/dbconnect.php';
    $db = new Database(); 
    $conn = $db->conn; 
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Tutor</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="overlay">
        <div class="signUpForm1">
            <h1>SIGN UP</h1>
            <form action="" method="POST">
                <div class="row g-3 align-items-center">
                    <div class="col-md-6">
                        <label for="formFile" class="form-label">Upload photo</label>
                        <input class="form-control" type="file" id="formFile">
                    </div>
                    <div class="col-md-6">
                        <label for="formFile" class="form-label">Upload your credentials <span class="text-danger">*</span></label>
                        <input class="form-control" type="file" id="formFile">
                    </div>
                </div>

                <div class="row g-3 align-items-center">
                    <div class="col-md-6">
                        <label for="firstName" class="form-label">First Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="firstName" placeholder="First name">
                    </div>
                    <div class="col-md-6">
                        <label for="lastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="lastName" placeholder="Last name">
                    </div>
                </div>

                <div class="row g-3 align-items-center">
                    <div class="col-md-6">
                        <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                        <select class="form-select">
                            <option selected>Select</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                            <option value="Prefer not to say">Prefer not to say</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="username" placeholder="Username">
                    </div>
                </div>
                
                <div class="row g-3 align-items-center">
                    <div class="col-md-6">
                        <label for="emailAddress" class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input class="form-control" type="email" id="emailAddress" placeholder="Email Address">
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input class="form-control" type="password" id="password" placeholder="Password">
                    </div>
                </div>

                <div class="row g-3 align-items-center">
                    <div class="col-md-6">
                        <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                        <label class="form-check-label tnc" for="checkDefault">
                            I agree to the 
                            <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">
                              Terms and Conditions <span class="text-danger">*</span>
                            </a>
                        </label>

                        
                    </div>
                </div>
                <button type="submit" class="btn btn-danger signUpButton">SIGN UP</button>
                <p class="loginLink">Already have an account? <a href="../Peer2peer/login_page.html">Login</a></p>
            </form>

        </div>
    </div>
    

    
    <!-- Terms and Conditions Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nec justo a erat faucibus facilisis. Donec gravida eros nec justo dictum, sed pharetra leo rhoncus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                    <p>Morbi ac quam nec risus varius gravida. Nulla facilisi. Aenean non luctus magna. Curabitur nec velit non nunc tempor porttitor. Donec et sapien at ex fermentum blandit non vel erat.</p>
                    <p>By continuing, you agree to comply with our policies and conditions.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>