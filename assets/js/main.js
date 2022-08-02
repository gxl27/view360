let body = document.querySelector('body');
let main = document.querySelector('#main');
let banner = document.querySelector('#banner');
let headerBar = document.querySelector('header');
let menuItems = document.querySelectorAll('.menu-item');
let logo = document.querySelector('#logo');
// main.style.visibility = 'visible';
// body.style.visibility = 'hidden';
document.addEventListener("DOMContentLoaded", function(){
    if(body){
        body.style.visibility = 'visible';
        body.style.opacity = '1';

    }

});

menuitemsanimation();
scrollUpScreen();

if (matchMedia) {
    const mq = window.matchMedia("(min-width: 768px)");

    window.device; 
    if(mq.matches){
        // pc
        window.device = true
    }else {
        // mobile
        window.device = false
    }
  
    mq.addListener(WidthChange);
    WidthChange(mq);
  }
 
  // media query change
  function WidthChange(mq) {
    if(mq.matches){
        //pc
        window.device = true;
        if(banner){
            banner.style.display = 'initial';
        }

    }else{
          // phone
        window.device = false;
        if(banner){
            banner.style.display = 'none';

        }
    // 
    }

}

// logo 

logo.addEventListener("click", function() {
    location.reload();
})

//upscreen
function scrollUpScreen(){
    const upScreen = document.querySelector('#up-screen')
    
    upScreen.addEventListener("click", function(){
        document.querySelector('html').scrollTo({
            top: 0,
            behavior: "smooth"
            })
    })

    window.addEventListener('scroll', function(e) {
        y = window.scrollY;
        
        if(y > 70){
            if(headerBar){
                headerBar.style.backgroundColor = "white";
            }
            upScreen.style.display = 'initial';
    
        }else{
            if(headerBar){
                headerBar.style.backgroundColor = "rgba(0,0,0,0)";

            }
            upScreen.style.display = 'none'
        }
    })
}

function menuitemsanimation(){

    menuItems.forEach(function(e){
 

        // on click event (scroll)
        e.addEventListener('click', function(){

            if(e.dataset.scroll){
                link = e.dataset.scroll;
                element =  document.querySelector(link)
                // document.querySelector(link).scrollIntoView();
                scrollToTargetAdjusted(element);
                if(!window.device){
                    // hide the navbar for mobile after click on menu items
                    let navToggle = document.querySelector('#nav-toggle');

                    navToggle.checked = false;
                }
            }
        })
        // function for the click - scroll animation
        function scrollToTargetAdjusted(scrolledelement){
     
            let body = document.body.getBoundingClientRect().top

            let elementPosition = scrolledelement.getBoundingClientRect().top;
            let offsetPosition = elementPosition - body - 65;

            window.scrollTo({
                 top: offsetPosition,
                 behavior: "smooth"
            });
        }
    })
}

