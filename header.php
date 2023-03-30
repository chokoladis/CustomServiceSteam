<?php 
require_once('modules/steam/main.php');
require_once('modules/site/main.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/lib/bootstrap5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style/style.css">
    <?=$site->setTitle();?>
</head>
<body>

    <header>
        <div class="container">
            <nav>
                <div class="btn-group">
                    <div class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" 
                            id="dropdown_games" data-bs-toggle="dropdown" aria-expanded="false">
                            games
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdown_games">
                            <li><a class="dropdown-item" href="/?method=getAppList&limit=0">all apps</a></li>
                            <li><a class="dropdown-item" href="/?method=getAppList&limit=50">app list (50)</a></li>  
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" 
                            id="dropdown_users" data-bs-toggle="dropdown" aria-expanded="false">
                            users
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdown_users">
                            <li><a class="dropdown-item" href="/?method=getAppList&limit=0">all apps</a></li>
                            <li><a class="dropdown-item" href="/?method=getAppList&limit=50">app list (50)</a></li>  
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" 
                            id="dropdown_profile" data-bs-toggle="dropdown" aria-expanded="false">
                            profile
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdown_profile">
                            <li><a class="dropdown-item" href="/?method=getAppList&limit=0">all apps</a></li>
                            <li><a class="dropdown-item" href="/?method=getAppList&limit=50">app list (50)</a></li>  
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>