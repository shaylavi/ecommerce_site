      <footer class="container-fluid bg-4 text-center">
        <div class="row">
            <div class="col-md-6 text-left">
                <p><h4>HEADING</h2></p>
                <p><h6>aslja soidj asdj aslkdaslkdsalkdsad<br/>
                  alfnoas naosdm asdsakldm aslkdas </h2></p>
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
                <script>
// When the user scrolls the page, execute myFunction 
window.onscroll = function() {myFunction()};
debugger;
// Get the navbar
var navbar = document.getElementById("navbara");

// Get the offset position of the navbar
var sticky = navbar.offsetTop;

// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>