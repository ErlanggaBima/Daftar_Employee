@php
    $currentRouteName = Route::currentRouteName();
@endphp
<div class="container mt-4">
    <h4>{{ $currentRouteName }}</h4>
    <hr>
    <div class="d-flex align-items-center py-2 px-4 bg-light rounded-3 border">
        <div class="bi-house-fill me-3 fs-1"></div>
        <h4 class="mb-0">Well done! this is {{ $currentRouteName }}.</h4>
    </div>
    <div id="chart"></div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script>
        data= @json($employeeCounts);
        console.log(data)
        new Morris.Bar({
          element: 'chart',
          data : @json($employeeCounts),
          xkey: ['position_name'],
          ykeys: ['employee_count'],
          labels: ['employee_count'],
          hideHover: 'auto',
          stacked : false,
          yLabelFormat : function(y) {return Math.round(y)},
        });
      </script>
</div>
