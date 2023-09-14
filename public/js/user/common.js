var Scheme = window.location.protocol;
var hostname = window.location.hostname + ':' + window.location.port;
var SchemeAndHttpHost = Scheme + '//' + hostname;

const search_input_icon = document.querySelector('.search_input_icon');
const search_input_icon_i = document.querySelectorAll('.search_input_icon i');
const search_input_outer = document.querySelector('.search_input_outer');
const search_box =document.querySelector('.search_box');
const body = document.querySelector('body');
const sun = document.querySelector('.sun');
const moon = document.querySelector('.moon');
const images = document.querySelector('.logo a img');
const footer_image = document.querySelector('.footer_image a img');

// console.log(footer_image);

const serach_url = SchemeAndHttpHost + "/" + "api/search";
const search_page = SchemeAndHttpHost + "/" + "api/search-result";
const blog_url = "api/blog";
const category_post = SchemeAndHttpHost + "/" + "api/categoryPost";
const footer_category_url = SchemeAndHttpHost + "/" + "api/home/footercategory";
const search_input = document.querySelector('.search');
const search_result =document.querySelector('.search_result .text');
const search_btn = document.querySelector('.search_btn');
const footer_category = document.querySelector('.footer_category ul');


var search_data;

let fa_bars = document.querySelector('.fa-bars');
let fa_xmark = document.querySelector('.fa-xmark');
let inner_nav = document.querySelector(' nav .inner_nav .logo_ul ul');

fa_bars.onclick = function () {
    inner_nav.classList.add('nav_ul_active');
    search_input_outer.classList.remove('hidden');
}

fa_xmark.onclick = function () {
    inner_nav.classList.remove('nav_ul_active');

}
search_input_icon.onclick = () => {
    search_input_outer.classList.toggle('hidden');
    if (search_input_outer.classList.contains('hidden')) {
        search_input_icon_i[0].style.display = 'none';
        search_input_icon_i[1].style.display = 'flex';
    } else {
        search_input_icon_i[0].style.display = 'flex';
        search_input_icon_i[1].style.display = 'none';
    }
}

let func_for_dark_mode = () => {
    localStorage.setItem('theme', 'dark');
    body.classList.add('dark');
    sun.classList.remove('clicked');
    moon.classList.add('clicked');
    images.src = SchemeAndHttpHost + "/" + "image/Group 3586.svg";
    footer_image.src = SchemeAndHttpHost + "/" + "image/Group 3586.svg";
};
let func_for_light_mode = () => {
    localStorage.setItem('theme', 'light');
    body.classList.remove('dark');
    moon.classList.remove('clicked');
    sun.classList.add('clicked');
    images.src = SchemeAndHttpHost + "/" + "image/logo.png";
    footer_image.src = SchemeAndHttpHost + "/" + "image/logo.png";
};
if (localStorage.getItem('theme') === 'dark') {
    body.classList.add('dark');
    sun.classList.remove('clicked');
    moon.classList.add('clicked');
    images.src = SchemeAndHttpHost + "/" + "image/Group 3586.svg";
    footer_image.src = SchemeAndHttpHost + "/" + "image/Group 3586.svg";
} else {
    body.classList.remove('dark');
    moon.classList.remove('clicked');
    sun.classList.add('clicked');
    images.src = SchemeAndHttpHost + "/" + "image/logo.png";
    footer_image.src = SchemeAndHttpHost + "/" + "image/logo.png";
}
sun.addEventListener('click', func_for_light_mode);
moon.addEventListener('click', func_for_dark_mode);



var search = (search_value) => {
    fetch(serach_url,{
        method : "POST",
        body : JSON.stringify({
            search: search_value,
        }),
        headers : {
            'Content-type': 'application/json; charset=UTF-8',
        },
    })
        .then(response => response.json())
        .then(json => {
            search_result.innerHTML = json.map(val => {
                const {title} = val;

                return `
                        <p>${title}</p>
                `;
            }).join('');

        })
}

search_input.addEventListener('input',() => {
    var search_value = search_input.value;
    if (search_value) {
        search_box.classList.add("active");
    } else {
        search_box.classList.remove("active");
    }
    search(search_value);
})

search_btn.addEventListener('click', () => {
    search_data = search_input.value;
    if(search_data.trim() === '')
    {
        window.location.href = window.location.href;
    }
    else
    {
        search_box.classList.remove("active");
        search_input_outer.classList.toggle('hidden');
        if (search_input_outer.classList.contains('hidden')) {
            search_input_icon_i[0].style.display = 'none';
            search_input_icon_i[1].style.display = 'flex';
        } else {
            search_input_icon_i[0].style.display = 'flex';
            search_input_icon_i[1].style.display = 'none';
        }
        window.location.href = search_page + `/${search_data}`;
        search_input.value = '';
    }
})

var footerCategory = () => {
    fetch(footer_category_url, {
        method: "GET",
        headers: {
            'Content-type': 'application/json; charset=UTF-8',
        },
    })
        .then(response => response.json())
        .then(json => {
            footer_category.innerHTML = json.map(val => {
                const{categoryName} = val;

                return `
                <a href="${category_post}/${categoryName}">
                    <li>${categoryName}</li>
                </a>
                `;
            }).join('');
        })
} 

footerCategory();