<?php
include_once __DIR__ . "/layout/header.php";
?>

<div id="container-control" class="container-control col-9">
    <div class="row">
        <div class="col-10">
            <h1>CUSTOS VARIAVEIS</h1>
        </div>
        <div class="col-2">
            <button class="btn btn-success" style="float: right;" data-toggle="modal" data-target="#insertVariables"><i class="fas fa-plus"></i> Novo Custo</button>

            <!-- Modal -->
            <div class="modal fade" id="insertVariables" tabindex="-1" role="dialog" aria-labelledby="editProfile" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Adicionar Custo Variavel</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" action="/costs/store">

                                <input type="hidden" name="id_user" value="1">
                                <input type="hidden" name="type" value="variables">


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
                    TOTAL / MÊS CUSTOS VARIAVEIS
                </th>
            </tr>
        </thead>

        <thead class="thead-dark" id="head-costs-variables">
        </thead>
        <tbody id="tbody-costs-variables">
        </tbody>
    </table>

    <table class="table">
        <thead class="thead-dark" id="th">
            <th class="text-center">DESCRIÇÃO</th>
            <th class="text-center">VALOR</th>
            <th class="text-center">DATA</th>
            <th class="text-center"></th>
        </thead>
        <tbody id="costs-variables-rows">

        </tbody>
    </table>

</div>
<script src="js/variables.js"></script>

<?php
include_once __DIR__ . "/layout/footer.php";
?>