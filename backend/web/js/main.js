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

	$("[data-mask]").inputmask();

	$('.showFields').click(function(e){
		e.preventDefault();

		$(this).parent().next().slideToggle(300);
	});


	 $.tablesorter.addParser({
    id: "customDate",
    is: function(s) {
        //return false;
        //use the above line if you don't want table sorter to auto detected this parser
        //else use the below line.
        //attention: doesn't check for invalid stuff
        //2009-77-77 77:77:77.0 would also be matched
        //if that doesn't suit you alter the regex to be more restrictive
        return /\d{1,4}-\d{1,2}-\d{1,2} \d{1,2}:\d{1,2}:\d{1,2}\.\d+/.test(s);
    },
    format: function(s) {
        s = s.replace(/\-/g," ");
        s = s.replace(/:/g," ");
        s = s.replace(/\./g," ");
        s = s.split(" ");
        return $.tablesorter.formatFloat(new Date(s[0], s[1]-1, s[2], s[3], s[4], s[5]).getTime()+parseInt(s[6]));
    },
    type: "numeric"
	});


	$('#payed, .tablesorter').tablesorter({
		headers: {
			3: 'customDate'
		}
	});

	$('.select-button-status').change(function(){
		$.post('/order/change-status', {
			id: $(this).data('id'),
			order_id: $(this).data('order-id'),
			value: $(this).val()
		}, function(s){
			$('.fixed-alert p').text(s);
			$('.fixed-alert').fadeIn(600);
			setTimeout(function(){
				$('.fixed-alert').fadeOut(600);
			}, 2000);
		});
	});


	$('.removeFile').click(function(e){
        e.preventDefault();
        var id = $(this).data('button');
        var that = this
        $.post('/order/remove-file', {
            id: id
        }, function(s){
            $(that).parent().find('label').text('Выберите файл...');
        });
    });

	$('.select-button-status').change(function(){
		if($(this).val() == 3){
			//$(this).next('.tooltip-text').removeClass('hidden');
		} else {
			//$(this).next('.tooltip-text').addClass('hidden');
		}
	});

	$('.tooltip-text').submit(function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var tooltip = $(this).find('input').val();

		$.post('/order/add-tooltip', {
            id: id,
            tooltip: tooltip
        }, function(s){
            $('.fixed-alert p').text(s);
			$('.fixed-alert').fadeIn(600);
			setTimeout(function(){
				$('.fixed-alert').fadeOut(600);
			}, 2000);
        });
	});


	$('.change-order-status').change(function(){
		$.post('/order/change-order-status', {
			id: $(this).data('id'),
			value: $(this).val()
		}, function(s){
			$('.fixed-alert p').text(s);
			$('.fixed-alert').fadeIn(600);
			setTimeout(function(){
				$('.fixed-alert').fadeOut(600);
			}, 2000);
		});
	});

	$('.for-file-input+input').change(prepareUpload);
	var files = [];
	function prepareUpload(event){
		if(event.target.files){
			files = event.target.files;
		}

		if(files[0]){
			$(this).prev('label').text(files[0].name)
		}

		var data = new FormData();
	    $.each(files, function(key, value)
	    {
	        data.append(key, value);
	    });

	    data.append('id', $(this).data('id'));
	    data.append('order_id', $(this).data('order-id'));

	    $.ajax({
	        url: '/order/add-file',
	        type: 'POST',
	        data: data,
	        cache: false,
	        /*dataType: 'json',*/
	        processData: false,
	        contentType: false,
	        success: function(data, textStatus, jqXHR)
	        {
	            if(typeof data.error !== 'undefined'){
	                // Handle errors here
	                console.log('ERRORS: ' + data.error);
	            } else {
		            $('.fixed-alert p').text(data);
					$('.fixed-alert').fadeIn(600);
					setTimeout(function(){
						$('.fixed-alert').fadeOut(600);
					}, 2000);
				}
	        },
	        error: function(jqXHR, textStatus, errorThrown)
	        {
	            // Handle errors here
	            console.log('ERRORS: ' + textStatus);
	            // STOP LOADING SPINNER
	        }
	    });
	}


	$('.filter-inputs select, .filter-inputs input').on('change input textInput',function(){
		var toHide = [];
		$('.filter-inputs select').each(function(){
			var index = $(this).parents('td').index()+1;
			var value = $(this).val();
			if(value){
				toHide.push({
					index: index,
					value: value
				});
			}
		});

		if($('.filter-inputs input').val()){
			toHide.push({
				value: $('.filter-inputs input').val(),
				index: $('.filter-inputs input').parents('td').index()+1
			})
		}

		$('.to-filter-inputs tr').hide();
		$('.to-filter-inputs tr').filter(function (i, v) {
		    var $t = $(this);
		    for (var d = 0; d < toHide.length; ++d) {
		        if ($t.find('td:nth-child('+toHide[d].index+') span.filter-val').text() != toHide[d].value) {
		            return false;
		        }
		    }
		    return true;
		}).show();
	});

})($)