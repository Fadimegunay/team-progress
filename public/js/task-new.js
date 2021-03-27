function teamUsers() {
    if ($("#team").val() && $("#team").val() !== "") {
        $.ajax({
            url: '/ajax/team/user',
            data: {'team_id': $("#team").val()},
            success: function (response) {
                
                var userSelect = $('#users');
                userSelect.empty();
                $.each(response, function (index, value) {
                    
                    var option = $("<option></option>").val(value.id).append(value.name);
                    userSelect.append(option);
                });
               // userSelect.selectpicker('refresh');
            }
        });
    }
}
$(document).ready(function () {
    teamUsers();
    $("#team").on('change', function () {
        teamUsers();
    });
});