jQuery(document).ready(function($) {
    $("#insert_post").submit(function(e) {
        var post_url = $(this).attr("action");
        var form_data = $(this).serialize();
        var nonce = $(this).attr('data-nonce');
        console.log(nonce);
        //console.log("form data : "+form_data);
        //console.log("post url : "+post_url);

        $.ajax({
            url: post_url,
            type: 'post',
            data: form_data,
            headers: {
                'X-WP-Nonce': nonce
            },
            dataType: 'json',
            success: function (response) {
                console.info(response);
                var status = Number(response.status);
                if (status == 1) {

                    $("#msg").css("display","block");
                    $("#msg").css("background","#62ed12");
                    $("#msg").text(response.data['message']);
        
                } else {
                    
                    $("#msg").css("display","block");
                    $("#msg").css("background","#dd3939");
                    $("#msg").text(response.error[1]);
                }

                if(response.data['hide_form'] != ''){
                    $('#insert_post').css('display','none');
                }

                if(response.data['redirect_to'] != ''){
                    console.log('redirect url: '+response.data['redirect_to']);
                    setTimeout( function(){ 
                        window.location.replace(response.data['redirect_to']);
                    }  , 1500 );
                }
            }
        });

        e.preventDefault();
    });
})