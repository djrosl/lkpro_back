(function(){
	var cbuts = new Clipboard('.btn-clipboard');

	$('body').on('click', '.btn-clipboard', function(){
		$(this).removeClass('btn-default').addClass('btn-success');
		$(this).find('i.fa').removeClass('fa-copy').addClass('fa-check')
		var that = this;
		setTimeout(function(){
			$(that).find('i.fa').addClass('fa-copy').removeClass('fa-check')
			$(that).addClass('btn-default').removeClass('btn-success');
		}, 400)
	});
})($)