const btn_more = document.querySelector('#btn_more');
const show_more = document.querySelector('#show_more');

btn_more.addEventListener('click', ()=>{
    if (show_more.style.display === 'block')
        show_more.style.display = 'none';
    else
        show_more.style.display = 'block';
});