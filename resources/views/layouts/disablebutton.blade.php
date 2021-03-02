
@section('disbutton')
    $("button").click(function(e){
        $("button").prop("disabled", true);
        $(".form-disabled").submit();
    });
@endsection