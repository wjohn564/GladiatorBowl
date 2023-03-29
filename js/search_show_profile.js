const user_btn = document.querySelector('#user_btn');
const search_show_profile = document.querySelector('#search_show_profile');

user_btn.addEventListener('click', ()=>{
    user_btn.scale = 2;
    if (search_show_profile.style.display === 'none')
        search_show_profile.style.display = 'block';
    else
        search_show_profile.style.display = 'none';
});