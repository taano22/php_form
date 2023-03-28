//入力画面での画像プレビュー表示
$(function(){
    $('#image').change(function(e){
        var file = e.target.files[0];
        var reader = new FileReader();
        if(file.type.indexOf('image') < 0){
        alert("画像ファイルを指定してください。");
        return false;
        }
        reader.onload = (function(file){
        return function(e){
            $('#previmg').attr('src', e.target.result);
            $('#previmg').attr('title', file.name);
            $('#previmg').attr('width', "300");
            $('#previmg').attr('height', "300");
        };
        })(file);
        reader.readAsDataURL(file);
    });
});

function countLength(inputId, countId) {
    $("#" + inputId).keyup(function() {
        var count = $(this).val().length;
        $("#" + countId).text(count);
    });
}

countLength("name", "count_name");
countLength("email", "count_email");
countLength("tel", "count_tel");
countLength("message", "count_message");


