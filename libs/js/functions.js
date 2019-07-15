jQuery(document).ready(function($) {
    $("#insert_post").submit(function(event) {
        var post_url = $(this).attr("action");
        var form_data = $(this).serialize();
        console.log(form_data);
        console.log(post_url);

        $.post(post_url, form_data, function(data) {
            console.log(data);
            // var status = Number(data['status']);
            // if (status == 0) {
            //     document.getElementById("msg").style.display = 'block';
            //     document.getElementById("msg").style.background = '#ff223f';
            //     document.getElementById("msg").innerHTML = data['message'];
            // } else {
            //     document.getElementById("msg").style.display = 'block';
            //     document.getElementById("msg").style.background = '#2cff37';
            //     document.getElementById("msg").innerHTML = data['message'];
            // }
        }, 'json');
        event.preventDefault();
    });
})