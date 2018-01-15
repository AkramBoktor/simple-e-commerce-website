$(document).ready(function(){
		/* add star after required field */
		$('input').each(function () {

		if($(this).attr('required') === 'required') {

			$(this).after('<span class="asterisk">*</span>');

		}

	});
	
	/**show the password by using eye****/
	var pass=$(".password"); //class of the password
$(".show-pass").hover(function(){
	pass.attr('type','text');
},function(){
	pass.attr('type','password');
});


/******* confrm to delete members *****/
$('.confirm').click(function () {

		 return confirm('Are You Sure?');

	});
/********* accordian by jquery *********/
	
	$('.cat h2').click(function () {

		$(this).next('.full-view').fadeToggle(500);
	});
	
	$('.ordering span').click(function () {

		if($(this).data('view')==='full'){
			$('.full-view').fadeIn(1000);
		}else{
			$('.full-view').fadeOut(1000);
		}
	});

/************selectbox***********************/
$("select").selectBoxIt();
});