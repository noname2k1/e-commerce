const mobileBrandBtn = document.querySelector('.mobile.brand__button');
const mobileBrandAside = document.querySelector(
    '.mobile.brand__button > aside.brands'
);

const handleSlideOutBrandAside = () => {
    mobileBrandAside.classList.toggle(
        'slide-out',
        !mobileBrandAside.classList.contains('slide-out')
    );
};
mobileBrandBtn.addEventListener('click', handleSlideOutBrandAside);
