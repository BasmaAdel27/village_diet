//webkitURL is deprecated but nevertheless
URL = window.URL || window.webkitURL;
var gumStream;
//stream from getUserMedia()
var rec;
//Recorder.js object
var input;
var audioContext;
//MediaStreamAudioSourceNode we'll be recording
// shim for AudioContext when it's not avb.
var AudioContext = window.AudioContext || window.webkitAudioContext;
//new audio context to help us record
var recordButton = document.getElementById('recordButton');
var stopButton = document.getElementById('stopButton');
var pauseButton = document.getElementById('pauseButton');
var downloadButton = document.getElementById('downloadButton');
var recording = document.getElementById('record');
//add events to those 3 buttons
recordButton.addEventListener('click', startRecording);
stopButton.addEventListener('click', stopRecording);
pauseButton.addEventListener('click', pauseRecording);

function startRecording() {
  var constraints = {audio: true, video: false,};

  recordButton.disabled = true;
  stopButton.disabled = false;
  pauseButton.disabled = false;

  navigator.mediaDevices
        .getUserMedia(constraints)
        .then(function (stream) {
          console.log('getUserMedia() success, stream created, initializing Recorder.js ...');
          audioContext = new AudioContext();
          gumStream = stream;
          input = audioContext.createMediaStreamSource(stream);
          rec = new Recorder(input, {numChannels: 1});
          rec.record();
          recording.innerHTML = 'Recording started';
          console.log('Recording started');
        })
        .catch(function (err) {
          recordButton.disabled = false;
          stopButton.disabled = true;
          pauseButton.disabled = true;
        });
}
function pauseRecording() {
  console.log('pauseButton clicked rec.recording=', rec.recording);
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

function stopRecording() {
  console.log('stopButton clicked');
  //disable the stop button, enable the record too allow for new recordings
  stopButton.disabled = true;
  recordButton.disabled = false;
  pauseButton.disabled = true;
  //reset button just in case the recording is stopped while paused
  pauseButton.innerHTML = 'Pause';
  recording.innerHTML = 'Recording stopped';

  //tell the recorder to stop the recording
  rec.stop(); //stop microphone access
  gumStream.getAudioTracks()[0].stop();
  //create the wav blob and pass it on to createDownloadLink
  rec.exportWAV(createDownloadLink);
}

function createDownloadLink(blob) {
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

  li.appendChild(link);
  li.appendChild(document.createTextNode(' ')); //add a space in between
  downloadButton.disabled = false;

  if (downloadButton) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
      });
      downloadButton.addEventListener(
            'click',
            function (e) {
              var receiver = $('input[name=receiver_id]').val();
              var sender = $('input[name=sender_id]').val();
              var message = new File([blob], filename + '.wav');
              var formData = new FormData();
              formData.append('message', message);
              formData.append('receiver', receiver);
              formData.append('sender', sender);
              $.ajax({
                type: 'POST',
                url: '/admin/audio_save',
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
