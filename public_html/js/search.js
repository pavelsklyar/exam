$(document).ready(function() {
    var $result = $('#search_box-result');

    $('#searchGroups').on('keyup', function(){
        var search = $(this).val();
        if (search != ''){
            $.ajax({
                type: "POST",
                url: "/schedule/groups/search/",
                data: {'search': search},
                success: function(msg){
                    $result.html(msg);
                    if(msg != ''){
                        $result.fadeIn();
                    } else {
                        $result.fadeOut(100);
                    }
                }
            });
        } else {
            $result.html('');
            $result.fadeOut(100);
        }
    });

    $('#searchTeachers').on('keyup', function(){
        var search = $(this).val();
        if (search != ''){
            $.ajax({
                type: "POST",
                url: "/schedule/teachers/search/",
                data: {'search': search},
                success: function(msg){
                    $result.html(msg);
                    if(msg != ''){
                        $result.fadeIn();
                    } else {
                        $result.fadeOut(100);
                    }
                }
            });
        } else {
            $result.html('');
            $result.fadeOut(100);
        }
    });

    $(document).on('click', function(e){
        if (!$(e.target).closest('.search_box').length){
            $result.html('');
            $result.fadeOut(100);
        }
    });
});

function enter(value) {
    var input = document.getElementById("searchGroups");
    console.log(value);
    console.log(input);
    if (input === null) {
        input = document.getElementById("searchTeachers");
    }
    input.value = value;

    var searchBox = document.getElementById("search_box-result");
    searchBox.innerHTML = '';

    var form = document.forms.namedItem("search_form");
    form.submit();
}