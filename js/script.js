

function validateControls() {
    
    //Email
    var email = document.getElementById("email")
    if (email.value == "") {
        window.alert("please enter your valid email Id");
        email.focus();
        return false;
    }
    //Password
    var password = document.getElementById("password")
    if (password.value == "") {
        window.alert("please enter your password");
        password.focus();
        return false;
    }
    //Confirmation
    var confirmpassword = document.getElementById("confirmpassword")
    if (confirmpassword.value !== password.value) {
        window.alert("Not the same password as you entered");
        password.focus();
        return false;
    }
   //FirstName
   var firstname = document.getElementById("firstname")
   if (firstname.value == "") {
	   window.alert("please enter your first name");
	   firstname.focus();
	   return false;
   }
   //MiddleName
   var middlename = document.getElementById("middlename")
   if (middlename.value == "") {
	   window.alert("please enter your middle name");
	   middlename.focus();
	   return false;
   }
   //LastName
   var lastname = document.getElementById("lastname")
   if (lastname.value == "") {
	   window.alert("please enter your last name");
	   lastname.focus();
	   return false;
   }
   //Location
   var currentlocation = document.getElementById("currentlocation")
   if (currentlocation.value == "") {
	   window.alert("please enter your current country name");
	   currentlocation.focus();
	   return false;
   }
    //Gender   
   var gender = document.getElementById("gender");
    if (gender === "") {
        window.alert("Gender required!");
        gender.focus();
        return false;
    }
    //phonenumber
    var phonenumber = document.getElementById("phonenumber")
    if (phonenumber.value == "") {
        window.alert("please enter your mobile no plus country code.");
        phonenumber.focus();
        return false;
    }
     // Specialization
     var specialization = document.getElementById("specilization")
     if (specialization.value == "") {
         window.alert("please enter what you want to specialization on");
         specialization.focus();
         return false;
     }
	 //Level
     var level = document.getElementById("level")
     if (level.value == "") {
         window.alert("please enter your level of Education");
         level.focus();
         return false;
     }
	 //Results
	 var results = document.getElementById("results")
     if (results.value == "") {
         window.alert("please enter your transcript results");
         results.focus();
         return false;
     }
        
}
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
      x.className += " responsive";
    } else {
      x.className = "topnav";
    }
}

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
}