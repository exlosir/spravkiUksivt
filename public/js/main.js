$(document).ready(function(){
    if($('form').is('#send_zayav')){
        $.get('/spravka',function(data){
            console.log(data);
            $('select[name=department]').empty();
            $('select[name=department]').append($('<option\>', {text:"..."}));
            $.each(data, function(i,value){
                $('select[name=department]').append($('<option\>', {text:value}));
            });
        });
    }
});