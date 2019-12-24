function toggleAccountNavbar() {
    let screenWidth = screen.width;
    let accountTitle = document.getElementById('accountTitle');
    let iconAccount = document.getElementById('iconAccount');

    if (screenWidth < 1300 && screenWidth > 767) {
        accountTitle.classList.add('display-none');
        iconAccount.classList.add('navbar-account-icon-js');
    } else {
        accountTitle.classList.remove('display-none');
        iconAccount.classList.remove('navbar-account-icon-js');
    }
}

function showDropdowns() {
    let screenWidth = screen.width;
    let btnsTabsMenu = document.getElementsByClassName('tab-menu-dropdown');
    let dropdownsTabsMenu = document.getElementsByClassName('container-dropdown');
    let dropdownsTabMenuXS = document.getElementsByClassName('dropdownsMenu-xs');

    for(let i = 0; i < btnsTabsMenu.length; i ++) {

        if (screenWidth > 767) {
            btnsTabsMenu[i].addEventListener("mouseover", function() {
                dropdownsTabsMenu[i].classList.remove('display-none');
                btnsTabsMenu[i].classList.add('underline-tab');
            });

            dropdownsTabsMenu[i].addEventListener("mouseover", function() {
                dropdownsTabsMenu[i].classList.remove('display-none');
                btnsTabsMenu[i].classList.add('underline-tab');
            });

            btnsTabsMenu[i].addEventListener("mouseout", function() {
                dropdownsTabsMenu[i].classList.add('display-none');
                btnsTabsMenu[i].classList.remove('underline-tab');
            });

            dropdownsTabsMenu[i].addEventListener("mouseout", function() {
                dropdownsTabsMenu[i].classList.add('display-none');
                btnsTabsMenu[i].classList.remove('underline-tab');
            });

            for (let m = 0; m < dropdownsTabMenuXS.length; m ++) {
                dropdownsTabMenuXS[m].classList.add('display-none');
            }

        } else {
            btnsTabsMenu[i].addEventListener("mouseover", function() {
                dropdownsTabsMenu[i].classList.add('display-none');
            });

            btnsTabsMenu[i].addEventListener("click", function() {
                for (let m = 0; m < dropdownsTabMenuXS.length; m ++) {
                    dropdownsTabMenuXS[m].classList.add('display-none');
                }
                dropdownsTabMenuXS[i].classList.remove('display-none');
            });
        }

        let btnBlog = document.getElementById('tabBlog');
        let currentUrl = window.location.href;
        let result = currentUrl.split('/')[4];

        if (result != null) {
            switch (result) {
                case 'gardenKey' :
                    btnsTabsMenu[0].style.color = '#34D094';
                    btnsTabsMenu[0].classList.add('underline-tab-2');
                    break;
                case 'inspiration' :
                    btnsTabsMenu[1].style.color = '#34D094';
                    btnsTabsMenu[1].classList.add('underline-tab-2');
                    break;
                case 'achievements' :
                    btnsTabsMenu[1].style.color = '#34D094';
                    btnsTabsMenu[1].classList.add('underline-tab-2');
                    break;
                case 'expertise' :
                    btnsTabsMenu[2].style.color = '#34D094';
                    btnsTabsMenu[2].classList.add('underline-tab-2');
                    break;
                case 'blog' :
                    btnBlog.style.color = '#FF9486';
                    btnBlog.classList.add('underline-tab-3');
                    break;
                case 'profile' :
                    btnsTabsMenu[3].style.color = '#34D094';
                    btnsTabsMenu[3].classList.add('underline-tab-2');
                    break;
                default :
                    break;
            }
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    toggleAccountNavbar();
    showDropdowns();
});

window.addEventListener('resize', function() {
    toggleAccountNavbar();
    showDropdowns();
});
