<?php
    
    include 'config/db_connection.php';

    //get all pizzas from database
    $query = 'SELECT title, email, ingredients, id FROM pizzas ORDER BY created_at';

    //get results
    $result = mysqli_query($conn, $query);

    //fetch the result as array
    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //free the result from memory
    mysqli_free_result($result);

    //close connection 
    mysqli_close($conn);
    
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'templates/header.php'; ?>
    <h4 class="center grey-text">Mensah's Carinderia</h4>
    <div class="container">
        <div class="row">
            <?php foreach($pizzas as $pizza) :?>
                <div class="col s6 md3">
                    <div class="card z-depth-0">
                        <div class="card-content center">
                            <h6> <b><?php echo htmlspecialchars($pizza['title'])?></b> </h6>
                            <div> <?php echo htmlspecialchars($pizza['ingredients'])?></div>
                        </div>
                        <div class="card-action right-align">
                            <a href="details.php?id=<?php echo $pizza['id'] ?>" class="brand-text">more info.</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php include 'templates/footer.php'; ?>
</html>