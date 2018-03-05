<?php
require_once "config.php";
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: auth/login.php");
  exit;
}
$amount = "";
$amount_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(empty(trim($_POST["amount"]))){
        $amount_err = "You have not made any money, if you have input the amount.";
    }else{

        $amount = trim($_POST["amount"]);
        $id = $_SESSION['id'];
        $sql = "INSERT INTO income (amount, user_id) VALUES (:amount, :id)";
        
        if($stmt = $pdo->prepare($sql)){
            
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':amount', $param_amount, PDO::PARAM_STR);
            $stmt->bindParam(':id', $param_id, PDO::PARAM_STR);
            // Set parameters
            $param_amount = $amount;
            $param_id = $id;
            // var_dump($stmt->execute());exit;
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                $items = array(
                    "family" => 10,
                    "housing" => 10,
                    "charity" => 5,
                    "tithe" => 10,
                    "offering" => 0.5,
                    "travelling" => 2,
                    "cloting" => 2,
                    "entertainment" => 7,
                    "saving" => 10,
                    "investment" => 10,
                    "health" => 10,
                    "business" => 10,
                    "gadget" => 5,
                    "car" => 4,
                    "food" => 4
                );
                
            } else{
                echo "Something went wrong. Please try again later.";

            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style type="text/css">
        body{ font: 14px sans-serif; padding:3px;}
        .wrapper{ width: 350px; padding: 20px; }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Personal Accounting Tool</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <input placeholder="Income" type="amount" name="amount" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary">compute</button>
                        </div>
                    </div>
                </form>
            </div>
            <a href="auth/logout.php">logout</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Item</th>
                    <th scope="col">%</th>
                    <th scope="col">Amount</th>
                </tr>
            </thead>
            <tbody>
            <?php if(isset($_POST['amount'])){
                foreach ($items as $item => $percentage):?>
                    <tr>
                        <td><?=$item?></td>
                        <td><?=$percentage?></td>
                        <td><?=($percentage / 100) * $_POST['amount'];?></td>
                    </tr>
            <?php endforeach;}?>
            </tbody>
        </table>
    </div>
</body>
</html>
