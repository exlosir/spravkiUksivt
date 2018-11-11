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