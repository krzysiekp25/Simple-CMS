function deleteArticle() {
    if (!confirm('Czy chcesz usunąć ten artykuł?')) {
        return;
    }
    var articleId = getUrlParameter('id');
    console.log(articleId);
    $.ajax({
        url: "?page=delete_article",
        method: "POST",
        data: 'articleId=' + articleId,
        dataType: "JSON",
        success: function (response) {
            if (!response.error) {
                alert(response.message);
                window.location.href = window.location.hostname + '/?page=home';
            } else if (response.error) {
                alert(response.message);
            }
        }
    });
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