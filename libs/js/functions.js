jQuery(document).ready(function($) {
    $("#insert_post").submit(function(event) {
        var post_url = $(this).attr("action");
        var form_data = $(this).serialize();
        console.log("form data : "+form_data);
        console.log("post url : "+post_url);

        $.post(post_url, form_data, function(data) {
            console.log("Response : "+data);
            var status = Number(data['status']);
            if (status == 1) {

                $("#msg").css("display","block");
                $("#msg").css("background","#ff223f");
                $("#msg").text(data['message']);

            } else {
                
                $("#msg").css("display","block");
                $("#msg").css("background","#2cff37");
                $("#msg").text(data['message']);

            }
        }, 'json');
        event.preventDefault();
    });
})