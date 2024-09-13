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
        <img src="{{ asset('img/cat1.svg') }}" alt="">
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
            <label for="short">
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
    const gear = document.querySelector('#btngear');
    const gearModal = document.querySelector('.gear-modal');
    const gear_close = document.querySelector('.gear-close');

    
    let timers = localStorage.getItem('timers')
    
    let pomodoro = timers ? JSON.parse(timers).pomodoro : 50;
    let short = timers ? JSON.parse(timers).short : 5 ;
    let long = timers ? JSON.parse(timers).long : 10;

    let interval;
    let hours = 0;
    let minutes = pomodoro;
    let seconds  = 0;
    let milliseconds = 0;
    let isPaused = false;

    initConfig();


    gear.addEventListener('click', (e) => {
        gearModal.classList.add('active')
    })

    gear_close.addEventListener('click', (e) => {
        gearModal.classList.remove('active')
    })


    $('#reset').on('click', resetTimer)

    $('#aplicar').on('click', applyTimer)


    $('#start').on('click',startTimer)
    $('#stop').on('click',stopTimer)

    function startTimer(){
        isPaused = false;
        if (interval) {
            clearInterval(interval); // Clear any existing interval
        }

        interval = setInterval( () => {
        
            if(!isPaused){
               
                milliseconds += 10;
                
                if (milliseconds === 1000){
                    seconds--;
                    milliseconds = 0;
                }

                if (seconds === 0){
                    minutes--;
                    seconds = 59;
                }

                

                $('.hours').text(hours < 10 ? `0${hours}` : hours);
                $('.minutes').text(minutes < 10 ? `0${minutes}` : minutes);
                $('.seconds').text(seconds < 10 ? `0${seconds}` : seconds);

                if (minutes == 0 && seconds == 0){
                    clearInterval(interval);
                    resetTimer();
                    appendQuads();
                }
            }
            
        }, 10) 
    }

    function resetTimer(){
        if (interval) {
            clearInterval(interval); // Clear any existing interval
        }
        hours = 0;
        minutes = $('#pomodoro').val();
        seconds = 0;
        milliseconds = 0;

        $('.seconds').text('00')
        $('.minutes').text(minutes)
    }

    function applyTimer(){
        if (interval) {
            clearInterval(interval); // Clear any existing interval
        }

        const timer = {
            // "hour": hours,
            // "minutes": minutes,
            // "seconds" : seconds,
            // "milliseconds" : milliseconds,
            "pomodoro" : $('#pomodoro').val(),
            "long": $('#longbreak').val(),
            "short" : $('#shortbreak').val(),
        }

        localStorage.setItem('timers', JSON.stringify(timer))
        hours = 0;
        minutes = $('#pomodoro').val();
        seconds = 0;
        milliseconds = 0;
        short = $('#shortbreak').val();
        logn = $('#longbreak').val()
        
        
        

        $('.seconds').text('00')
        $('.minutes').text(minutes)
    }



    function stopTimer(){
        isPaused = true;
        
    }


    
    // $('#pomodoro').change( (e) => {
        
    //     pomodoro = $(e.target).val();
    //     console.log(pomodoro)
    // })
    // $('#shortbreak').change( (e) => {
    //     short = $(e.target).val();
    // })
    // $('#longbreak').change( (e) => {
    //     long = $(e.target).val();
    // })


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
    

    




</script>
@endpush

