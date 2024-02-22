
    $('.livesearch').select2({
        placeholder: 'Select Ruang',
        value:"{{ old('ruang') }}",
        ajax: {
            url: '/ajax-autocomplete-search3',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text:item.nama,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
    // var dropdown = document.getElementsByClassName("dropdown-btn");
    // var i;
    
    // for (i = 0; i <script dropdown.length; i++) {
    // dropdown[i].addEventListener("click", function() {
    // this.classList.toggle("active");
    // var dropdownContent = this.nextElementSibling;
    // if (dropdownContent.style.display === "block") {
    // dropdownContent.style.display = "none";
    // } else {
    // dropdownContent.style.display = "block";
    // }
    // });
    // }
    
    $(document).ready(function(){  
    $('#show_password').on('click', function(){  
    var passwordField = $('#password');
    var passwordField2 = $('#passwordNew');    
    var passwordFieldType = passwordField.attr('type');
    var passwordFieldType2 = passwordField2.attr('type');
    if(passwordField.val() != '')
    {
        if(passwordFieldType == 'password')  
            {  
            passwordField.attr('type', 'text');  
            $(this).text('Hide Password');  
            }  
            else  
            {  
            passwordField.attr('type', 'password');  
            $(this).text('Show Password');  
            }
    }
    // elseif(passwordField2.val() != '')
    // {
    //     if(passwordFieldType2 == 'password')  
    //         {  
    //         passwordField2.attr('type', 'text');  
    //         $(this).text('Hide Password');  
    //         }  
    //         else  
    //         {  
    //         passwordField2.attr('type', 'password');  
    //         $(this).text('Show Password');  
    //         }
    // }
    else
    {
    alert("Please Enter Password");
    }
    });  
    });  
    function change() {
    
    // membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password 
    var x = document.getElementsByClassName('pass').type;
    
    //membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
    if (x == 'password') {
    
    //ubah form input password menjadi text
    document.getElementsByClassName('pass').type = 'text';
    
    //ubah icon mata terbuka menjadi tertutup
    document.getElementById('mybutton').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                    <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                                                    <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                                                    </svg>`;
    }
    else {
    
    //ubah form input password menjadi text
    document.getElementsByClassName('pass').type = 'password';
    
    //ubah icon mata terbuka menjadi tertutup
    document.getElementById('mybutton').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                    <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                    </svg>`;
    }
    }
    var myButton = document.getElementsByName('dynamic');
    var myInput = document.getElementsByName('viewPass');
    myButton.forEach(function(element, index){
      element.onclick = function(){
         'use strict';
    
          if (myInput[index].type == 'password') {
              myInput[index].setAttribute('type', 'text');
              element.firstChild.textContent = 'Hide';
              element.firstChild.className = "";
    
          } else {
               myInput[index].setAttribute('type', 'password');
               element.firstChild.textContent = '';
                element.firstChild.className = "glyphicon glyphicon-eye-open";
          }
      }
    })
    function showPassword(targetID) {
      var x = document.getElementById(targetID);
    
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    
    }
    var timeout;
    
    /*This is an example function and can be disregarded
    This function sets the loading div to a given string.*/
    function loaded() {
      $('#loading').html('The Ajax Call Data');
    }
    
    function startLoad() {
        /*This is the loading gif, It will popup as soon as startLoad is called*/
        $('#loading').html('<img src="http://rpg.drivethrustuff.com/shared_images/ajax-loader.gif"/>');
        /*
        This is an example of the ajax get method, 
        You would retrieve the html then use the results
        to populate the container.
        
        $.get('example.php', function (results) {
            $('#loading').html(results);
        });
        */
        /*This is an example and can be disregarded
        The clearTimeout makes sure you don't overload the timeout variable
        with multiple timout sessions.*/
        clearTimeout(timeout);
        /*Set timeout delays a given function for given milliseconds*/
        timeout = setTimeout(loaded, 1500);
      }
      /*This binds a click event to the refresh button*/
    $('#start_call').click(startLoad);
    /*This starts the load on page load, so you don't have to click the button*/
    startLoad();
    
    
          
    
                
    //         $(document).ready(function(){
    //     $('.deletePinjamBtn').click(function(e){
    //         e.preventDefault();
    
    //         var pinjam_id = $(this).val();
    //         $('#pinjam_id').val(pinjam_id);
    //         $('#deleteModal').modal('show');
    //     });
    //     $('#closePinjamBtn').click(function(e){
    //         $('#deleteModal').modal('show');
    //     });
    // });
    // $(document).ready(function(){
    //     $('.pilihBtn').click(function(e){
    //         e.preventDefault();
    
    //         var pinjam_id = $(this).val();
    //         $('#pinjam_id').val(pinjam_id);
    //         $('#pilihModal').modal('show');
    //     });
    //     $('#closePinjamBtn').click(function(e){
    //         $('#pilihModal').modal('show');
    //     });
    // });
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
    //         })
    //     });
    
