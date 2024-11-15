(function($) {
  "use strict";
  
 // menu 
 $('.siteBar-btn').click( function (event){ 
    event.preventDefault()
    $(this).toggleClass('active');   
    $('.mobile-menu').toggleClass('siteBar');   
  }); 
  
 // 
 $('.text-box button,.textBox__opt span').click( function (event){ 
    event.preventDefault()  
    $('.text-box').toggleClass('show');   
  }); 
  
 // 
 $('.compare__btn').click( function (event){ 
    event.preventDefault()  
    $('.text-box').removeClass('d-none');   
    $('.delet').removeClass('d-none');   
  }); 
  
 // 
 $('.d-item-1').click( function (event){ 
    event.preventDefault()  
    $('.t-box-1').addClass('d-none');    
    $(this).addClass('d-none');    
  }); 
 // 
 $('.d-item-2').click( function (event){ 
    event.preventDefault()  
    $('.t-box-2').addClass('d-none');      
    $(this).addClass('d-none');     
  }); 

  // tab
 $('.Profiler_btn').click( function (event){ 
    event.preventDefault()  
    $('.ProductContent').addClass('d-none');      
    $('.ProfilerContent').removeClass('d-none');        
    $('.Product_btn').removeClass('active');        
    $(this).addClass('active');    
  }); 

 $('.Product_btn').click( function (event){ 
    event.preventDefault()  
    $('.ProductContent').removeClass('d-none');      
    $('.ProfilerContent').addClass('d-none');          
    $('.Profiler_btn').removeClass('active');          
    $(this).addClass('active');    
  }); 




  const locales = ["en-US", "es-ES","fr-FR"];

  function getFlagSrc(countryCode) {
    return /^[A-Z]{2}$/.test(countryCode)
         ? `https://flagsapi.com/${countryCode.toUpperCase()}/shiny/64.png`
      : "";
  }
  
  const dropdownBtn = document.getElementById("dropdown-btn");
  const dropdownContent = document.getElementById("dropdown-content");
  
  function setSelectedLocale(locale) {
    const intlLocale = new Intl.Locale(locale);
    const langName = new Intl.DisplayNames([locale], {
      type: "language",
    }).of(intlLocale.language);
  
    dropdownContent.innerHTML = "";
  
    const otherLocales = locales.filter((loc) => loc !== locale);
    otherLocales.forEach((otherLocale) => {
      const otherIntlLocale = new Intl.Locale(otherLocale);
      const otherLangName = new Intl.DisplayNames([otherLocale], {
        type: "language",
      }).of(otherIntlLocale.language);
  
      const listEl = document.createElement("li");
      listEl.innerHTML = `${otherLangName}<img src="${getFlagSrc(
        otherIntlLocale.region
      )}" />`;
      listEl.value = otherLocale;
      listEl.addEventListener("mousedown", function () {
        setSelectedLocale(otherLocale);
      });
      dropdownContent.appendChild(listEl);
    });
  
    dropdownBtn.innerHTML = `<img src="${getFlagSrc(
      intlLocale.region
    )}" />${langName}<span class="arrow-down"></span>`;
  }
  
  setSelectedLocale(locales[0]);
  const browserLang = new Intl.Locale(navigator.language).language;
  for (const locale of locales) {
    const localeLang = new Intl.Locale(locale).language;
    if (localeLang === browserLang) {
      setSelectedLocale(locale);
    }
  }



  // owlCarousel
  $(".brand-active").owlCarousel({
    loop: true,
    margin: 30,
    items: 6,
    navText: [
      '<i class="fa fa-angle-left"></i>',
      '<i class="fa fa-angle-right"></i>'
    ],
    nav: false,
    dots: false,
    responsive: {
      0: {
        items: 2
      },
      767: {
        items: 3
      },
      992: {
        items: 6
      }
    }
  });


  // page Animation
  // AOS.init({
  //   mirror: true,
  //   duration: 1500,
  //   initClassName: 'aos-init',
  //   once: true,
  // });

  // data-aos="fade-up" 
  // data-aos-delay="300" 

 
})(jQuery);
