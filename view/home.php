<?php
include_once __DIR__ . "/layout/header.php";


?>

<div id="container-control" class="container-control col-9">
    <h1>
        DASHBOARD
    </h1>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th colspan="13" class="text-center">
                    TOTAL / MÊS CUSTOS FIXOS
                </th>
            </tr>
        </thead>
        <thead class="thead-dark" id="head-costs-fixed">
        </thead>
        <tbody id="tbody-costs-fixed">
        </tbody>
    </table>


    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th colspan="13" class="text-center">
                    TOTAL / MÊS CUSTOS VARIAVEIS
                </th>
            </tr>
        </thead>

        <thead class="thead-dark" id="head-costs-variables">
        </thead>
        <tbody id="tbody-costs-variables">
        </tbody>
    </table>


    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th colspan="13" class="text-center">
                    SOMA DE CUSTOS FIXOS E VARIAVEIS / MÊS - PERCENTUAL SOBRE SALARIO
                </th>
            </tr>
        </thead>

        <thead class="thead-dark" id="head-costs-total">
        </thead>

        <tbody id="tbody-costs-total">
        </tbody>
    </table>



    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th colspan="13" class="text-center">
                    SALARIOS MÊS
                </th>
            </tr>
        </thead>

        <thead class="thead-dark" id="head-money-total">
        </thead>
        <tbody id="tbody-money-total">

        </tbody>

    </table>
    
    <script src="js/home.js"></script>
</div>


<?php
include_once __DIR__ . "/layout/footer.php";
?>