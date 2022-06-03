function toggleElem(id){
    let element = document.querySelector(id);
    if(element.classList.contains('hidden')){
        element.classList.remove('hidden');
    }else {
        element.classList.add('hidden');
    }
}

let toggleBtn = document.querySelector("#toggleButton");

toggleBtn.addEventListener('click', function(){
    let menu = document.querySelector('#mainMenu');
    if(menu.classList.contains('hidden')){
        menu.classList.remove('hidden')
        menu.classList.add('come-from-right');
        if(menu.classList.contains('go-to-right')){
            menu.classList.remove('go-to-right')
        }
    }else{
        if(menu.classList.contains('come-from-right')){
            menu.classList.remove('come-from-right')
        }
        mainMenu.classList.add('go-to-right')
        setTimeout(() => {
            mainMenu.classList.add('hidden')
        }, 1000);
    }
});



function setImage(event){
    let file = event.target.files[0];
    let image = document.querySelector('#topic-image')
    
    let reader = new FileReader()

    reader.onload = () => {
        image.src=reader.result
        if(image.classList.contains('hidden'))
        {
            image.classList.remove('hidden')
        }
    }

    reader.readAsDataURL(file)
}