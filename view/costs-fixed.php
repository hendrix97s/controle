<?php
include_once __DIR__ . "/layout/header.php";
?>

<div id="container-control" class="container-control col-9">
    <div class="row">
        <div class="col-10">
            <h1>CUSTOS FIXOS</h1>
        </div>
        <div class="col-2">
            <button class="btn btn-success" style="float: right;" data-toggle="modal" data-target="#insertFixed"><i class="fas fa-plus"></i> Novo Custo</button>

            <!-- Modal -->
            <div class="modal fade" id="insertFixed" tabindex="-1" role="dialog" aria-labelledby="insertFixed" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Adicionar Custo Fixos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" action="/costs/store">

                                <input type="hidden" name="id_user" value="1">
                                <input type="hidden" name="type" value="fixed">


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
                    TOTAL / MÊS CUSTOS FIXOS
                </th>
            </tr>
        </thead>
        <thead class="thead-dark" id="head-costs-fixed">
        </thead>
        <tbody id="tbody-costs-fixed">
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

<script>
    class Request {
        queryCosts(url, id) {
            fetch(url)
                .then(response => response.json())
                .then(json => {
                    let o = document.getElementById(`${id}`)
                    let rows = ''
                    json.forEach(element => {
                        rows += `
                        <tr>
                            <th scope="row" class="text-center">${element.description}</th>
                            <td class="text-center">${element.value}</td>
                            <td class="text-center">${element.date}</td>
                            <td class="text-center"><span onclick="del(${element.id})"><i class="fas fa-trash-alt"></i></span></td>
                        </tr>
                        `
                    });
                    o.innerHTML = rows
                })
        }

        querySum(url, idTh, idRow) {
            let rows = new Tables
            fetch(url)
                .then(response => response.json())
                .then(json => {
                    if (idTh == null) {
                        rows.mountColumnOfTables(json, idRow, 'bg-success')
                    } else {
                        rows.mountHeaderOfTable(idTh)
                        rows.mountColumnOfTables(json, idRow, '')
                    }
                })
        }
    }


    class Tables {

        mountColumnOfTables = (values, id, percent) => {
            let row = `<tr>`
            for (let index = 1; index <= 12; index++) {
                let sum = 0;
                let month;

                values.forEach(cost => {
                    if (index == cost.month) {
                        sum = parseFloat(cost.sum)
                        month = cost.month
                    }
                });
                (index == month) ? row += `<td class="text-center ${percent} td">R$ ${sum.toFixed(2)}</td>`: row += `<td class="text-center ${percent}  td">R$ 0.0</td>`
            }
            row += `</tr>`

            let nod = document.getElementById(`${id}`)
            let nodTh = document.createElement('tr')

            nodTh.innerHTML = row
            nod.appendChild(nodTh)
            // nod.innerHTML = row

        }

        mountHeaderOfTable = (idTh) => {
            let tr = '<tr>';
            let months = ['', 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
            for (let index = 1; index <= 12; index++) {
                tr += `<th class="text-center">${months[index]}</th>`;
            }
            tr += '</tr>'

            let nod = document.getElementById(`${idTh}`)
            let nodTh = document.createElement('tr')

            nodTh.innerHTML = tr
            nod.appendChild(nodTh)
        }


    }
    var r = new Request
    r.querySum('/costs/fixed/sum', 'head-costs-fixed', 'tbody-costs-fixed')
    r.queryCosts('/costs/fixed', 'costs-variables-rows')

    function del(id) {
        let conf = confirm("Tem certeza de que deseja exlcuir respectivo custo?!")
        if (conf) {
            fetch('/costs/delete?id=' + id).then(del => {
                location.reload();
            })
        }

    }
</script>

<?php
include_once __DIR__ . "/layout/footer.php";
?>