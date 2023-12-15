<?php
# Home
if($_GET['page'] == 'home'){
    require_once 'controller/home.php';

# Games
}elseif ($_GET['page'] == 'addGame'){
    require_once 'controller/gameAdd.php';
}elseif ($_GET['page'] == 'games'){
    require_once 'controller/gameList.php';

# Login
}elseif ($_GET['page'] == 'login'){
    require_once 'controller/login.php';

# Register
}elseif ($_GET['page'] == 'register'){
    require_once 'controller/register.php';

# User
}elseif ($_GET['page'] == 'user'){
    require_once 'controller/userProfile.php';
}elseif ($_GET['page'] == 'editUser'){
    require_once 'controller/userProfileEdit.php';
# Ranking
}elseif ($_GET['page'] == 'ranking'){
    require_once 'controller/ranking.php';

}else {
    require_once 'controller/home.php';
}