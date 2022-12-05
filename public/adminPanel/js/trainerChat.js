//webkitURL is deprecated but nevertheless
URL = window.URL || window.webkitURL;
var gumStream;
//stream from getUserMedia()
var rec;
//Recorder.js object
var input;
audioContext
//MediaStreamAudioSourceNode we'll be recording
// shim for AudioContext when it's not avb.
var AudioContext = window.AudioContext || window.webkitAudioContext;
var RecordButton = document.getElementById('RecordButton');
var StopButton = document.getElementById('StopButton');
var PauseButton = document.getElementById('PauseButton');
var DownloadButton = document.getElementById('DownloadButton');
var Recording = document.getElementById('Record');
//add events to those 3 buttons
RecordButton.addEventListener('click', StartRecording);
StopButton.addEventListener('click', StopRecording);
PauseButton.addEventListener('click', PauseRecording);
/* Simple constraints object, for more advanced audio features see

https://addpipe.com/blog/audio-constraints-getusermedia/ */
function StartRecording() {
  var constraints = {
    audio: true,
    video: false,
  };
  /* Disable the record button until we get a success or fail from getUserMedia() */

  RecordButton.disabled = true;
  StopButton.disabled = false;
  PauseButton.disabled = false;

  /* We're using the standard promise based getUserMedia()

  https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia */

  navigator.mediaDevices
        .getUserMedia(constraints)
        .then(function (stream) {
          console.log('getUserMedia() success, stream created, initializing Recorder.js ...');
          /* assign to gumStream for later use */
          gumStream = stream;
          /* use the stream */
          audioContext = new AudioContext();
          input = audioContext.createMediaStreamSource(stream);
          /* Create the Recorder object and configure to record mono sound (1 channel) Recording 2 channels will double the file size */
          rec = new Recorder(input, {
            numChannels: 1,
          });
          //start the recording process
          rec.record();
          Recording.innerHTML = 'Recording started';
          console.log('Recording started');
        })
        .catch(function (err) {
          //enable the record button if getUserMedia() fails
          RecordButton.disabled = false;
          StopButton.disabled = true;
          PauseButton.disabled = true;
        });
}
function PauseRecording() {
  if (rec.recording) {
    rec.stop();
    pauseButton.innerHTML = 'Resume';
    recording.innerHTML='recording resumed'
  } else {
    rec.record();
    pauseButton.innerHTML = 'Pause';
    recording.innerHTML = 'Recording started';

  }
}

function StopRecording() {
  console.log('stopButton clicked');
  //disable the stop button, enable the record too allow for new recordings
  StopButton.disabled = true;
  RecordButton.disabled = false;
  PauseButton.disabled = true;
  //reset button just in case the recording is stopped while paused
  PauseButton.innerHTML = 'Pause';
  Recording.innerHTML = 'Recording stopped';

  //tell the recorder to stop the recording
  rec.stop(); //stop microphone access
  gumStream.getAudioTracks()[0].stop();
  //create the wav blob and pass it on to createDownloadLink
  rec.exportWAV(CreateDownloadLink);
}
// var audioChunks;
function CreateDownloadLink(blob) {
  var url = URL.createObjectURL(blob);
  var au = document.createElement('audio');
  var li = document.createElement('li');
  var link = document.createElement('a');

  //name of .wav file to use during upload and download (without extendion)
  var filename = new Date().toISOString();

  //add controls to the <audio> element
  au.controls = true;
  au.src = url;

  //save to disk link
  link.href = url;
  link.download = filename + '.wav'; //download forces the browser to donwload the file using the  filename
  //add the new audio element to li
  li.appendChild(au);
  //add the filename to the li
  li.appendChild(document.createTextNode(filename + '.wav '));
  //add the save to disk link to li
  li.appendChild(link);

  //upload link
  DownloadButton.disabled = false;
  li.appendChild(document.createTextNode(' ')); //add a space in between
  // li.appendChild(appendChilddownloadButton)//add the upload link to li
  if (DownloadButton) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
    });
    DownloadButton.addEventListener(
          'click',
          function (e) {
            var receiver = $('input[name=receiver_id]').val();
            var sender = $('input[name=sender_id]').val();
            var message = new File([blob], filename + '.wav');
            var formData = new FormData();
            formData.append('message', message);
            formData.append('receiver', receiver);
            formData.append('sender', sender);
            console.log(receiver,sender,message);
            $.ajax({
              type: 'POST',
              url: '/trainer/audio_message',
              data: formData,
              processData: false,
              contentType: false,
              success: function (data) {
                location.reload();
              },
            });
          },
          false
    );
  }

  //add the li element to the ol
  recordingsList.appendChild(li);
}
