$(document).ready(function () {
    $('.users-delete').click(function () {
        var element = $(this);
        var result = confirm("Kullanıcıyı silmek istediğinize emin misiniz?");
        if (result) {
            $.ajax({
                
                  url: '/users/' + element.data('id'),
                  type: 'DELETE',
                  data: {
                     _token : $('meta[name="csrf-token"]').attr('content')
                  },
                  dataType: "text",
                success: function (response) {
                    if(response) {
                        alert("Silme işlemi başarılı.");
                        location.replace('/users');
                    } else {
                        alert("Silme işlemi başarısız daha sonra tekrar deneyiniz!");
                    }
                }
            });
        }
    });

    $('.role-delete').click(function () {
        var element = $(this);
        var result = confirm("Rolü silmek istediğinize emin misiniz?");
        if (result) {
            $.ajax({
                
                  url: '/roles/' + element.data('id'),
                  type: 'DELETE',
                  data: {
                     _token : $('meta[name="csrf-token"]').attr('content')
                  },
                  dataType: "text",
                success: function (response) {
                    if(response) {
                        alert("Silme işlemi başarılı.");
                        location.replace('/roles');
                    } else {
                        alert("Silme işlemi başarısız daha sonra tekrar deneyiniz!");
                    }
                }
            });
        }
    });

    $('.team-delete').click(function () {
        var element = $(this);
        var result = confirm("Takımı silmek istediğinize emin misiniz?");
        if (result) {
            $.ajax({
                
                  url: '/teams/' + element.data('id'),
                  type: 'DELETE',
                  data: {
                     _token : $('meta[name="csrf-token"]').attr('content')
                  },
                  dataType: "text",
                success: function (response) {
                    if(response) {
                        alert("Silme işlemi başarılı.");
                        location.replace('/teams');
                    } else {
                        alert("Silme işlemi başarısız daha sonra tekrar deneyiniz!");
                    }
                }
            });
        }
    });
});