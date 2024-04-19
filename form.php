<!--AHMAD ARIF AIMAN B. AHMAD FAUZI | 2113419
INFO4345/S1 WEB APP SECURITY -->

<?php require 'session_checks.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment01</title>
    <!--css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/validation.js"></script>
</head>
    
<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-offset="70" class="scrollspy" tabindex="0">
    <nav id="navbar" class="navbar navbar-light bg-light fixed justify-content-end">
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link" href="#section1">Student Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#section2">Student Information</a>
            </li>
            <li>
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </nav>
    
    <section id="section1" style="margin: 50px 0;">
        <h1 style="text-align: center;margin: 20px 0;" >A. Student Details</h1>
        <div class="container">
            <form id="form" action="addData.php" method="post" onsubmit="return validation()">
                <div class="row text-align">
                    <div class="form-group col-lg-2">
                        <label for="name" class="form-label">Name (Legal/Official):</label>
                        <input type="text" id="name" name="name" class="form-control" pattern="[A-Za-z].{1,}" required>
                    </div>
                    
                    <div class="form-group col-lg-2">
                        <label for="matric-no" class="form-label">Matric No:</label>
                        <input type="text" id="matric-no" name="matric_no" class="form-control" pattern="^\d{7}$" required>
                    </div>
                    
                    <div class="form-group"><br>
                        <label for="current-address" class="form-label">Current Address:</label>
                        <textarea id="current-address" name="current_address" class="form-control" pattern="[A-Za-z0-9\s,.]+(?:\d{5})?.*" required></textarea>
                    </div>
                    
                    <div class="form-group"><br>
                        <label for="home-address" class="form-label">Home Address:</label>
                        <textarea id="home-address" name="home_address" class="form-control" pattern="[A-Za-z0-9\s,.]+(?:\d{5})?.*" required></textarea>
                    </div>
                    
                    <div class="form-group"><br>
                        <label for="email" class="form-label">Email (Gmail Account):</label>
                        <input type="email" id="email" name="email" class="form-control" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" required>
                    </div>
                    
                    <div class="form-group col-lg-2"><br>
                        <label for="mobile-phone" class="form-label">Mobile Phone No:</label>
                        <input type="tel" id="mobile-phone" name="mobile_phone" class="form-control" pattern="[0-9].{10,}" required>
                    </div>

                    <div class="form-group col-lg-3"><br>
                        <label for="home-phone" class="form-label">Home Phone No (Emergency):</label>
                        <input type="tel" id="home-phone" name="home_phone" class="form-control" pattern="[0-9].{10,}" required>
                    </div>

                    <div class="form-group" style="display: grid; align-items: flex-end; margin-top: 20px;">
                        <input type="submit" name="formSubmit" id="formSubmit" class="btn btn-primary" required>
                    </div>
                </div>
            </form>
        </div>
    </section>
    
    <section id="section2" style="margin: 50px 0;">
        <h1 style="text-align: center;margin: 50px 0;" >B. Student Information</h1>
        <div class="container">
            <table class="table table-hover">
                <tbody id="data-container">
                    <script>
                        fetch('crud.php')
                            .then(response => response.text())
                            .then(html => document.getElementById('data-container').innerHTML = html)
                            .catch(error => console.error('Error loading the data:', error));
                        
                        function performAction(action, id) {
                                if (action === 'delete' && !confirm('Are you sure you want to delete this record?')) {
                                    return; // User cancelled the delete operation
                                }
                                
                                var formData = new FormData();
                                formData.append('action', action);
                                formData.append('id', id);

                                // Add other fields if the action is 'edit'
                                if (action === 'edit') {
                                    formData.append('name', document.getElementById('name' + id).value);
                                    formData.append('matric_no', document.getElementById('matric_no' + id).value);
                                    formData.append('current_address', document.getElementById('current_address' + id).value);
                                    formData.append('home_address', document.getElementById('home_address' + id).value);
                                    formData.append('email', document.getElementById('email' + id).value);
                                    formData.append('mobile_phone', document.getElementById('mobile_phone' + id).value);
                                    formData.append('home_phone', document.getElementById('home_phone' + id).value);
                                }

                                fetch('crud.php', {
                                    method: 'POST',
                                    body: formData
                                })
                                .then(response => response.text())
                                .then(result => {
                                    alert(result);
                                    if (action === 'delete') {
                                        document.getElementById('row' + id).remove(); // Remove the row from the table
                                    } else if (action === 'edit') {
                                        // Update the row with the new values
                                        document.getElementById('name' + id).textContent = document.getElementById('name' + id).value;
                                        document.getElementById('matric_no' + id).textContent = document.getElementById('matric_no' + id).value;
                                        document.getElementById('current_address' + id).textContent = document.getElementById('current_address' + id).value;
                                        document.getElementById('home_address' + id).textContent = document.getElementById('home_address' + id).value;
                                        document.getElementById('email' + id).textContent = document.getElementById('email' + id).value;
                                        document.getElementById('mobile_phone' + id).textContent = document.getElementById('mobile_phone' + id).value;
                                        document.getElementById('home_phone' + id).textContent = document.getElementById('home_phone' + id).value;
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert('Operation failed');
                                });
                            }
                    </script>
                </tbody>
            </table>
        </div>
    </section>
        
</body>
</html>