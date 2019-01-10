$(document).ready(function(){
    $('.panel-header').html('SIGN IN');
});


function getUsers() {
    const apiUrl = "http://localhost:8080";
    const $list = $('.users-list');

    $.ajax({
        url : apiUrl + '/?page=admin_users',
        dataType : 'json'
    })
        .done((res) => {

            console.log(res);
            $list.empty();
            //robimy pętlę po zwróconej kolekcji
            //dołączając do tabeli kolejne wiersze
            res.forEach(el => {
                $list.append(`<tr>
                    <td>${el.login}</td>
                    <td>${el.email}</td>
                    <td>${el.role}</td>
                    <td>
                    <button class="btn btn-danger" type="button" onclick="deleteUser(${el.id_user})">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    </td>
                    </tr>`);
            })
        });
}

function deleteUser(id) {
    if (!confirm('Czy chcesz usunąć tego użytkownika?')) {
        return;
    }

    const apiUrl = "http://localhost:8080";

    $.ajax({
        url : apiUrl + '/?page=admin_delete_user',
        method : "POST",
        data : {
            id_user : id
        },
        success: function() {
            alert('Użytkownik usunięty!');
            getUsers();
        }
    });
}