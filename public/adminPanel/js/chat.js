
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
var cancelButton = document.getElementById('cancel');

//add events to those 3 buttons
recordButton.addEventListener('click', startRecording);
stopButton.addEventListener('click', stopRecording);
pauseButton.addEventListener('click', pauseRecording);
cancelButton.addEventListener('click', cancel);

/* Simple constraints object, for more advanced audio features see

https://addpipe.com/blog/audio-constraints-getusermedia/ */
function startRecording() {
  var constraints = {
    audio: true,
    video: false,
  };
  /* Disable the record button until we get a success or fail from getUserMedia() */

  recordButton.disabled = true;
  stopButton.disabled = false;
  pauseButton.disabled = false;

  /* We're using the standard promise based getUserMedia()

  https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia */

  navigator.mediaDevices
        .getUserMedia(constraints)
        .then(function (stream) {
          console.log('getUserMedia() success, stream created, initializing Recorder.js ...');
          /* assign to gumStream for later use */
          audioContext = new AudioContext();
          gumStream = stream;
          /* use the stream */
          input = audioContext.createMediaStreamSource(stream);
          /* Create the Recorder object and configure to record mono sound (1 channel) Recording 2 channels will double the file size */
          rec = new Recorder(input, {
            numChannels: 1,
          });
          //start the recording process
          rec.record();
          recording.innerHTML = 'Recording started';
          console.log('Recording started');
        })
        .catch(function (err) {
          //enable the record button if getUserMedia() fails
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

function cancel(){
  location.reload();

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
  //add the save to disk link to li
  li.appendChild(link);

  //upload link
  downloadButton.disabled = false;
  li.appendChild(document.createTextNode(' ')); //add a space in between
  // li.appendChild(appendChilddownloadButton)//add the upload link to li
  if (downloadButton) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
    });
    downloadButton.addEventListener(
          'click',
          function (e) {
            console.log('yes')
            var society= $('input[name=society_id]').val();
            var sender = $('input[name=sender_id]').val();
            var message = new File([blob], filename + '.wav');
            var formData = new FormData();
            formData.append('message', message);
            formData.append('society', society);
            formData.append('sender', sender);
            $.ajax({
              type: 'POST',
              url: '/admin/societies/save',
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






