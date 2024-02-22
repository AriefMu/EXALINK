<script>
  @if(session()->has('success'))
 
        toastr.success('{{ session('success') }}', 'BERHASIL!'); 

  @elseif(session()->has('error'))
  
        toastr.error('{{ session('error') }}', 'GAGAL!'); 
        
  @endif
  document.getElementById("button-toggle").addEventListener("click", () => {

// when the button-toggle is clicked, it will add/remove the active-sidebar class
document.getElementById("sidebar").classList.toggle("active-sidebar");

// when the button-toggle is clicked, it will add/remove the active-main-content class
document.getElementById("main-content").classList.toggle("active-main-content");
});
$(document).ready(function(){
    $('.deletePinjamBtn').click(function(e){
        e.preventDefault();

        var pinjam_id = $(this).val();
        $('#pinjam_id').val(pinjam_id);
        $('#deleteModal').modal('show');
    });
    $('#closePinjamBtn').click(function(e){
        $('#deleteModal').modal('hide');
    });
});
$(document).ready(function(){
    $('.pilihBtn').click(function(e){
        e.preventDefault();

        var pinjam_id = $(this).val();
        $('#pinjam_id').val(pinjam_id);
        $('#pilihModal').modal('show');
    });
    $('#closePinjamBtn').click(function(e){
        $('#pilihModal').modal('hide');
    });
});

// display a modal (small modal)
// $(document).on('click', '#smallButton', function(event) {
//         event.preventDefault();
//         let href = $(this).attr('data-attr');
//         $.ajax({
//             url: href
//             , beforeSend: function() {
//                 $('#loader').show();
//             },
//             // return the result
//             success: function(result) {
//                 $('#smallModal').modal("show");
//                 $('#smallBody').html(result).show();
//             }
//             , complete: function() {
//                 $('#loader').hide();
//             }
//             , error: function(jqXHR, testStatus, error) {
//                 console.log(error);
//                 alert("Page " + href + " cannot open. Error:" + error);
//                 $('#loader').hide();
//             }
//             , timeout: 8000
//         });
//     });
function showPassword(targetID) {
  var x = document.getElementById(targetID);

  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }

}
var timeout;

// /*This is an example function and can be disregarded
// This function sets the loading div to a given string.*/
// function loaded() {
//   $('#loading').html('The Ajax Call Data');
// };

// function startLoad() {
//     /*This is the loading gif, It will popup as soon as startLoad is called*/
//     $('#loading').html('<img src="http://rpg.drivethrustuff.com/shared_images/ajax-loader.gif"/>');
//     /*
//     This is an example of the ajax get method, 
//     You would retrieve the html then use the results
//     to populate the container.
    
//     $.get('example.php', function (results) {
//         $('#loading').html(results);
//     });
//     */
//     /*This is an example and can be disregarded
//     The clearTimeout makes sure you don't overload the timeout variable
//     with multiple timout sessions.*/
//     clearTimeout(timeout);
//     /*Set timeout delays a given function for given milliseconds*/
//     timeout = setTimeout(loaded, 1500);
//   }
//   /*This binds a click event to the refresh button*/
// $('#start_call').click(startLoad);
// /*This starts the load on page load, so you don't have to click the button*/
// startLoad();
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
};
</script>