<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php 

        $first_numberErr = $second_numberErr = $signErr = $resultErr = "";
        $first_number = $second_number = $result = $sign = "";

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $first_number = $_POST["first_number"];
            $second_number = $_POST["second_number"]; 
            $result = $_POST["result"];
            $sign = $_POST["sign"];
            $validation = true;

            //first number validacija
            if(empty($first_number))
            {
                $first_number = $_POST["first_number"] = 0;
            }
            elseif(!is_numeric($first_number))
            {
                $first_numberErr = "You must enter some number...";
                $validation = false;
            }
            else 
            {
                $first_number = $_POST["first_number"];
            }
            
            //second number validacija
            if(empty($second_number))
            {
                $second_number = $_POST["second_number"] = 0;
            }
            elseif(!is_numeric($second_number))
            {
                $second_numberErr = "You must enter some number...";
                $validation = false;
            }
            else 
            {
                $second_number = $_POST["second_number"];
            }

            //sign validacija 
            if($sign == null)
            {
                $signErr = "You must choose a sign for operation.";
                $validation = false;
            }
            elseif($sign == "/" || $sign == "*" || $sign == "+" || $sign == "-")
            {
                $sign = $_POST["sign"];
            }

            //result validacija 
            
            if(!is_numeric($first_number) && !is_numeric($second_number))
            {
                $result = "";
                $resultErr = "You entered wrong values for first or second number or you didn't enter them...";
                $validation = false;
            }
            elseif($sign == "/" && $first_number == 0 && $second_number == 0)
            {
                $result = "0/ 0 = undefined";
                //$resultErr = "0 / 0 = undefined";
                $validation = false;
            }
            elseif($sign == "*" && $first_number == 0 && $second_number == 0)
            {
                $result = 0;
                $validation = false;
            }
            elseif($sign == "/" && $second_number == 0)
            {
                $result = "";
                $resultErr = "Division by zero is not possible.";
                $validation = false;
            }
            elseif($sign == "*" && ($first_number == 0 || $second_number == 0))
            {
                $result = "";
                $resultErr = "Any number multiplied by zero always equals zero.";
                $validation = false;
            }
            else 
            {
                if($validation)
                {
                    if($sign == "/")
                    {
                        $result = $first_number / $second_number;
                    }
                    if($sign == "*")
                    {
                        $result = $first_number * $second_number;
                    }
                    if($sign == "+")
                    {
                        $result = $first_number + $second_number;
                    }
                    if($sign == "-")
                    {
                        $result = $first_number - $second_number;
                    }
                }
            }

        }
    ?>

    <div class="container">
        <div class="row py-5 d-flex justify-content-center">
            <form action="calculator.php" method="POST" class="text-center">

                <div class="pb-2">
                    <label class="form-label pb-1"> Enter first number here: </label>
                    <input class="form-control text-center font-weight-bold" type="number" name="first_number" step="any" value="<?php echo $first_number; ?>">
                    <p class="text-danger"><small> <?php echo $first_numberErr; ?></small></p>
                </div>

                <div class=" pt-2 pb-2">
                    <div class="form-check-label">
                        <label class="pt-1"> Choose mathematical operation: </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sign" id="inlineRadio1" value="/" checked>/
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sign" id="inlineRadio2" value="*" <?php if($sign == "*") {echo 'checked';} ?>>*
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sign" id="inlineRadio3" value="+" <?php if($sign == "+") {echo 'checked';} ?>>+
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sign" id="inlineRadio3" value="-" <?php if($sign == "-") {echo 'checked';} ?>>-
                    </div>

                    <div>
                        <p class="text-danger"><small> <?php echo $signErr; ?></small></p>
                    </div>
                </div>

                <div class="pt-2 pb-2">
                    <label class="form-label pb-1"> Enter second number here: </label>
                    <input class="form-control text-center font-weight-bold" type="number" name="second_number" step="any" value="<?php echo $second_number; ?>">
                    <p class="text-danger"><small> <?php echo $second_numberErr; ?></small></p>
                </div>

                <div class="pt-2 pb-2">
                    <input name="submit" type="submit" value="Calculate" class="btn text-light font-weight-bold">
                </div>

                <div class="pt-3">
                    <label class="form-label pt-1"> You can see your result here: </label>
                    <input class="form-control text-center font-weight-bold" type="text" name="result" placeholder="Result"  value="<?php echo $result; ?>" readonly>
                    <p class="text-danger"><small> <?php echo $resultErr; ?></small></p>
                </div>
            </form>
        </div>
    </div>


</body>
</html>