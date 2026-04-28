<?php
include '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Management System</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
    <header>
    <a href="#" onclick="showSection('home')">
        <img src="../image/logo.svg" id="logo" alt="Logo">
    </a>
    <h1>Student Management System</h1>
</header>


    <div class="container">
        <button onclick="showSection('home')">Home</button>
        <button onclick="showSection('create')">Create</button>
        <button onclick="showSection('information')">Information</button>
        <button onclick="showSection('update')">Update</button>
        <button onclick="showSection('delete')">Delete</button>

        <!-- HOME -->
        <section id="home" class="content" style="display:block;">
            <h2>Welcome to the Student Management System</h2>
            <p>Select an option above to manage student records.</p>
        </section>

        <!-- CREATE -->
        <section id="create" class="content">
            <h2>Insert New Student</h2>
            <form method="post" action="">
                <input type="text" name="surname" placeholder="Surname">
                <input type="text" name="name" placeholder="Name">
                <input type="text" name="middlename" placeholder="Middle Name">
                <input type="text" name="address" placeholder="Address">
                <input type="number" name="contact_number" placeholder="Mobile Number">
                <button type="button" onclick="clearFields()">Clear Fields</button>
                <button type="submit" name="save">Save</button>
            </form>
            <?php
            if(isset($_POST['save'])){
                $surname = $_POST['surname'];
                $name = $_POST['name'];
                $middlename = $_POST['middlename'];
                $address = $_POST['address'];
                $contact = $_POST['contact_number'];
                $sql = "INSERT INTO students (surname,name,middlename,address,contact_number) 
                        VALUES ('$surname','$name','$middlename','$address','$contact')";
                if($conn->query($sql)){
                    echo "<p>Student saved successfully!</p>";
                }
            }
            ?>
        </section>

        <!-- INFORMATION -->
        <section id="information" class="content">
            <h2>Student Information</h2>
            <?php
            $result = $conn->query("SELECT * FROM students");
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    echo "<div class='info-card'>
                            <h3>{$row['surname']}, {$row['name']} {$row['middlename']}</h3>
                            <p><strong>ID:</strong> {$row['id']}</p>
                            <p><strong>Address:</strong> {$row['address']}</p>
                            <p><strong>Contact:</strong> {$row['contact_number']}</p>
                          </div>";
                }
                echo "<p>Total Students: " . $result->num_rows . "</p>";
            } else {
                echo "<p>No student records found.</p>";
            }
            ?>
        </section>

        <!-- UPDATE -->
        <section id="update" class="content">
            <h2>Update Student</h2>
            <form method="post" action="">
                <input type="number" name="id" placeholder="Student ID">
                <input type="text" name="name" placeholder="New Name">
                <input type="text" name="surname" placeholder="New Surname">
                <button type="submit" name="update">Update</button>
            </form>
            <?php
            if(isset($_POST['update'])){
                $id = $_POST['id'];
                $name = $_POST['name'];
                $surname = $_POST['surname'];
                $sql = "UPDATE students SET name='$name', surname='$surname' WHERE id=$id";
                if($conn->query($sql)){
                    echo "<p>Record updated!</p>";
                }
            }
            ?>
        </section>

        <!-- DELETE -->
        <section id="delete" class="content">
            <h2>Delete Student</h2>
            <form method="post" action="">
                <input type="number" name="id" placeholder="Student ID">
                <button type="submit" name="delete">Delete</button>
            </form>
            <?php
            if(isset($_POST['delete'])){
                $id = $_POST['id'];
                $sql = "DELETE FROM students WHERE id=$id";
                if($conn->query($sql)){
                    echo "<p>Record deleted!</p>";
                }
            }
            ?>
        </section>
    </div>
</body>
</html>
