/**
    * 
    * @author Luiz Lima <luiz.lima@wapstore.com.br>
    * classe Request responsavel pelas requisições e por montar as linhas e colunas das 
    * tabelas no front
    */
class Request {
    /**
     * Methodo responsavel por montar a tabela de acordo com a requisição solicitada
     * @param url recebe a url de requisição
     * @param id recebe o id do nó html para incorporar os elementos gerados
     */
    queryCosts(url, id) {
        fetch(url)
            .then(response => response.json())
            .then(json => {
                let o = document.getElementById(`${id}`)
                let rows = ''
                json.forEach(element => {
                    rows += `
                        <tr>
                            <th scope="row" class="text-center">${element.origem}</th>
                            <td class="text-center">R$ ${element.value}</td>
                            <td class="text-center">${element.date}</td>
                            <th scope="row" class="text-center">${element.description}</th>
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
            (index == month) ? row += `<td class="text-center ${percent} td">R$ ${sum.toFixed(2)}</td>` : row += `<td class="text-center ${percent}  td">R$ 0.0</td>`
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
r.querySum('/salario/sum', 'head-money-total', 'tbody-money-total')
r.queryCosts('/money', 'money-rows')


function del(id) {
    let conf = confirm("Tem certeza de que deseja exlcuir respectivo custo?!")
    if (conf) {
        fetch('/money/delete?id=' + id).then(del => {

            location.reload();
        })
    }
}