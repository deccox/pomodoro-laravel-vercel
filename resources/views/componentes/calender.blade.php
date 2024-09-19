<div id="rigth">
    <div id="calender">
        <div class="calendertitle">
            Setembro 09
        </div>
        <div class="calendertable">

        </div>
    </div>
    <div class="any">

    </div>
</div>


@push('calenderscripts')

<script>
    
    $(document).ready(function() {
        const setClassPerHour = (item) => {
            item = item.split(':');
            if (Number(item[0]) <= 1) return 'beginner'
            if (Number(item[0]) >= 2 && Number(item[0]) < 3) return 'intermediare'
            if (Number(item[0]) >= 3 && Number(item[0]) < 4) return 'interplus'
            if (Number(item[0]) > 4) return 'advance'
        }

        let timerRegister = JSON.parse(@json($data));

        console.log(timerRegister);
        let week = ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab', 'Dom'];
        let table = $('<table></table>').addClass('table_calender');
        let tbody = $('<tbody></tbody>')
        let thread = $('<thead></thead>');
        let headerrow = $('<tr></tr>');
        let bodyrow = $('<tr></tr>')

        week.forEach(item => {
            headerrow.append($('<th></th>').text(item));
        })


        for(let i = 0; i< 35; i++){
            
            if ( i % 7 == 0 && i !== 0){
                tbody.append(bodyrow)
                bodyrow = $('<tr></tr>')
            }
            bodyrow.append($('<td></td>')
            .attr('data-data', i)
            .append($('<span>'+i+'</span>'))
            .append($('<span>'+timerRegister[i].timer_quantity+'</span>')
                .attr('class',setClassPerHour(timerRegister[i].timer_quantity))
                
            
            ))

        }


        thread.append(headerrow);
        tbody.append(bodyrow)
        table.append(thread);
        table.append(tbody);

        $('.calendertable').append(table); // Correção do seletor




        

    });


</script>

@endpush