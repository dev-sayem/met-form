jQuery(document).ready(function($) {
    $("#insert_post").submit(function(event) {
        var post_url = $(this).attr("action");
        var form_data = $(this).serialize();
        //console.log("form data : "+form_data);
        //console.log("post url : "+post_url);

        $.post(post_url, form_data, function(response) {
            console.log(response);
            // console.log("Response(user mail) : "+data['user']);
            // console.log("Response(admin mail) : "+data['admin']);
            //console.log("Response(entry count) : "+data['entry_count']);
            //console.log("Response(form limit) : "+data['form_limit']);
            //console.log("status : "+data['status']+" msg : "+data['message']);
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

            if(response.data['hide_form'] != 0){
                $('#insert_post').css('display','none');
            }

            if(response.data['redirect_to'] != 0){
                console.log('redirect url: '+response.data['redirect_to']);
                // setTimeout( function(){ 
                //     window.location.replace(data['redirect_to']);
                // }  , 1500 );
            }


        }, 'json');
        event.preventDefault();
    });
})