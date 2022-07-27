<?php 
    require 'validate_pizza.php';
    include 'config/db_connection.php';
    if(isset($_POST['submit'])){
        $validation = new ValidatePizza($_POST);
        $errors = $validation->validateForm();
        // $errors = $validate_errors;
        // echo htmlspecialchars($_POST['email']);
        // echo htmlspecialchars($_POST['title']);
        // echo htmlspecialchars($_POST['ingredients']);

        if(array_filter($errors)){
            // echo 'errors in the form';
        }else{
            $email       = mysqli_real_escape_string($conn,$_POST['email']);
            $title       = mysqli_real_escape_string($conn,$_POST['title']);
            $ingredients = mysqli_real_escape_string($conn,$_POST['ingredients']);

            //create sql
            $sql         = "INSERT INTO pizzas(title,email,ingredients) VALUES('$title','$email','$ingredients')";

            //check and save to db
            if(mysqli_query($conn,$sql)){
                //success
                header('Location:index.php');
            }else{
                //error
                echo 'Query Error: '.mysqli_error($conn);
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'templates/header.php'; ?>
<section class="container grey-text">
    <h4 class="center">Add a Menu</h4>
    <form action="add.php" class="white" method="POST" enctype="multipart/form-data">

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo (!empty($_POST['email'])) ? htmlspecialchars($_POST['email']) : '' ?>">
        <div class="div red-text">
            <?php echo $errors['email'] ?? '' ?>
        </div>
        
        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo (!empty($_POST['email'])) ? htmlspecialchars($_POST['title']) : '' ?>">
        <div class="div red-text">
            <?php echo $errors['title'] ?? '' ?>
        </div>

        <label for="ingredients">ingredients (comma sepparated):</label>
        <input type="text" name="ingredients" value="<?php echo (!empty($_POST['email'])) ? htmlspecialchars($_POST['ingredients']) : '' ?>">
        <div class="div red-text">
            <?php echo $errors['ingredients'] ?? '' ?>
        </div>

        <div class="center">
            <input type="submit" value="Submit" name="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>
<?php include 'templates/footer.php'; ?>
</html>