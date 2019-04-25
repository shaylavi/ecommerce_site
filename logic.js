window.onscroll = function() {
  enableStickyMenu();
};

var BASE_IMG_URL = "https://s3.us-east-2.amazonaws.com/eco-travel/";
var navbar = document.getElementById('navbara');
var sticky = navbar.offsetTop;

function enableStickyMenu() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add('sticky');
  } else {
    navbar.classList.remove('sticky');
  }
}
var imgWidth;
var imgHeight;
var leftMarginTextVal = 27;
var idealSize = parseInt(
  $('.navbar-brand')
    .css('font-size')
    .substr(0, 2)
);
$('img').one('load').each(function(e, data) {
debugger;
    data.src = BASE_IMG_URL + 'products' + data.src.substr(data.src.lastIndexOf('/'))
});
$('#logo').one('load', function() {
    if(this.complete) {
        console.log('here');
        $(this).trigger('load');
    }
});
$('#logo').on('load', function() {
  imgWidth = this.width;
  imgHeight = this.height;
  $('.navbar-duplicate')[0].style.left = imgWidth + leftMarginTextVal + 'px';
  $(window).on('scroll', function() {
    var scrollVal = $(this).scrollTop() / 10;
    var newSize = idealSize - scrollVal;
    imageScrollVal = scrollVal + 5;
    if (newSize >= 30) {
      $('#logo').width(imgWidth - imageScrollVal);
      $('#logo').height(imgHeight - imageScrollVal);
      $('.resizeItem').css('font-size', newSize + 'px');
      $('.navbar-duplicate')[0].style.left =
        imgWidth - imageScrollVal + leftMarginTextVal + 2 + 'px';
    }
  });
});

var menuMapping = [
  {
    home: 'index',
    categories: 'products',
    'about us': 'about',
    'contact us': 'contact',
    login: 'login',
    cart: 'cart',
    search: 'search'
  }
];
function AddActiveClass() {
  var listItems = $('li');
  var pageName = window.location.pathname
    .substr(window.location.pathname.lastIndexOf('/') + 1)
    .split('.')[0];

  for (var i in listItems) {
    var label = listItems[i];
    if (listItems[i].innerText !== '') {
      label = label.innerText.trim().toLowerCase();
      if (menuMapping[0][label] === pageName) {
        listItems[i].classList.add('active');
        listItems[i].firstElementChild.href = '#';
        break;
      }
    }
  }
}
AddActiveClass();
