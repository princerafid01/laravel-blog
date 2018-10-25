 $('li.reply-form').hide();
 
 $('a.reply').click(function(e){
 	e.preventDefault();
 	var button_id = $(this).attr('id');
 	var kernel = 'li'+ '.' + button_id;
 	$(kernel).show(500);
 	


 	// var reply_id = $('li.reply-form').attr('id');
 	 // alert(kernel);
 	// if(button_id == reply_id)
 	// {
 	// 	$('li#'+reply_id).show(500);
 	// }


 });


// $('#search').on('keyup',function(){
// 	$value = $(this).val();
// 	$.ajax({
// 		type: 'get',
// 		url: '{{URL::to('search')}}',
// 		data: {'search': $value},
// 		success: function (data) {
// 			console.log(data);
// 			$('tbody').html(data);
// 		}
// 	});
// });


// $.ajaxSetup({headers : {'csrftoken' : '{{csrf_token()}}' } });