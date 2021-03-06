$(document).ready(function(){
    $('#commentForm').on('submit', function(event){
        var id = getUrlParameter('id');
        event.preventDefault();
        var formData = $(this).serialize();
        console.log(formData);
        $.ajax({
            url: "?page=comments",
            method: "POST",
            data: formData + '&id=' + id,
            dataType: "JSON",
            success:function(response) {
                if(!response.error) {
                    $('#commentForm')[0].reset();
                    $('#commentId').val('0');
                    $('#message').html(response.message);
                    showComments();
                } else if(response.error){
                    $('#message').html(response.message);
                }
            }
        })
    });
    $(document).on('click', '.delete', function(){
        var commentId = $(this).attr("id");
        console.log(commentId);
        $.ajax({
            url: "?page=delete_comments",
            method: "POST",
            data: 'id=' + commentId,
            dataType: "JSON",
            success:function(response) {
                if(!response.error) {
                    $('#message').html(response.message);
                    showComments();
                } else if(response.error){
                    $('#message').html(response.message);
                }
            }
        });
    });
});

$(document).ready(showComments());

function showComments() {
    var id = getUrlParameter('id');
    $.ajax({
        url:"?page=show_comments",
        method:"POST",
        data: { id: id},
        success:function(response) {
            $('#showComments').html(response);
        }
    })
}

function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};
