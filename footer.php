      <footer class="container-fluid bg-4 text-center">
        <div class="row">
          <div class="col-md-6 text-left">
            <p>
              <h4>HEADING</h2>
            </p>
            <p>
              <h6>aslja soidj asdj aslkdaslkdsalkdsad<br />
                alfnoas naosdm asdsakldm aslkdas </h2>
            </p>
          </div>
          <div class="col-md-6 text-center">
            <div class="col-md-6 text-center">
              <div style="padding: 15px">
                Photo of something1
              </div>
              <div style="padding: 15px">
                Photo of something2
              </div>
            </div>
            <div class="col-md-6 text-center">
              <div style="padding: 15px">
                Photo of something3
              </div>
              <div style="padding: 15px">
                Photo of something4
              </div>
            </div>
          </div>
        </div>
      </footer>
      <script type="text/javascript">
        window.onscroll = function() {
          myFunction()
        };

        var navbar = document.getElementById("navbara");
        var sticky = navbar.offsetTop;

        function myFunction() {
          if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
          } else {
            navbar.classList.remove("sticky");
          }
        }
        var imgWidth;
        var imgHeight;
        var leftMarginTextVal = 27;
        var idealSize = parseInt($(".navbar-brand").css('font-size').substr(0,2));
        $('#logo').on('load', function() {
          imgWidth = this.width;
          imgHeight = this.height;
          $('.navbar-duplicate')[0].style.left = (imgWidth + leftMarginTextVal) + "px";
          $(window).on('scroll', function() {
            var scrollVal = ($(this).scrollTop() / 10);
            var newSize = idealSize - scrollVal;
            imageScrollVal = scrollVal + 5;
            if (newSize >= 30) {
              $('#logo').width(imgWidth - (imageScrollVal));
              $('#logo').height(imgHeight - (imageScrollVal));
              $('.resizeItem').css('font-size', newSize + "px");
              $('.navbar-duplicate')[0].style.left = (imgWidth - (imageScrollVal) + leftMarginTextVal+2) + "px";
            }
          });
        });
      </script>