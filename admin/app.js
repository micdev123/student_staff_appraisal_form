const drop_down = document.querySelector('.arrow');
const drop_down_content = document.querySelector('.drop_down');

drop_down.addEventListener('click', () => {
    // console.log('test');
    drop_down_content.classList.toggle('show');
})


const toggle = document.querySelector(".toggle"),
input = document.getElementById('password');

toggle.addEventListener("click", () =>{
    if(input.type === "password"){
        // console.log('yah');
        input.type = "text";
        toggle.classList.replace("fa-eye-slash", "fa-eye");
    }
    else{
        // console.log('nope');
        input.type = "password";
        toggle.classList.replace("fa-eye", "fa-eye-slash");
    }
})