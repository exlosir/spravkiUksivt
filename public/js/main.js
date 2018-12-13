// $(document).ready(function(){
//     if($('form').is('#send_zayav')){
//         $.ajax({
//             type:'POST',
//             url:'/spravka/',
//             data: {'_token': '{{ csrf_token() }}'},
//             success: function(data){
//                 data = data;
//                 console.dir(data);
//                 $('select[name=department]').empty();
//                 $('select[name=department]').append($('<option\>', {text:"...", value:""}));
//                 $.each(data, function(i,value){
//                     $('select[name=department]').append($('<option\>', {text:value['name'], value:value['id']}));
//                 });
//             }
//         });
//         // $.post('/spravka',{},function(data){
//         //     // console.log(data);
            
//         // });
//     }
// });

$(document).ready(function(){
    $('#declineZayav').on('show.bs.modal', function (e) {

        var button = $(e.relatedTarget);
        var modal = $(this);
        var title = button.data('fio');
        var id = button.data('id');


        modal.find('.modal-title').append(title);
        modal.find('.modal-body input[name="id"]').val(id);
    })
});
