var BASE_IMG_URL = 'https://s3.us-east-2.amazonaws.com/eco-travel/';

// Sticky menu
var navbar = document.getElementById('navbar-container');

var sticky = navbar.offsetTop;

function enableStickyMenu() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add('sticky');
  } else {
    navbar.classList.remove('sticky');
  }
}
window.onscroll = function() {
  enableStickyMenu();
};

// Data for the sticky menu animation
var imgWidth;
var imgHeight;
var leftMarginTextVal = 27;
var idealSize = parseInt(
  $('.navbar-brand')
    .css('font-size')
    .substr(0, 2)
);

// Change images source to the AWS bucket based on their folder tag
$('img')
  .one('load')
  .each(function(e, data) {
    if (data.dataset.folder !== undefined) {
      var startPos = data.src.lastIndexOf('/');
      if (data.dataset.folder === '') ++startPos;
      data.src = BASE_IMG_URL + data.dataset.folder + data.src.substr(startPos);
    }
  });

// Trigger load event when the page is cached
$('#logo').one('load', function() {
  if (this.complete) {
    $(this).trigger('load');
  }
});
// Handle load event for the sticky menu animation
$('#logo').on('load', function() {
  imgWidth = this.width;
  imgHeight = this.height;
  $('.navbar-duplicate')[0].style.left = imgWidth + leftMarginTextVal + 'px';
  $(window).on('scroll', function() {
    var scrollVal = $(this).scrollTop() / 10;
    var newSize = idealSize - scrollVal;
    imageScrollVal = scrollVal; // + 5;
    if (newSize >= 30) {
      $('#logo').width(imgWidth - imageScrollVal);
      $('#logo').height(imgHeight - imageScrollVal);
      $('.resizeItem').css('font-size', newSize + 'px');
      $('.navbar-duplicate')[0].style.left =
        imgWidth - imageScrollVal + leftMarginTextVal + 2 + 'px';
    }
  });
});

// Pages and files mapping for the active class tag
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
    if (listItems[i].innerText !== '' && label.innerText != undefined) {
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

function getCategorysHtml(id) {
  $.ajax({
    type: 'POST',
    url: 'snippets/handle-get-categories.php',
    success: function(data) {
      $('#' + id).html(data);
      return data;
    },
    error: function(data) {
      console.log(data);
    }
  });
}
getCategorysHtml('headerCategories');

function isJson(str) {
  try {
    JSON.parse(str);
  } catch (e) {
    return false;
  }
  return true;
}

function addToCart(itemId, isProductPage = false) {
  let svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
  isProductPage
    ? svg.setAttribute('class', 'checkmark-product-page')
    : svg.setAttribute('class', 'checkmark');
  svg.setAttribute('viewBox', '0 0 52 52');
  svg.innerHTML =
    '<circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>';

  let txt = document.createElement('span');
  txt.setAttribute('style', 'font-weight: normal');
  txt.innerText = 'Item added!';

  let addedItem = document.createElement('div');
  isProductPage
    ? addedItem.setAttribute('class', 'fade-message-product-page')
    : addedItem.setAttribute('class', 'fade-message');
  addedItem.innerText = '+1 Item added!';
  let itm = $('#item-' + itemId);
  itm[0].appendChild(addedItem);

  let cartBtn = $('#cart-id-' + itemId);
  if (cartBtn.length > 0) {
    updateCart(itemId);

    cartBtn[0].innerText = '';
    cartBtn[0].style.color = !isProductPage ? '#0f8628' : 'white';

    cartBtn[0].appendChild(svg);
    cartBtn[0].appendChild(txt);

    var tmr = setInterval(function() {
      cartBtn[0].style.color = isProductPage ? 'white' : 'black';
      cartBtn[0].innerText = 'Add To Cart';

      cartBtn[0].blur();
      clearInterval(tmr);
    }, 2000);
  }
}

function updateCart(productId) {
  var oReq = new XMLHttpRequest();
  oReq.open('POST', 'snippets/cart.php');
  oReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  oReq.addEventListener('load', function(data) {
    if (data.currentTarget.status === 200) {
      updateCartBadge();
    } else console.error('error code - ' + e.currentTarget.status + '. Text - ' + e.currentTarget.statusText);
  });
  oReq.addEventListener('error', function(data) {
    console.error(data);
  });

  oReq.send('item=' + productId);
}
function updateCartBadge() {
  $('#cart-badge')[0].innerText =
    $('#cart-badge')[0].innerText != ''
      ? parseInt($('#cart-badge')[0].innerText) + 1
      : 1;
}
