<?php
include_once __DIR__ . "/layout/header.php";

?>

<div id="container-control" class="container-control col-9">
<div class="row">
        <div class="col-10">
            <h1>SALÁRIO</h1>
        </div>
        <div class="col-2">
            <button class="btn btn-success" style="float: right;" data-toggle="modal" data-target="#insertSalario"><i class="fas fa-plus"></i> Novo Salário</button>

            <!-- Modal -->
            <div class="modal fade" id="insertSalario" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Adicionar Novo Salário</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" action="/money/store">

                                <input type="hidden" name="id_user" value="1">

                                <div class="form-group">
                                    <label for="date">Origem</label>
                                    <input type="text" name="origem" class="form-control" id="origem" placeholder="Origem" value="">
                                </div>


                                <div class="form-group">
                                    <label for="date">Data</label>
                                    <input type="date" name="date" class="form-control" id="date" placeholder="Data" value="">
                                </div>

                                <div class="form-group">
                                    <label for="value">Valor R$</label>
                                    <input type="text" name="value" class="form-control" id="value" placeholder="Valor R$" value="">
                                </div>

                                <div class="form-group">
                                    <label for="description">Descrição</label>
                                    <input type="text" name="description" class="form-control" id="description" placeholder="Description" value="">
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>


                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>



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


    <table class="table">
        <thead class="thead-dark" id="th">
            <th class="text-center">ORIGEM</th>
            <th class="text-center">VALOR</th>
            <th class="text-center">DATA</th>
            <th class="text-center">DESCRIÇÃO</th>
            <th class="text-center"></th>
        </thead>
        <tbody id="money-rows">

        </tbody>
    </table>
</div>

<script src="js/money.js"></script>

<?php
include_once __DIR__ . "/layout/footer.php";
?>