<footer class="col-xs-12 col-sm-12 footer text-center">
	@if (!Auth::guest())
	    <div class="container">
	    	<small class="credit">Designed and Developed by Mahip Kaushal</small>
	    	<br />
	        <small class="copyright">© {{ date('Y') }} Mahip Kaushal. All rights reserved.</small>
	    </div>
	@endif
</footer>

@if (Session::get('success'))
    <script type="text/javascript">
        $(document).ready(function() {
            toastr.success('{{ Session::get('success') }}');
        });            
    </script>
@endif
@if (Session::get('errors'))
    <script type="text/javascript">
        $(document).ready(function() {
            @foreach (Session::get('errors') as $error)
                toastr.error('{{ $error }}');
            @endforeach
        });
    </script>
@endif