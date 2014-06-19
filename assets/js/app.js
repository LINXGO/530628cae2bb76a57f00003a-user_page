function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) { createCookie(name,"",-1);}
$(document).ready(function (){
    if ( $('#country').length>0) {
        $('#country').change(function(event) {
            $('#state').val($(this).val());
            $('#search_text').val('');
            $('#search_form').submit();
        });
    }
    if ($('#region').length>0) {
        $('#region').change(function(event) {
            $('#state_country').val($(this).val());
            $('#search_text').val('');
            $('#search_form').submit();
        });
    }
    if ($('a.cat-selector').length>0) {
        $('a.cat-selector').on('click',function(event){
            event.preventDefault();
            event.stopPropagation();
            $('#cat').val($(this).attr('data-cat'));
            $('#subcat').val(-1);   
            $('#search_text').val('');
            $('#search_form').submit();
        });
    }
    if ($('.country-selector').length>0) {
        $('.country-selector').on('click',function(event){
            event.preventDefault();
            event.stopPropagation();            
            $('#state').val($(this).attr('href'));
            $('#search_text').val('');
            $('#search_form').submit();
        });
    }
    if ($('.subcategory-button').length>0) {
        $('.subcategory-button').click(function(event) {
            event.preventDefault();
            var _this_select = $(this).siblings('select');
            $('.subcat_list').not(_this_select)
                .removeClass('active').addClass('inactive')
                .find('.subcategory-button').removeAttr('data-toggle').find('i').removeClass('icon-sort-up').addClass('icon-sort-down');
            if ($(this).attr('data-toggle')) {
                $(this).find('i').removeClass('icon-sort-up').addClass('icon-sort-down');
                $(this).removeAttr('data-toggle');
                $('#subcat').val(-1);
            } else {
                $(this).find('i').removeClass('icon-sort-down').addClass('icon-sort-up');        
                $(this).attr('data-toggle',true);    
            }
            $(_this_select).toggleClass('active').find('option').removeAttr('selected');
            $(_this_select).selectedIndex = -1;
        });
    }
    if ($('.subcat_list').length>0) {
        $.each($('.subcat_list').find('option'), function() {
            $(this).click(function(){
                $('#subcat').val($(this).val());   
                $('#cat').val($(this).parent().siblings('.cat-selector') .attr('data-cat'));
                $('#search_text').val('');                
                $('#search_form').submit();
            });
            if ($(this).attr('selected')) {
                $(this).parent('select').toggleClass('active').siblings('.subcategory-button').attr('data-toggle',true).find('i').removeClass('icon-sort-down').addClass('icon-sort-up')
            }
        });
    }

	if ($('.searchPagination').length>0) {
		$.each($('.searchPagination').find('a'), function() {
			var _self  = this;
			$(this).click(function(event){
				event.preventDefault();
				$('#search_form').attr('action', $(_self).attr('href')).submit();
			});
		});
	}
    $("[rel='tooltip']").each(function() {
        //$(this).qtip({  content: { text: $(this).attr('data-tip') }, style: { classes: "qtip-tipsy"  }, position: { my: 'bottom center', at : 'top center', adjust: { y: 5 } }  });
    	$(this).qtip({  content: { text: $(this).attr('data-tip') }, style: { classes: "qtip-tipsy"  }, position: { my: 'bottom center', at : 'top center' }  });    	
    });
    if (readCookie('_accept_coockies')==null) {
        _cookie_text = $('#cookie_info').attr('cookie-info-text');
        _cookie_close_title = $('#cookie_info').attr('data-cookie-close-title');
        _cookie_link_text = $('#cookie_info').attr('data-cookie_info_text_link_text');
        _cookie_link = $('#cookie_info').attr('data-cookie-info-url');        
        createCookie('_accept_coockies', '1',365*10);
        $('body').prepend('<div id="cookies_bar"><div class="info-text">'+_cookie_text+' <a href="'+_cookie_link+'">'+_cookie_link_text+'</a>.</div><div class="close"><a href="#" title="'+_cookie_close_title+'">x</a></div></div>');
        $('#cookies_bar .close a').click(function(e) {
            e.preventDefault();
            $('#cookies_bar').fadeOut('normal');
        });
    }
    $('#cookie_info').remove();    
});