const bar = document.querySelector('#bar');
const closes = document.querySelector('#close');
const aside = document.querySelector('.aside');

bar.addEventListener('click', function(){
    aside.style.marginLeft = '0rem';
    bar.style.display = 'none';
    closes.style.display = 'block';
})

closes.addEventListener('click', function(){
    aside.style.marginLeft = '-85%';
    closes.style.display = 'none';
    bar.style.display = 'block';
})

// commentsection
 
$(document).ready(function () {
    $('.comment-btn').forEach(element => {
        
    });
    $(element).click(function (e) { 
        e.preventDefault();
        var msg = $('.text-box-comment').val();
        var post_id = $('.post_id').val();
        if($.trim(msg).length == 0){
            error_msg = "Please comment";
            $('#error-status').text(error_msg);
        }else{
            error_msg = "";
            $('#error-status').text(error_msg);
        }
        if(error_msg != ''){
            return false;
        }else{
            var data ={
                'msg': msg,
                'post_id': post_id,
                'add_comment': true,
            }
            $.ajax({
                type: "POST",
                url: "comment.php",
                data: data,
                success: function (response) {
                    alert(response);
                    $('.text-box-comment').val("");
                }
            });
        }
    });
}); 