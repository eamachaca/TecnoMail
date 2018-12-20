@extends('layouts.app')
@section('content')
<div>
	<textarea id="text" ></textarea>
</div>
<div class="button-circle">
	<button onclick="ajax()">Traducir y Reconocer</button>
</div>
@endsection
@section('js')
<script type="text/javascript">
	function ajax() {
		$.ajax({
			type: "POST",
			url: "{{route('recognize')}}",
			data: {text:$('#text').val(), _token:'{{csrf_token() }}' },
			success: function(data){
		  		debugger;
		  	},
		  dataType: "json"
		});
	}
</script>
	
@endsection