<?
    session_start();
    header("Content-Type: text/html; charset=UTF-8");

    $mode = isset($_REQUEST["mode"]) ? $_REQUEST["mode"] : "";
    $password = "password";
    $input_password = isset($_POST["input_password"]) ? $_POST["input_password"] : "";
    $page = basename($_SERVER["PHP_SELF"]);
    $accessFlag = isset($_SESSION["accessFlag"]) ? $_SESSION["accessFlag"] : "";

    if($accessFlag == "Y"){
        if ($mode == "logout"){
            unset($_SESSION["accessFlag"]);
            session_destroy();
            echo "<script>location.href='{$page}'</script>";
            exit();
        }
    } else{
        if ($mode == "login" && $input_password == $password){
            $_SESSION["accessFlag"] = "Y";
            echo "<script>location.href='{$page}'</script>";
            $input_password = "";
            exit();
        }
    }


?>
<!DOCTYPE html>
<html lang="ko">
    <head>
        <title>LEARNING_PHP</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <? if ($accessFlag != "Y") {?>
                    <form action="<?=$page?>?mode=login" method="POST" style="margin-top:24px">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Password</span>
                            <input type="password" class="form-control" placeholder="Password Input..." name="input_password"> 
                            <button class="btn btn-outline-secondary" type="submit" for="inputGroupFile02">Auth</button>
                        </div>
                    </form>
                    <? if (!empty($input_password)) {?>
                        <div style="text-align:center">
                            <p class="text-dark" style="display:inline-block;margin-top:10px;--bs-text-opacity: .4">Login failed...</p>  
                        </div>
                    <? } ?>
                <? } else { ?>
                    <div style="margin-top: 20px; margin-top: 24px">
                        <div style="display:inline-block">
                            <h2>Welcome</h2>
                        </div>
                        <div style="display:inline-block; height:10px">
                        </div>
                        <div style="display:inline-block">
                            <small>but this site has NO data. just Enjoy!</small>
                        </div>
                        <div style="display:inline-block; margin-left: 10px; font-size: 18px;">
                            <a class="nav-link" href="<?=$page?>?mode=logout">Logout</a>
                        </div>
                    </div>
                <? } ?>
            <div>
            <div class="col-md-3"></div>
        </div>    
    </body>
</html>