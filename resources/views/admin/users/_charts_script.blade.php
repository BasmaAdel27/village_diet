@section('scripts')
<script>
  // weight
var xValues = @json($cahrts['days']);
var yValues = @json($cahrts['weights'])

new Chart("weightChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 50, max:450}}],
    }
  }
});

// daily cups of water
var dailyCup_xValues = @json($cahrts['days']);
var daulyCup_yValues = @json($cahrts['daily_cup_count'])

new Chart("dailyCupChart", {
  type: "line",
  data: {
    labels: dailyCup_xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: daulyCup_yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 1, max:100}}],
    }
  }
});

// walk duration
var walkDuration_xValues = @json($cahrts['days']);
var walkDuration_yValues = @json($cahrts['walk_duration'])

new Chart("walkDurationChart", {
  type: "line",
  data: {
    labels: walkDuration_xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: walkDuration_yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 1, max:24}}],
    }
  }
});

// sleep hours
var sleepHours_xValues = @json($cahrts['days']);
var sleepHours_yValues = @json($cahrts['sleepHours'])

new Chart("sleepHoursChart", {
  type: "line",
  data: {
    labels: sleepHours_xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: sleepHours_yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 1, max:24}}],
    }
  }
});

</script>
@endsection
