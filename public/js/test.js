$(document).ready(function(){
	/* left side check box */
	$(document).on('click','.leftItemCheckBox',function(){
		$('.leftItemCheckBox').prop('checked',false);
		$('.leftItemCheckBox').parent('p').css('background-color','#fff');
		$(this).prop('checked',true);
		$(this).parent('p').css('background-color','blue');
	});

	/* right side check box */
	$(document).on('click','.rightItemCheckBox',function(){
		$('.rightItemCheckBox').prop('checked',false);
		$('.rightItemCheckBox').parent('p').css('background-color','#fff');
		$(this).prop('checked',true);
		$(this).parent('p').css('background-color','blue');
	});

	/*   Add item  */
	$(document).on('click','.addItem',function(){
		removeError();
		var title = $('.item_name').val();
		if(title==''){
			$('.addItem').after('<p class="error">Item name is required.</p> ');
			$('.item_name').css('border','1px solid red');
			setTimeout(function(){
		        $('p.error').html('');
		        $('.item_name').css('border','1px solid #666666');
		    }, 2000);
			return false;
		}
		var data = {};
		data['title'] = title;
		var url = site_url+'/add/item';
		simpleAjax(url, data, 'addItem', 'post', 'json','');

	});

});

function addItem(response){
	hideloader();	
	if(response.status){
		var html= '<label class="cstm-check leftItem-'+response.id+'">'+response.title+'<input type="checkbox" name="leftItemCheckBox" class="leftItemCheckBox" id="leftItemCheckBox" value="'+response.id+'"><span class="checkmark"></span></label>';

		var count_elements = $('.leftItemCheckBox').length;
		if(count_elements==0){
			$('div.itemDiv1').html(html);
		}else{
			$('div.itemDiv1').append(html);
		}
		$('.addItem').after('<p class="success">'+response.message+'</p> ');
		$('.item_name').val('');
		setTimeout(function(){
	        $('p.success').html('');
	    }, 3000);
	}else{
		$('.addItem').after('<p class="error">'+response.message+'</p> ');
		setTimeout(function(){
	        $('p.error').html('');
	    }, 3000);
	}
}

/* Move item from left to right */
$(document).on('click','.moveLeftToRight',function(){
	removeError();
	var left_counts = $('.leftItemCheckBox').length;
	if(left_counts>0){
		if ($('.leftItemCheckBox').is(":checked")){
			var id = $('.leftItemCheckBox:checked').val();
			var data = {};
			data['id'] = id;
			data['item_position'] = 2;
			data['move_to'] = 'right';
			data['title'] = $('.leftItemCheckBox:checked').parent('label').text();
			var url = site_url+'/add/item/left/to/right';
			if (confirm("Are you sure to move item from left to right")) {
		        simpleAjax(url, data, 'swapItemLeftToRight', 'post', 'json','');
		    }		
		}else{
			$('.addItem').after('<p class="error">Please select item first.</p> ');
			$('div.itemDiv1').css('border-color','red');
			setTimeout(function(){
				$('p.error').html('');
		        $('div.itemDiv1').css('border-color','#666666');
		    }, 3000);
		}
	}
});

/* Move item from right to left */
$(document).on('click','.moveRightToLeft',function(){
	removeError();
	var right_counts = $('.rightItemCheckBox').length;
	if(right_counts>0){
		if ($('.rightItemCheckBox').is(":checked")){
			var id = $('.rightItemCheckBox:checked').val();
			var data = {};
			data['id'] = id;
			data['item_position'] = 1;
			data['move_to'] = 'left';
			data['title'] = $('.rightItemCheckBox:checked').parent('label').text();
			var url = site_url+'/add/item/left/to/right';
			if (confirm("Are you sure to move item from right to left")) {
		        simpleAjax(url, data, 'swapItemLeftToRight', 'post', 'json','');
		    }		
		}else{			
			$('.rightBoxError').html('Please select item first.')
			$('div.itemDiv2').css('border-color','red');
			setTimeout(function(){
		        $('div.itemDiv2').css('border-color','#666666');
		        $('p.rightBoxError').html('');
		    }, 3000);
		}
	}
});

//swapItemLeftToRight
function swapItemLeftToRight(response){
	if(response.move_to=='left'){
		var html= '<label class="cstm-check leftItem-'+response.id+'">'+response.title+'<input type="checkbox" name="leftItemCheckBox" class="leftItemCheckBox" id="leftItemCheckBox" value="'+response.id+'"><span class="checkmark"></span></label>';

		var count_elements = $('.leftItemCheckBox').length;		
		if(count_elements==0){
			$('div.itemDiv1').html(html);
		}else{
			$('div.itemDiv1').append(html);
		}
		$('label.rightItem-'+response.id).remove();
		var right_counts = $('.rightItemCheckBox').length;
		if(right_counts==0){
			$('div.itemDiv2').html('<p class="noItemFound"> No item found</p>');
		}

	}else{
		var html= '<label class="cstm-check rightItem-'+response.id+'">'+response.title+'<input type="checkbox" name="rightItemCheckBox" class="rightItemCheckBox" id="rightItemCheckBox" value="'+response.id+'"><span class="checkmark"></span></label>';
		var count_elements = $('.rightItemCheckBox').length;
		if(count_elements==0){
			$('div.itemDiv2').html(html);
		}else{
			$('div.itemDiv2').append(html);
		}
		$('label.leftItem-'+response.id).remove();

		var left_counts = $('.leftItemCheckBox').length;
		if(left_counts==0){
			$('div.itemDiv1').html('<p class="noItemFound"> No item found</p>');
		}
	}

}

function removeError(){
	$('.item_name').css('border','1px solid #666666');
	$('.itemDiv1').css('border','1px solid #666666');
	$('.itemDiv2').css('border','1px solid #666666');
	$('p.error').html('');
	$('p.rightBoxError').html('');
	$('p.success').html('');
}

var  xhrPool = [];

/* common function to call ajax*/
function simpleAjax(url, data, callback, type, dataType,self,param=[]) {
    var dataTp = 'json';
    var callTp = 'get';
    if (typeof(dataType) !== 'undefined') {
        dataTp = dataType;
    }
    if (typeof(type) !== 'undefined') {
        callTp = type;
    }
    if (typeof(self) !== 'undefined') {
        self = self;
    }
    showloader();
    $.ajax({
        url: url,
        type: callTp,
        dataType: dataTp,
        data: data,
        beforeSend: function(xhr) {
            xhrPool.push(xhr);
            xhr.setRequestHeader('X-CSRF-Token', $('input[name="_token"]').val());
        },
        success: function(data) {
            hideloader();
            //callback(data);
            if (typeof(self) != 'undefined') {
                eval(callback + "(data, self,param)");
            } else {
                eval(callback + "(data,param)");
            }
        }
    });
}


function showloader(){
    $(".loader-sec").show();
}

function hideloader(){
    $(".loader-sec").hide();
}