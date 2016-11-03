<div class="progress progress-sm active">
    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
      <span class="sr-only">20% Complete</span>
    </div>
  </div>
  <script type="text/javascript">
	var prograssBar = 0;
	var prograssTimer = setInterval(function(){
		$('.progress-bar').css('width', prograssBar+'%');
		prograssBar+=2;
	},200);

	$(function(){
		$('.progress').remove();
		clearInterval(prograssTimer);
	});
  </script>