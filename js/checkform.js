function addtxtEmail() {
    var inputElement = document.getElementById('email');
    var inputValue = inputElement.value.trim(); // Remove leading and trailing spaces

    // Check if the input is not empty
    if (inputValue !== '') {
        // Add '@gmail.com' if it doesn't already contain it
        if (!inputValue.includes('@')) {
            inputElement.value = inputValue + '@gmail.com';
        }
    }
}
function showpassword() {
    var passwordInput = document.getElementById("password");
    var repasswordInput = document.getElementById("repassword");
    var eyeIcon = document.querySelector(".eye-icon");
    if (passwordInput.type === "password" && repasswordInput.type === "password") {
        passwordInput.type = "text";
        repasswordInput.type = "text";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        repasswordInput.type = "password";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    }
}
function handleMinus() {
    var quantityInput = document.getElementById('quantity');
    var currentQuantity = parseInt(quantityInput.value);
    if (currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;
    }
}

function handlePlus() {
    var quantityInput = document.getElementById('quantity');
    var currentQuantity = parseInt(quantityInput.value);
    quantityInput.value = currentQuantity + 1;
}
//

 
$(document).ready(function() {

  var back = $(".prev");
  var next = $(".next");
  var steps = $(".step");

  next.bind("click", function() {
    $.each(steps, function(i) {
      if (!$(steps[i]).hasClass('current') && !$(steps[i]).hasClass('done')) {
        $(steps[i]).addClass('current');
        $(steps[i - 1]).removeClass('current').addClass('done');
        return false;
      }
    })
  });
  back.bind("click", function() {
    $.each(steps, function(i) {
      if ($(steps[i]).hasClass('done') && $(steps[i + 1]).hasClass('current')) {
        $(steps[i + 1]).removeClass('current');
        $(steps[i]).removeClass('done').addClass('current');
        return false;
      }
    })
  });

})
