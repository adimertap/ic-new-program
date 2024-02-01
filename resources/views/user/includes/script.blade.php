<!-- Bootstrap core JavaScript-->
<script src="{{ asset('userAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('/userAdmin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('/userAdmin/js/sb-admin-2.min.js')}}"></script>

<script type="text/javascript">
    var BASE_URL = "{{ url('')}}"
</script>
<script type="text/javascript">
    var USERNAME = "{{empty(Auth::user()) ? "" : Auth::user()->username}}";
</script>
