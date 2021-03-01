<?php
/**
 * arquivo responsavel por analizar as rotas e 
 * retornar o seu respectivo arquivo
 */

 if (isset($_SERVER['REDIRECT_URL'])) {

    switch (($_SERVER['REDIRECT_URL'])) {
        case '/home':
            include_once "../view/home.php";
            break;
        case '/login':
            include_once "../view/login/index.php";
            break;
        case '/register':
            include_once "../view/register/index.php";
            break;
        case '/fixos':
            include_once "../view/costs-fixed.php";
            break;
        case '/variaveis':
            include_once "../view/costs-variables.php";
            break;

        case '/salario':
            include_once "../view/money.php";
            break;

        case '/money':
            include_once "../routes/web.php";
            break;

        case '/money/store':
            include_once "../routes/web.php";
            break;
        case '/money/delete':
            include_once "../routes/web.php";
            break;
        case '/salario/sum':
            include_once "../routes/web.php";
            break;

        case '/edit/profile':
            include_once "../routes/web.php";
            break;
        case '/costs/store':
            include_once "../routes/web.php";
            break;
        case '/costs/delete':
            include_once "../routes/web.php";
            break;
        case '/costs/all':
            include_once "../routes/web.php";
            break;
        case '/costs/percent':
            include_once "../routes/web.php";
            break;
        case '/costs/fixed':
            include_once "../routes/web.php";
            break;
        case '/costs/fixed/sum':
            include_once "../routes/web.php";
            break;
        case '/costs/variables':
            include_once "../routes/web.php";
            break;
        case '/costs/variables/sum':
            include_once "../routes/web.php";
            break;
        // default:
        //     echo "error: 404 - not found";
        //     break;
    }
} else {
}
