<div id="left">
    <div class="streak">
        <div class="streakimg">
            <img src="{{ asset('img/fire.svg') }}" alt="">
            <span>123</span>
        </div>
        <div class="streaktoday" >
            
        </div>
    </div>
    <div class="board-img flex">
        <img id="imgcarrocel" src="{{ asset('img/cat1.svg') }}" alt="">
    </div>
    <div class="board-timer flex">
        <div class="borderbox"><span class="countdown minutes">23</span></div>
        <div class="borderbox"><span class="countdown seconds">23</span></div>
    </div>
    <div class="board-buttons">
        <button id="start" class="controlplay" >START</button>
        <button id="stop" class="controlplay" >STOP</button>
        <button id="btngear">
            <img src="{{ asset('img/gear.svg') }}" alt="">
        </button>
    </div>
    <div class="gear-modal">
        <div class="gear-board">
            <div class="gear-close">
                <img src="{{ asset('img/xmark.svg') }}" alt="">
            </div>
        </div>
        <div class="gear-board">
            <label for="pomodoro">
                Pomodoro
                <input id="pomodoro" name="short" type="text">
            </label>
            <label for="shortbreak">
                Short Break
                <input id="shortbreak" name="long" type="text">
            </label>
            <label for="longbreak">
                Long Break
                <input id="longbreak" name="break" type="text">
            </label>
        </div>
        <div class="gear-board">
            <button id="reset">
                Reset
            </button>
            <button id="aplicar">
                Aplicar
            </button>
        </div>
    </div>
</div>

@push('timerscripts')
<script>
    
    let configTimer = localStorage.getItem('configTimer')
    let auxTimers = localStorage.getItem('auxTimers')
    let timers = localStorage.getItem('timers')

    let pomodoro = configTimer ? JSON.parse(configTimer).pomodoro : 50;
    let short = configTimer ? JSON.parse(configTimer).short : 5 ;
    let long = configTimer ? JSON.parse(configTimer).long : 10;
    let dateBased = DateTime.now();
    


    let dateToday = DateTime.fromObject({
        year: dateBased.year,
        month: dateBased.month,
        day: dateBased.day,
        hour: timers ? timers.hour : 0,
        minute: timers ? timers.minute : 0
    })
    
    let interval;
    let hours = 0;
    let minutes = pomodoro;
    let seconds  = 0;
    let milliseconds = 0;
    let isPaused = true;
    let isStarted = false;

    initConfig();

    $('#btngear').on('click', function() {
        document.querySelector('.gear-modal').classList.add('active')
    })
    $('.gear-close').on('click', function() {
        document.querySelector('.gear-modal').classList.remove('active')
    })

    $('#reset').on('click', resetTimer)

    $('#aplicar').on('click', applyTimer)


    $('#start').on('click',function (){
        console.log(isPaused);
        if(isPaused) startTimer();
    })
    $('#stop').on('click',stopTimer)


    // function startTimer(){
        
    //     isPaused = false;

    //     if (interval) {
    //         clearInterval(interval); // Clear any existing interval
    //     }

    //     const dateNow = DateTime.now();

    //     interval = setInterval( () => {

            


    //         if(!isPaused){
                
                
    //             milliseconds += 10;
                
    //             if (milliseconds === 1000){
    //                 seconds--;
    //                 milliseconds = 0;  
    //                 saveTimerToday();
    //                 changeImage()
                                        
    //             }
                

    //             if (minutes == 0 && seconds == 0){
    //                 clearInterval(interval);
    //                 resetTimer();
    //                 appendQuads();
    //             }

    //             if (!isPaused && seconds == 0){
                

    //                 minutes = minutes == 0 ? 0 : minutes - 1;
    //                 seconds =  59;
    //                 saveTimerToday();
    //             }



    //             $('.minutes').text(minutes < 10 ? `0${minutes}` : minutes);
    //             $('.seconds').text(seconds < 10 ? `0${seconds}` : seconds);

                

                

                

                
    //         }
            
    //     }, 10) 
    // }

    function startTimer() {
    isPaused = false;
    isStarted = false;
    
    
    
    if (interval) {
        clearInterval(interval); // Limpa qualquer intervalo existente
    }

    const startTime = DateTime.now(); // Hora de início atual
    const endTime = startTime.plus({ minutes: pomodoro }); // Hora de término com base no tempo do Pomodoro

    
    interval = setInterval(() => {
        if (!isPaused) {
            const currentTime = DateTime.now(); // Hora atual
            const diff = endTime.diff(currentTime, ['minutes', 'seconds', 'milliseconds']); // Calcula a diferença de tempo

            if (diff.toMillis() <= 0) { // Quando o tempo restante acabar
                clearInterval(interval);
                isStarted = false;
                resetTimer();
                appendQuads();
                return;
            }

            if(diff.seconds != seconds){
                saveTimerToday();
                changeImage();
            }

            minutes = diff.minutes; // Atualiza os minutos restantes
            seconds = diff.seconds; // Atualiza os segundos restantes
            milliseconds = diff.milliseconds; // Atualiza os milissegundos restantes

            
            

            // Atualiza o display com os valores corretos
            $('.minutes').text(minutes < 10 ? `0${minutes}` : minutes);
            $('.seconds').text(seconds < 10 ? `0${seconds}` : seconds);

            $('title').text(`${minutes}:${seconds}`)
        }
    }, 10);
}


    function resetTimer(){
        if (interval) {
            clearInterval(interval); // Clear any existing interval
        }
        isPaused = true;
        hours = 0;
        minutes = pomodoro
        seconds = 0;
        milliseconds = 0;

        
        $('title').text("pomodor")
        $('.seconds').text('00')
        $('.minutes').text(pomodoro)
    }

    function applyTimer(){
        if (interval) {
            clearInterval(interval); // Clear any existing interval
        }

        const timer = {
            // "hour": hours,
            // "minutes": minutes,
            // "seconds" : seconds,
            "pomodoro" : $('#pomodoro').val(),
            "long": $('#longbreak').val(),
            "short" : $('#shortbreak').val(),
        }

        localStorage.setItem('configTimer', JSON.stringify(timer))
        hours = 0;
        minutes = timer.pomodoro;
        seconds = 0;
        milliseconds = 0;
        short = timer.short;
        logn = timer.long
        
        
        

        $('.seconds').text('00')
        $('.minutes').text(minutes)
    }



    function stopTimer(){
        isPaused = true;
        isStarted = true;
    }




    const appendQuads = () => {
        const el = document.createElement('div')
        el.setAttribute('class', 'quads')

        document.querySelector('.streaktoday').appendChild(el)
    }




    function initConfig () {
        $('#pomodoro').attr('placeholder', pomodoro)
        $('#pomodoro').val(pomodoro)
        $('#shortbreak').attr('placeholder',short)
        $('#shortbreak').val(short)
        $('#longbreak').attr('placeholder', long)
        $('#longbreak').val(long)
        $('.minutes').text(pomodoro)
        $('.seconds').text('00')
    }
    
    function changeImage(){
        let data = localStorage.getItem('referTimer')
        let checkpoint = ["1:30:0", "2:30:0", "3:30:0", "4:00:0"]
        let pickimage = {
            0: "{{ asset('img/cat2.svg')}}",
            1: "{{ asset('img/cat3.svg')}}",
            2: "{{ asset('img/cat4.svg')}}",
            3: "{{ asset('img/cat5.svg')}}",
        }

        if (checkpoint.includes(data)){
                        
            $('#imgcarrocel').attr('src', pickimage[checkpoint.indexOf(data)])
        }
        
    }


    function saveTimerToday(){
        
        const timer = localStorage.getItem('referTimer') ? localStorage.getItem('referTimer').split(':') : 0; 
        dateToday = DateTime.fromObject({
            year: dateBased.year,
            month: dateBased.month,
            day: dateBased.day,
            hour: timer ? timer[0] : 0,
            minute: timer ? timer[1] : 0,
            second: timer ? timer[2] : 0
        })

        dateToday = dateToday.plus({seconds: 1})
        
        localStorage.setItem('timers', JSON.stringify({
            "minute": dateToday.minute, "hour": dateToday.hour
        }))

        dateToday.toJSON = function (){
            return `${this.hour}:${this.minute}:${this.second}`
        }
     
        localStorage.setItem('referTimer', dateToday.toJSON())
    }
</script>
@endpush

