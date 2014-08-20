
    var final_transcript = '';
    var recognizing = false;

    var movement;

    var language = 'en-US';  // change this to your language

    $(document).ready(function() {

        // check that your browser supports the API
        if (!('webkitSpeechRecognition' in window)) {
            alert("Your Browser does not support the Speech API");

        } else {

            // Create the recognition object and define four event handlers (onstart, onerror, onend, onresult)

            var recognition = new webkitSpeechRecognition();
            recognition.continuous = true;         // keep processing input until stopped
            recognition.interimResults = true;     // show interim results
            recognition.lang = language;           // specify the language

            recognition.onstart = function() {
                recognizing = true;
            };

            recognition.onerror = function(event) {
                console.log("There was a recognition error...");
            };

            recognition.onend = function() {
                recognizing = false;
            };

            recognition.onresult = function(event) {
                var interim_transcript = '';

                // Assemble the transcript from the array of results
                for (var i = event.resultIndex; i < event.results.length; ++i) {
                    if (event.results[i].isFinal) {
                        final_transcript += event.results[i][0].transcript + '<br>';
                    } else {
                        interim_transcript += event.results[i][0].transcript;
                    }
                }

                // update the web page
                //if(final_transcript.length > 0) {
                console.log(interim_transcript);
                var check = String(interim_transcript);
                if(check.indexOf("jump") > -1) {
                    //$('#transcript').html(final_transcript);
                    console.log("jumping");
                    player_jump();
                }
                if(check.indexOf("back") > -1 || check.indexOf("left") > -1) {
                    movement="back";
                }
                if(check.indexOf("forward") > -1 || check.indexOf("right") > -1) {
                    movement="forward";
                }
                if(check.indexOf("stop") > -1) {
                    movement="stop";
                }
            };


            function start_speech() {

                if (recognizing) {
                    recognition.stop();
                    recognizing = false;
                } else {
                    final_transcript = '';

                    // Request access to the User's microphone and Start recognizing voice input
                    recognition.start();
                }
            }
       
            //start recognition on page load 
            recognition.start();
        }

    });


function load_speech_btn(){
    // create our virtual game controller buttons 
    buttonspeech = game.add.button(60, 50, 'btnSpeech', null, this, 0, 1, 0, 1);  //game, x, y, key, callback, callbackContext, overFrame, outFrame, downFrame, upFrame
    buttonspeech.fixedToCamera = true;  //our buttons should stay on the same place  
    buttonspeech.events.onInputOver.add(function(){start_speech()});
//    buttonjump.events.onInputOut.add(function(){jump=false;});
    buttonspeech.events.onInputDown.add(function(){start_speech()});
//    buttonjump.events.onInputUp.add(function(){jump=false;});

}


