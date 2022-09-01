const drop_down = document.querySelector('.arrow');
const drop_down_content = document.querySelector('.drop_down');

drop_down.addEventListener('click', () => {
    // console.log('test');
    drop_down_content.classList.toggle('show');
})
