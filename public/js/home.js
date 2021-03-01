

class Request {

    querySum(url, idTh , idRow) {
        let rows = new Tables
        fetch(url)
            .then(response => response.json())
            .then(json => {
                if(idTh == null){
                    rows.mountColumnOfTables(json, idRow, 'bg-success')
                }else{
                    rows.mountHeaderOfTable(idTh)
                    rows.mountColumnOfTables(json, idRow, null)
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

            if(percent != null){
                (index == month) ? row += `<th class="text-center ${percent} td"> ${sum.toFixed(2)}%</th>`: row += `<th class="text-center ${percent}  td"> 0.0 %</th>`
            }else{

                (index == month) ? row += `<td class="text-center ${percent} td">R$ ${sum.toFixed(2)}</td>`: row += `<td class="text-center ${percent}  td">R$ 0.00</td>`
            }
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

let tables = new Tables;
let generate = new Request;

generate.querySum('/costs/fixed/sum', 'head-costs-fixed', 'tbody-costs-fixed')
generate.querySum('/costs/variables/sum', 'head-costs-variables', 'tbody-costs-variables')
generate.querySum('/costs/all', 'head-costs-total', 'tbody-costs-total')
generate.querySum('/costs/percent', null , 'tbody-costs-total')
generate.querySum('/salario/sum', 'head-money-total', 'head-money-total')