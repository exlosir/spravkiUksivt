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

    $('#createSpravka').on('show.bs.modal', function (e) {

        var button = $(e.relatedTarget);
        var modal = $(this);
        var id = button.data('id');

        modal.find('.modal-body form').attr('action', "statement/zayav/create/"+id+"");
    })

    $('#selectStudent').on('show.bs.modal', function (e) {
        // var button = $(e.relatedTarget);
        // var modal = $(this);
        // var id = button.data('id');

        // modal.find('.modal-body form').attr('action', "statement/zayav/create/"+id+"");
    })

    $('#searchStudent').click(function(){
        var search = $('input[name="search"]').val();
        $.ajax({
            url:'/home/orders/search',
            type: 'get',
            data: {search:search},
            success: function(data) {
                $('.students_field').empty();
                $.each(data.students, function(i, value) {
                    $('.students_field').append(
                        '<div class="form-check">'+
                        '<label class="form-check-label">'+
                        '<input type="radio" class="form-check-input" name="order" value="'+value.id+'">'+value.familiya+' '+value.imya+' '+value.otchestvo+' '+value.groups.year%100+''+value.groups.specialties.short_name+'-'+value.groups.number+
                        '</label>'+
                    '</div>');
                });
            }
        })
    })

});
