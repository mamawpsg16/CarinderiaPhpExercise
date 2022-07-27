<?php 
    require 'validate_pizza.php';
    include 'config/db_connection.php';
     // check GET request id parameter
     if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn,$_GET['id']);

        //make a sql
        $query = "SELECT * FROM pizzas WHERE id = $id";

        // get query result 
        $result = mysqli_query($conn,$query);

        //fetch the result 
        $pizza = mysqli_fetch_assoc($result);

        //free the result 
        mysqli_free_result($result);

        //close connection  
        mysqli_close($conn);
    }

    if(isset($_POST['update'])){
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
            $id          = mysqli_real_escape_string($conn,$_POST['id']);

            //create sql
            $sql         = " UPDATE pizzas SET title='$title',email='$email',ingredients='$ingredients' WHERE id=$id ";

            //check and save to db
            if(mysqli_query($conn,$sql)){
                //success
                header("Location:details.php?id=$id");
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
    <h4 class="center">Edit</h4>
    <form action="edit.php" class="white" method="POST" enctype="multipart/form-data">

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($pizza['email'])  ;?>">
        <div class="div red-text">
            <?php echo $errors['email'] ?? '' ?>
        </div>

        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($pizza['title']) ;?>">
        <div class="div red-text">
            <?php echo $errors['title'] ?? '' ?>
        </div>

        <label for="ingredients">ingredients (comma sepparated):</label>
        <input type="text" name="ingredients" value="<?php echo htmlspecialchars($pizza['ingredients']) ;?>">
        <div class="div red-text">
            <?php echo $errors['ingredients'] ?? '' ?>
        </div>

        <div class="center">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($pizza['id']) ;?>">
            <input type="submit" value="Update" name="update" class="btn brand z-depth-0">
        </div>
    </form>
</section>
<?php include 'templates/footer.php'; ?>
</html>