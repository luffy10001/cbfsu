window.$ = window.jQuery = import('jquery');
/*
require('bootstrap/dist/js/bootstrap');
*/
require('bootstrap');
require('select2');
require('./custom/actions')
 require('leaflet/dist/leaflet.js');


$(document).ready(function (){

    $('body').on('click','.active .iocn-link',function (){
        const elem = $(this);
        const slotIndex = elem.attr('slot_index');
        console.log(slotIndex,'slotIndex')
        elem.parents(`li.active[label="${slotIndex}"]`).toggleClass('show');
        elem.parents('div.container-fluid').removeClass('closeSidebar').addClass('openSidebar');

    });
    /*if ($('.arrow').length>0){
        for (var i=0;i<$('.arrow').length;i++){

        }
    }*/
});
/*let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
        let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
        arrowParent.classList.toggle("showMenu");
    });
}*/
/*
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");
console.log(sidebarBtn);
sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
});
*/

import 'laravel-datatables-vite';



