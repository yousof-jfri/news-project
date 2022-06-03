$(document).ready(function() {
    
    const mainMenu = $('#main-menu');
    
    const toggleButton = $('#toggleButton');
    toggleButton.click(function() {
        if(mainMenu.hasClass('hidden')){
            mainMenu.toggleClass('hidden')
            mainMenu.addClass('come-from-right')
        }else{
            mainMenu.addClass('go-to-right')
            mainMenu.removeClass('come-from-right')
            setTimeout(() => {
                mainMenu.toggleClass('hidden')
                mainMenu.toggleClass('go-to-right')
            }, 1000);
        }
    })


    $('#openUser').click(function() {
        $('#userMenu').toggleClass('hidden');
    })

    // sending comment
    $('#submitComment').click(function(event) {
        event.preventDefault();
        let userData = {
            comment: $('#comment').val(),
            parent_id: $('#parent_id').val(),
            newsId: $('#newsId').val()
        }

        // validate data
        if(userData.comment == '' || userData.email == '' || userData.name == '' ){
            $('#commentError').toggleClass('hidden')
            throw Error('تمام فیلد های نظر را پر کنید')
        }

        let csrfToken = document.head.querySelector('meta[name="csrf-token"]').content

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN' : csrfToken,
                'Content-Type' : 'application/json',
            }
        })


        $.ajax({
            url: `http://127.0.0.1:8000/new-commnet/${userData.newsId}/`,
            data: JSON.stringify(userData),
            type: 'POST',
            
            
            success: (response) => {
                $('#comment').val('')
                Swal.fire({
                    title: 'نظر شما با موقیت ارسال شد',
                    text: 'لطفا منتظر تایید شدن آن باشد',
                    icon: 'success',
                })
            }
        })
    })
})

function newComment(id){
    let commentForm = $('#commentForm');
    $(`#comment-${id}`).append(commentForm)
    $('#parent_id').val(id)
}