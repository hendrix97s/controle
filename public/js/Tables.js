
export class Tables {

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