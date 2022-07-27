<?php
    include 'config/db_connection.php';
    if(isset($_POST['delete'])){
        $id = mysqli_real_escape_string($conn,$_POST['id']);

        //make sql 
        $query = "DELETE FROM pizzas WHERE id = $id";

        //get query result 
        if(mysqli_query($conn,$query)){
            //success
            header('Location:index.php');
        }else{
            echo 'query error: '.mysqli_query($conn,$query);
        }
    }
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
?>
<!DOCTYPE html>
<html lang="en">
    <?php include 'templates/header.php'; ?>
    <div class="container center">
        <?php if($pizza):?>
            <h4><b><?php echo htmlspecialchars($pizza['title']) ;?></b></h4>
            <p>Created by : <?php echo htmlspecialchars($pizza['email']) ;?></p>
            <p><?php echo date($pizza['created_at']) ;?></p>
            <h5>Ingridients :</h5>
            <p><?php echo htmlspecialchars($pizza['ingredients']) ;?></p>
             <!-- DELETE FORM -->
            <form action="details.php" method="POST" enctype="multipart/form">
                <a href="edit.php?id=<?php echo $pizza['id'] ;?>" class="btn brand z-depth-0">Edit</a>
                <input type="hidden" name="id" value="<?php echo $pizza['id'] ;?>">
                <input type="submit" value="Delete" name="delete" class="btn brand z-depth-0" >
            </form>
        <?php else: ?>
            <h5>No such menu exists!</h5>
        <?php endif; ?>
    </div>
    <?php include 'templates/footer.php'; ?>
</html>