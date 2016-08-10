<?php
 $colors = ["#f56954",  "#00a65a" ,"#f39c12","#00c0ef", ];

 ?><div class="box-body">
  <div class="row">
    <div class="col-md-8">
      <div class="chart-responsive">
        <canvas id="pieChart" height="150"></canvas>
      </div>
      <!-- ./chart-responsive -->
    </div>
    <!-- /.col -->
    <div class="col-md-4">
      <ul class="chart-legend clearfix">
      <?php
      $j =0;
      foreach($model as $key => $value){
        $color = $colors[$j++];
        $tag = Yii::t('app',$key);
        echo "<li><i class='fa fa-circle-o ' style='color:$color !important;'></i> $tag</li>";
      }?> 
      </ul>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>


 <script type="text/javascript">
  //-------------
  //- PIE CHART -
  //-------------

    
  <?php

   $pieData=[]; 
  $j=0;
  foreach ($model as $key => $value) {
     $pieData[] = ['value'=>$value, 'color'=>$colors[$j++],'label'=>$key];
  }
  echo "var PieData ="  . json_encode($pieData ) .';'
  ?>
  

  var pieOptions = {
    //Boolean - Whether we should show a stroke on each segment
    segmentShowStroke: true,
    //String - The colour of each segment stroke
    segmentStrokeColor: "#fff",
    //Number - The width of each segment stroke
    segmentStrokeWidth: 1,
    //Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    //Number - Amount of animation steps
    animationSteps: 100,
    //String - Animation easing effect
    animationEasing: "easeOutBounce",
    //Boolean - Whether we animate the rotation of the Doughnut
    animateRotate: true,
    //Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale: false,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: false,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
    //String - A tooltip template
    tooltipTemplate: "<%=value %> <%=label%> users"
  };

$(function(){
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
  var pieChart = new Chart(pieChartCanvas);
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  // 
  pieChart.Doughnut(PieData, pieOptions);
});
  //-----------------
  //- END PIE CHART -
  //-----------------
  //
  </script>