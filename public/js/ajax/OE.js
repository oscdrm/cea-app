
$('#NA').on('change', function(){
    var na = $(this).val();
    getOE(na);
 });

function getOE(nivelAcademico){
    var ofertaEducativa = $("#carrera");
    ofertaEducativa.empty();
    $.ajax({ 
       type: "GET",
       dataType: "json",
       url: "/carrera/nivelAcademico/"+nivelAcademico,
       success: function(data){        
          if(data.data != ''){
             $.each(data.data, function(key, entry) {
                var option = '<option value="'+entry.id+'"> '+entry.name+' </option>';
                ofertaEducativa.append(option);
                ofertaEducativa.trigger("chosen:updated");
             });
             ofertaEducativa.chosen();
          }
       }
 });
}